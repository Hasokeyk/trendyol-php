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

        public function get_category_info($category_id = null){
            $category_info_json = json_decode(file_get_contents((__DIR__).'/../assets/category_info.json'), true);
            $keys = $this->trendyol_array_search($category_info_json['Categories'], 'Id', $category_id);
            $url                = 'https://api.trendyol.com/sapigw/product-categories/'.$category_id.'/attributes';
            $result             = $this->request()->get($url);
            $result->commission = $keys['Commission'];
            return $result;
        }

        public $trendyol_array_search_result = null;
        public function trendyol_array_search($data = [], $key = null, $value = null){
            if(isset($data) and $data != null){
                foreach($data as $category){

                    if(isset($category[$key]) and $category[$key] == $value){
                        $this->trendyol_array_search_result = $category;
                    }

                    if(isset($category['Nodes']) and $category['Nodes'] != null){
                        $this->trendyol_array_search($category['Nodes'], $key, $value);
                    }

                }
            }else{
                return 2;
            }
            return $this->trendyol_array_search_result;
        }

    }