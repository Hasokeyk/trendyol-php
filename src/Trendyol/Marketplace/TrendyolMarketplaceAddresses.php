<?php

    namespace Hasokeyk\Trendyol\Marketplace;

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

	    function request(){
		    return $this->trendyol->request;
	    }

        public function get_my_addresses(){
            $url = "https://apigw.trendyol.com/integration/sellers/{$this->supplierId}/addresses";
            $result = $this->request()->get($url);
            return $result;
        }
    }