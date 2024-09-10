<?php

	namespace Hasokeyk\Trendyol;

	use Hasokeyk\Trendyol\Marketplace\TrendyolMarketplace;

	class Trendyol{

		public $supplierId;
		public $username;
		public $password;
		public $test;

		public TrendyolMarketplace $marketplace;
		public TrendyolRequest $request;

		function __construct($supplierId = null, $username = null, $password = null, $test = false){

			$this->supplierId = $supplierId;
			$this->username   = $username;
			$this->password   = $password;
			$this->test       = $test;

			$this->request     = $this->TrendyolRequest();
			$this->marketplace = $this->TrendyolMarketplace();
		}

		public function TrendyolMarketplace(): TrendyolMarketplace{
			return new TrendyolMarketplace($this);
		}

		public function TrendyolRequest(): TrendyolRequest{
			return new TrendyolRequest($this);
		}

	}