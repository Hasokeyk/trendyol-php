<?php

	namespace Hasokeyk\Trendyol\Marketplace;

	class TrendyolMarketplace{

		public $supplierId;
		public $username;
		public $password;
		private $trendyol;

		function __construct($trendyol){
			$this->supplierId = $trendyol->supplierId;
			$this->username   = $trendyol->username;
			$this->password   = $trendyol->password;
			$this->trendyol   = $trendyol;
		}

		public function TrendyolMarketplaceCategories(): TrendyolMarketplaceCategories{
			return new TrendyolMarketplaceCategories($this->trendyol);
		}

		public function TrendyolMarketplaceProducts(): TrendyolMarketplaceProducts{
			return new TrendyolMarketplaceProducts($this->trendyol);
		}

		public function TrendyolMarketplaceBrands(): TrendyolMarketplaceBrands{
			return new TrendyolMarketplaceBrands($this->trendyol);
		}

		public function TrendyolMarketplaceShipment(): TrendyolMarketplaceShipment{
			return new TrendyolMarketplaceShipment($this->trendyol);
		}

		public function TrendyolMarketplaceAddresses(): TrendyolMarketplaceAddresses{
			return new TrendyolMarketplaceAddresses($this->trendyol);
		}

		public function TrendyolMarketplaceOrders(): TrendyolMarketplaceOrders{
			return new TrendyolMarketplaceOrders($this->trendyol);
		}

		public function TrendyolMarketplaceCustomerQuestions(): TrendyolMarketplaceCustomerQuestions{
			return new TrendyolMarketplaceCustomerQuestions($this->trendyol);
		}

	}