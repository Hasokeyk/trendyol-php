<?php

    namespace Hasokeyk\Trendyol\Marketplace;

    use Hasokeyk\Trendyol\TrendyolRequest;

    class TrendyolMarketplaceCustomerQuestions{

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

        public function get_my_customer_questions($filter){
            $url                 = 'https://api.trendyol.com/sapigw/suppliers/'.$this->supplierId.'/questions/filter';
            $required_query_data = [
                'barcode'            => null,
                'page'               => null,
                'size'               => null,
                'supplierId'         => $this->supplierId,
                'endDate'            => null,
                'startDate'          => null,
                'status'             => 'WAITING_FOR_ANSWER',
                'orderByField'       => 'CreatedDate',
                'orderByDirection'   => 'DESC',
                'shipmentPackageIds' => null,
            ];
            $required_query_data = array_merge($required_query_data, $filter);
            $new_url             = http_build_query($required_query_data);

            $result = $this->request()->get($url.'?'.$new_url);
            return $result;
        }

        public function answer_customer_question($question_id = null, $answer = null){
            $url = 'https://api.trendyol.com/sapigw/suppliers/'.$this->supplierId.'/questions/'.$question_id.'/answers';

            $post_data = [
                'text' => $answer,
            ];

            $result = $this->request()->post($url, $post_data);
            return $result;
        }

    }