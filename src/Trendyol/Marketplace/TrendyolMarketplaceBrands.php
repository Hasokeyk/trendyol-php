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

        public function get_brands(){
            $url = 'https://api.trendyol.com/sapigw/brands';
            $result = $this->request()->get($url);
            return $result;
        }

        public function search_brand($brand_name = null){
            $url    = 'https://api.trendyol.com/sapigw/brands/by-name?name='.$brand_name;
            $result = $this->request()->get($url);
            return $result;
        }
    }