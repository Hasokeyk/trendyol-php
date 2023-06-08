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
                    'companay_name'     => 'DHL Marketplace',
                    'tax_number'        => '951-241-77-13'
                ],
                [
                    'ID'                => 38,
                    'company_shortname' => 'SENDEOMP',
                    'companay_name'     => 'Sendeo Marketplace',
                    'tax_number'        => '2910804196'
                ],
                [
                    'ID'                => 36,
                    'company_shortname' => 'NETMP',
                    'companay_name'     => 'NetKargo Lojistik Marketplace',
                    'tax_number'        => '6930094440'
                ],
                [
                    'ID'                => 34,
                    'company_shortname' => 'MARSMP',
                    'companay_name'     => 'Mars Lojistik Marketplace',
                    'tax_number'        => '6120538808'
                ],
                [
                    'ID'                => 39,
                    'company_shortname' => 'BIRGUNDEMP',
                    'companay_name'     => 'Bir Günde Kargo Marketplace',
                    'tax_number'        => '1770545653'
                ],
                [
                    'ID'                => 35,
                    'company_shortname' => 'OCTOMP',
                    'companay_name'     => 'Octovan Lojistik Marketplace',
                    'tax_number'        => '6330506845'
                ],
                [
                    'ID'                => 30,
                    'company_shortname' => 'BORMP',
                    'companay_name'     => 'Borusan Lojistik Marketplace',
                    'tax_number'        => '1800038254'
                ],
                [
                    'ID'                => 12,
                    'company_shortname' => 'UPSMP',
                    'companay_name'     => 'UPS Kargo Marketplace',
                    'tax_number'        => '9170014856'
                ],
                [
                    'ID'                => 13,
                    'company_shortname' => 'AGTMP',
                    'companay_name'     => 'AGT Marketplace',
                    'tax_number'        => '6090414309'
                ],
                [
                    'ID'                => 14,
                    'company_shortname' => 'CAIMP',
                    'companay_name'     => 'Cainiao Marketplace',
                    'tax_number'        => '0'
                ],
                [
                    'ID'                => 10,
                    'company_shortname' => 'MNGMP',
                    'companay_name'     => 'MNG Kargo Marketplace',
                    'tax_number'        => '6080712084'
                ],
                [
                    'ID'                => 19,
                    'company_shortname' => 'PTTMP',
                    'companay_name'     => 'PTT Kargo Marketplace',
                    'tax_number'        => '7320068060'
                ],
                [
                    'ID'                => 9,
                    'company_shortname' => 'SURATMP',
                    'companay_name'     => 'Sürat Kargo Marketplace',
                    'tax_number'        => '7870233582'
                ],
                [
                    'ID'                => 17,
                    'company_shortname' => 'TEXMP',
                    'companay_name'     => 'Trendyol Express Marketplace',
                    'tax_number'        => '8590921777'
                ],
                [
                    'ID'                => 6,
                    'company_shortname' => 'HOROZMP',
                    'companay_name'     => 'Horoz Kargo Marketplace',
                    'tax_number'        => '4630097122'
                ],
                [
                    'ID'                => 20,
                    'company_shortname' => 'CEVAMP',
                    'companay_name'     => 'CEVA Marketplace',
                    'tax_number'        => '8450298557'
                ],
                [
                    'ID'                => 4,
                    'company_shortname' => 'YKMP',
                    'companay_name'     => 'Yurtiçi Kargo Marketplace',
                    'tax_number'        => '3130557669'
                ],
                [
                    'ID'                => 7,
                    'company_shortname' => 'ARASMP',
                    'companay_name'     => 'Aras Kargo Marketplace',
                    'tax_number'        => '720039666'
                ]
            ];

            return $data;
        }

    }