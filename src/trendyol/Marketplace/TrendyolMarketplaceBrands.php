<?php

    namespace Hasokeyk\Trendyol\Marketplace;

    use Hasokeyk\Trendyol\TrendyolRequest;

    class TrendyolMarketplaceBrands{

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

        public function get_brands($filter = []){
            $url = 'https://api.trendyol.com/sapigw/brands';

            $required_query_data = [
                'page' => 0,
                'size' => null,
            ];
            $required_query_data = array_merge($required_query_data, $filter);
            $new_url             = http_build_query($required_query_data);

            $result = $this->request()->get($url.'?'.$new_url);
            return $result;
        }

        public function search_brand($brand_name = null){
            $url    = 'https://api.trendyol.com/sapigw/brands/by-name?name='.$brand_name;
            $result = $this->request()->get($url);
            return $result;
        }
    }