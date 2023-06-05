<?php

    namespace Hasokeyk\Trendyol\Marketplace;

    use Hasokeyk\Trendyol\TrendyolRequest;

    class TrendyolMarketplaceCategories{

        public $supplierId;
        public $username;
        public $password;

        function __construct($supplierId = null, $username = null, $password = null){
            $this->supplierId = $supplierId;
            $this->username   = $username;
            $this->password   = $password;
        }

        public function request(){
            return new TrendyolRequest($this->supplierId, $this->username, $this->password);
        }

        public function get_categories(){
            $url    = 'https://api.trendyol.com/sapigw/product-categories';
            $result = $this->request()->get($url);
            return $result;
        }

        public function get_marketplace_categories(){
            $url    = 'https://www.trendyol.com/sr?mid='.$this->supplierId;
            $result = file_get_contents($url);
            preg_match_all('/{"id":"\d+","text":"([^"]+)","beautifiedName":"[^"]+","count":([^"]+),"filtered":false,"filterField":"(webCategoryIds|leafCategoryIds)","type":"(WebCategory|LeafCategory)","url":"[^"]+"}/', $result, $matches);

            $supplider_cats = [];
            foreach($matches[1] as $id => $match){

                $category_info_json = json_decode(file_get_contents((__DIR__).'/../assets/category_info.json'), true);
                $keys               = $this->trendyol_array_search($category_info_json['Categories'], 'Name', trim($match));

                $supplider_cats[] = [
                    'cat_id'   => trim($keys['Id']),
                    'cat_name' => trim($match),
                    'count'    => $matches[2][$id]
                ];
            }

            return $supplider_cats;
        }

        public function get_category_info($category_id = null){
            $category_info_json = json_decode(file_get_contents((__DIR__).'/../assets/category_info.json'), true);
            $keys               = $this->trendyol_array_search($category_info_json['Categories'], 'Id', $category_id);
            $url                = 'https://api.trendyol.com/sapigw/product-categories/'.$category_id.'/attributes';
            $result             = $this->request()->get($url);
            $result->commission = $keys['Commission'] ?? 0;
            return $result;
        }

        public $trendyol_array_search_result = null;

        public function trendyol_array_search($data = [], $key = null, $value = null){
            if(isset($data) and $data != null){
                foreach($data as $category){

                    if(isset($category[$key]) and ($category[$key] == $value or $this->calculateSimilarityScore($category[$key], $value) > 85)){
                        $this->trendyol_array_search_result = $category;
                    }

                    if(isset($category['Nodes']) and $category['Nodes'] != null){
                        $this->trendyol_array_search($category['Nodes'], $key, $value);
                    }

                }
            }
            else{
                return 2;
            }
            return $this->trendyol_array_search_result;
        }

        private function calculateSimilarityScore($string1, $string2){

            $string1 = str_replace(['\u0026','&'], ['&',' ve '], htmlspecialchars_decode($string1));
            $string2 = str_replace(['\u0026','&'], ['&',' ve '], htmlspecialchars_decode($string2));

            $levenshteinDistance = levenshtein($string1, $string2);
            $maxLength           = max(strlen($string1), strlen($string2));

            $similarityScore = 100 * (1 - $levenshteinDistance / $maxLength);

            return $similarityScore;
        }

    }