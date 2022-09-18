<?php

    namespace Hasokeyk\Trendyol\Marketplace;

    use Hasokeyk\Trendyol\TrendyolRequest;

    class TrendyolMarketplace{

        public $supplierId;
        public $username;
        public $password;

        function __construct($supplierId = null, $username = null, $password = null){
            $this->supplierId = $supplierId;
            $this->username   = $username;
            $this->password   = $password;
        }

        public function TrendyolRequest(){
            return new TrendyolRequest($this->supplierId, $this->username, $this->password);
        }

        public function TrendyolMarketplaceCategories(){
            return new TrendyolMarketplaceCategories($this->supplierId, $this->username, $this->password);
        }

        public function TrendyolMarketplaceProducts(){
            return new TrendyolMarketplaceProducts($this->supplierId, $this->username, $this->password);
        }

        public function TrendyolMarketplaceBrands(){
            return new TrendyolMarketplaceBrands($this->supplierId, $this->username, $this->password);
        }

        public function TrendyolMarketplaceShipment(){
            return new TrendyolMarketplaceShipment($this->supplierId, $this->username, $this->password);
        }

        public function TrendyolMarketplaceAddresses(){
            return new TrendyolMarketplaceAddresses($this->supplierId, $this->username, $this->password);
        }

        public function TrendyolMarketplaceOrders(){
            return new TrendyolMarketplaceOrders($this->supplierId, $this->username, $this->password);
        }

        public function TrendyolMarketplaceCustomerQuestions(){
            return new TrendyolMarketplaceCustomerQuestions($this->supplierId, $this->username, $this->password);
        }

    }