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
                    'ID'                => 42,
                    'company_shortname' => 'DHLMP',
                    'company_name'     => 'DHL Marketplace',
                    'tax_number'        => '951-241-77-13'
                ],
                [
                    'ID'                => 38,
                    'company_shortname' => 'SENDEOMP',
                    'company_name'     => 'Sendeo Marketplace',
                    'tax_number'        => '2910804196'
                ],
                [
                    'ID'                => 36,
                    'company_shortname' => 'NETMP',
                    'company_name'     => 'NetKargo Lojistik Marketplace',
                    'tax_number'        => '6930094440'
                ],
                [
                    'ID'                => 34,
                    'company_shortname' => 'MARSMP',
                    'company_name'     => 'Mars Lojistik Marketplace',
                    'tax_number'        => '6120538808'
                ],
                [
                    'ID'                => 39,
                    'company_shortname' => 'BIRGUNDEMP',
                    'company_name'     => 'Bir Günde Kargo Marketplace',
                    'tax_number'        => '1770545653'
                ],
                [
                    'ID'                => 35,
                    'company_shortname' => 'OCTOMP',
                    'company_name'     => 'Octovan Lojistik Marketplace',
                    'tax_number'        => '6330506845'
                ],
                [
                    'ID'                => 30,
                    'company_shortname' => 'BORMP',
                    'company_name'     => 'Borusan Lojistik Marketplace',
                    'tax_number'        => '1800038254'
                ],
                [
                    'ID'                => 12,
                    'company_shortname' => 'UPSMP',
                    'company_name'     => 'UPS Kargo Marketplace',
                    'tax_number'        => '9170014856'
                ],
                [
                    'ID'                => 13,
                    'company_shortname' => 'AGTMP',
                    'company_name'     => 'AGT Marketplace',
                    'tax_number'        => '6090414309'
                ],
                [
                    'ID'                => 14,
                    'company_shortname' => 'CAIMP',
                    'company_name'     => 'Cainiao Marketplace',
                    'tax_number'        => '0'
                ],
                [
                    'ID'                => 10,
                    'company_shortname' => 'MNGMP',
                    'company_name'     => 'MNG Kargo Marketplace',
                    'tax_number'        => '6080712084'
                ],
                [
                    'ID'                => 19,
                    'company_shortname' => 'PTTMP',
                    'company_name'     => 'PTT Kargo Marketplace',
                    'tax_number'        => '7320068060'
                ],
                [
                    'ID'                => 9,
                    'company_shortname' => 'SURATMP',
                    'company_name'     => 'Sürat Kargo Marketplace',
                    'tax_number'        => '7870233582'
                ],
                [
                    'ID'                => 17,
                    'company_shortname' => 'TEXMP',
                    'company_name'     => 'Trendyol Express Marketplace',
                    'tax_number'        => '8590921777'
                ],
                [
                    'ID'                => 6,
                    'company_shortname' => 'HOROZMP',
                    'company_name'     => 'Horoz Kargo Marketplace',
                    'tax_number'        => '4630097122'
                ],
                [
                    'ID'                => 20,
                    'company_shortname' => 'CEVAMP',
                    'company_name'     => 'CEVA Marketplace',
                    'tax_number'        => '8450298557'
                ],
                [
                    'ID'                => 4,
                    'company_shortname' => 'YKMP',
                    'company_name'     => 'Yurtiçi Kargo Marketplace',
                    'tax_number'        => '3130557669'
                ],
                [
                    'ID'                => 7,
                    'company_shortname' => 'ARASMP',
                    'company_name'     => 'Aras Kargo Marketplace',
                    'tax_number'        => '720039666'
                ]
            ];

            return $data;
        }

    }