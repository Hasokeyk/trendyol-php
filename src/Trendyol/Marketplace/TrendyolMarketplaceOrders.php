<?php

    namespace Hasokeyk\Trendyol\Marketplace;

    class TrendyolMarketplaceOrders{

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

        public function get_my_orders($filter = null){
            $url = 'https://api.trendyol.com/sapigw/suppliers/'.$this->supplierId.'/orders';

            $required_query_data = [
                'startDate'          => null,
                'endDate'            => null,
                'page'               => null,
                'size'               => null,
                'supplierId'         => $this->supplierId,
                'orderNumber'        => null,
                'status'             => null,
                'orderByField'       => null,
                'orderByDirection'   => 'DESC',
                'shipmentPackageIds' => null,
            ];
            $required_query_data = array_merge($required_query_data, ($filter??[]));
            $new_url             = http_build_query($required_query_data);

            return $this->request()->get($url.'?'.$new_url);
        }

    }