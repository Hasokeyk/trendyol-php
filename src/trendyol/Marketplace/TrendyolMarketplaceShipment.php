<?php

    namespace Hasokeyk\Trendyol\Marketplace;

    use Hasokeyk\Trendyol\TrendyolRequest;

    class TrendyolMarketplaceShipment{

        public $supplierId;
        public $username;
        public $password;

        function __construct($supplierId = null, $username = null, $password = null){
            $this->supplierId = $supplierId;
            $this->username = $username;
            $this->password = $password;
        }

        public function request(){
            return new TrendyolRequest($this->supplierId, $this->username, $this->password);
        }

        public function get_shipment_companies(){

            $data = [
                [
                    'ID'    => 42,
                    'key'   => 'DHLMP',
                    'value' => 'DHL Marketplace',
                    'phone' => '951-241-77-13'
                ],
                [
                    'ID'    => 38,
                    'key'   => 'SENDEOMP',
                    'value' => 'Sendeo Marketplace',
                    'phone' => '2910804196'
                ],
                [
                    'ID'    => 36,
                    'key'   => 'NETMP',
                    'value' => 'NetKargo Lojistik Marketplace',
                    'phone' => '6930094440'
                ],
                [
                    'ID'    => 34,
                    'key'   => 'MARSMP',
                    'value' => 'Mars Lojistik Marketplace',
                    'phone' => '6120538808'
                ],
                [
                    'ID'    => 39,
                    'key'   => 'BIRGUNDEMP',
                    'value' => 'Bir Günde Kargo Marketplace',
                    'phone' => '1770545653'
                ],
                [
                    'ID'    => 35,
                    'key'   => 'OCTOMP',
                    'value' => 'Octovan Lojistik Marketplace',
                    'phone' => '6330506845'
                ],
                [
                    'ID'    => 30,
                    'key'   => 'BORMP',
                    'value' => 'Borusan Lojistik Marketplace',
                    'phone' => '1800038254'
                ],
                [
                    'ID'    => 12,
                    'key'   => 'UPSMP',
                    'value' => 'UPS Kargo Marketplace',
                    'phone' => '9170014856'
                ],
                [
                    'ID'    => 13,
                    'key'   => 'AGTMP',
                    'value' => 'AGT Marketplace',
                    'phone' => '6090414309'
                ],
                [
                    'ID'    => 14,
                    'key'   => 'CAIMP',
                    'value' => 'Cainiao Marketplace',
                    'phone' => '0'
                ],
                [
                    'ID'    => 10,
                    'key'   => 'MNGMP',
                    'value' => 'MNG Kargo Marketplace',
                    'phone' => '6080712084'
                ],
                [
                    'ID'    => 19,
                    'key'   => 'PTTMP',
                    'value' => 'PTT Kargo Marketplace',
                    'phone' => '7320068060'
                ],
                [
                    'ID'    => 9,
                    'key'   => 'SURATMP',
                    'value' => 'Sürat Kargo Marketplace',
                    'phone' => '7870233582'
                ],
                [
                    'ID'    => 17,
                    'key'   => 'TEXMP',
                    'value' => 'Trendyol Express Marketplace',
                    'phone' => '8590921777'
                ],
                [
                    'ID'    => 6,
                    'key'   => 'HOROZMP',
                    'value' => 'Horoz Kargo Marketplace',
                    'phone' => '4630097122'
                ],
                [
                    'ID'    => 20,
                    'key'   => 'CEVAMP',
                    'value' => 'CEVA Marketplace',
                    'phone' => '8450298557'
                ],
                [
                    'ID'    => 4,
                    'key'   => 'YKMP',
                    'value' => 'Yurtiçi Kargo Marketplace',
                    'phone' => '3130557669'
                ],
                [
                    'ID'    => 7,
                    'key'   => 'ARASMP',
                    'value' => 'Aras Kargo Marketplace',
                    'phone' => '720039666'
                ]
            ];

            return $data;
        }

    }