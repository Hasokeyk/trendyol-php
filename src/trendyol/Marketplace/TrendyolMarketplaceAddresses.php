<?php

    namespace Hasokeyk\Trendyol\Marketplace;

    use Hasokeyk\Trendyol\TrendyolRequest;

    class TrendyolMarketplaceAddresses{

        public $supplierId;
        public $username;
        public $password;

	    function __construct($trendyol){
		    $this->supplierId = $trendyol->supplierId;
		    $this->username   = $trendyol->username;
		    $this->password   = $trendyol->password;
		    $this->trendyol   = $trendyol;
	    }

        public function request(){
            return new TrendyolRequest($this->supplierId, $this->username, $this->password);
        }

        public function get_my_addresses(){
            $url    = 'https://api.trendyol.com/sapigw/suppliers/'.$this->supplierId.'/addresses';
            $result = $this->request()->get($url);
            return $result;
        }
    }