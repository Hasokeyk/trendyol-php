<?php

    namespace Hasokeyk\Trendyol;

    use Hasokeyk\Trendyol\Marketplace\TrendyolMarketplace;

    class Trendyol{

        public $supplierId;
        public $username;
        public $password;

        public TrendyolMarketplace $marketplace;
        public TrendyolRequest     $request;

        function __construct($supplierId = null, $username = null, $password = null){

            $this->supplierId = $supplierId;
            $this->username   = $username;
            $this->password   = $password;

            $this->request     = $this->TrendyolRequest();
            $this->marketplace = $this->TrendyolMarketplace();
        }

        public function TrendyolMarketplace(){
            return new TrendyolMarketplace($this->supplierId, $this->username, $this->password);
        }

        public function TrendyolRequest(){
            return new TrendyolRequest($this->supplierId, $this->username, $this->password);
        }

    }