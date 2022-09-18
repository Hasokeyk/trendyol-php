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
            $url    = 'https://api.trendyol.com/sapigw/product-categories/'.$category_id.'/attributes';
            $result = $this->request()->get($url);
            return $result;
        }
    }