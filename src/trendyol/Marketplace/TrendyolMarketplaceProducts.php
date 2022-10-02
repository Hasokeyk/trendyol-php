<?php

    namespace Hasokeyk\Trendyol\Marketplace;

    use Hasokeyk\Trendyol\TrendyolRequest;

    class TrendyolMarketplaceProducts{

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

        public function get_my_products($filter = []){
            $url = 'https://api.trendyol.com/sapigw/suppliers/'.$this->supplierId.'/products';

            $required_query_data = [
                'approved'      => 'true',
                'barcode'       => null,
                'startDate'     => null,
                'endDate'       => null,
                'page'          => 0,
                'dateQueryType' => 'CREATED_DATE',
                'size'          => null,
                'supplierId'    => $this->supplierId,
                'stockCode'     => null,
                'archived'      => null,
                'productMainId' => null,
            ];
            $required_query_data = array_merge($required_query_data, $filter);
            $new_url             = http_build_query($required_query_data);

            $result = $this->request()->get($url.'?'.$new_url);
            return $result;
        }

        public function get_my_product($barcode = null){

            if($barcode != null){

                $products = $this->get_my_products([
                    'barcode' => $barcode,
                ]);

                return $products;
            }

            return false;
        }

        public function create_product($data = []){
            $url = 'https://api.trendyol.com/sapigw/suppliers/'.$this->supplierId.'/v2/products';

            $post_data = [
                'items' => [
                    [
                        'barcode'            => $data['barcode'] ?? null,
                        'title'              => $data['title'] ?? null,
                        'productMainId'      => $data['barcode'] ?? null,
                        'brandId'            => $data['brandId'] ?? null,
                        'categoryId'         => $data['categoryId'] ?? null,
                        'quantity'           => $data['quantity'] ?? null,
                        'stockCode'          => $data['barcode'] ?? null,
                        'dimensionalWeight'  => $data['dimensionalWeight'] ?? null,
                        'description'        => $data['description'] ?? '',
                        'currencyType'       => $data['currencyType'] ?? 'TRY',
                        'listPrice'          => $data['listPrice'] ?? null,
                        'salePrice'          => $data['salePrice'] ?? null,
                        'cargoCompanyId'     => $data['cargoCompanyId'] ?? null,
                        'deliveryDuration'   => $data['deliveryDuration'] ?? null,
                        'deliveryOption'   => [
                            'deliveryDuration' => $data['deliveryDuration'],
//                            'fastDeliveryType' => 'SAME_DAY_SHIPPING'
                        ],
                        'images'             => $data['images'] ?? null,
                        'vatRate'            => $data['vatRate'] ?? '18',
                        'shipmentAddressId'  => $data['shipmentAddressId'] ?? null,
                        'returningAddressId' => $data['returningAddressId'] ?? null,
                        'attributes'         => $data['attributes'] ?? null,
                    ],
                ],
            ];

            $product_result = $this->request()->post($url, $post_data);
            if(isset($product_result->batchRequestId)){
                $result = $this->get_batch_request_result($product_result->batchRequestId);
            }
            else{
                $result = $product_result;
            }

            return $result;
        }

        public function update_product_info($barcode = null, $data = []){
            $url = 'https://api.trendyol.com/sapigw/suppliers/'.$this->supplierId.'/v2/products';

            $post_data = [
                'items' => [
                    [
                        'barcode'           => $barcode,
                        'title'             => $data['title'] ?? null,
                        'productMainId'     => $barcode,
                        'brandId'           => $data['brandId'] ?? null,
                        'categoryId'        => $data['categoryId'] ?? null,
                        'quantity'          => $data['quantity'] ?? null,
                        'stockCode'         => $barcode,
                        'dimensionalWeight' => $data['dimensionalWeight'] ?? null,
                        'description'       => $data['description'] ?? '',
                        'currencyType'      => $data['currencyType'] ?? 'TRY',
                        //                        'listPrice'          => $data['listPrice'] ?? null,
                        //                        'salePrice'          => $data['salePrice'] ?? null,
                        //                        'cargoCompanyId'     => $data['cargoCompanyId'] ?? null,
                        //                        'deliveryDuration'   => $data['deliveryDuration'] ?? null,
                        'images'            => $data['images'] ?? null,
                        'vatRate'           => $data['vatRate'] ?? '18',
                        //                        'shipmentAddressId'  => $data['shipmentAddressId'] ?? null,
                        //                        'returningAddressId' => $data['returningAddressId'] ?? null,
                        //                        'attributes'         => $data['attributes'] ?? null,
                    ],
                ],
            ];

            $product_result = $this->request()->put($url, $post_data);
            if(isset($product_result->batchRequestId)){
                $result = $this->get_batch_request_result($product_result->batchRequestId);
            }
            else{
                $result = $product_result;
            }

            return $result;
        }

        public function update_product_price_and_stock($barcode = null, $quantity = null, $sale_price = null, $list_price = null){
            $url = 'https://api.trendyol.com/sapigw/suppliers/'.$this->supplierId.'/products/price-and-inventory';

            $post_data = [
                'items' => [
                    [
                        'barcode'   => $barcode,
                        'quantity'  => $quantity,
                        'salePrice' => $sale_price,
                        'listPrice' => $list_price,
                    ],
                ],
            ];

            $product_result = $this->request()->post($url, $post_data);
            $result         = $this->get_batch_request_result($product_result->batchRequestId);

            return $result;
        }

        public function get_batch_request_result($batch_id = null){
            $url    = 'https://api.trendyol.com/sapigw/suppliers/'.$this->supplierId.'/products/batch-requests/'.$batch_id;
            $result = $this->request()->get($url);
            return $result;
        }

        public function update_product_title($barcode = null, $new_title = null){

            if($barcode != null and $new_title != null){

                $get_my_product = $this->get_my_product($barcode);
                if(isset($get_my_product->content)){

                    $product_info = $get_my_product->content[0];

                    $product_title              = $new_title;
                    $product_brand_id           = $product_info->brandId;
                    $product_desc               = $product_info->description;
                    $product_images             = $product_info->images;
                    $product_stock              = $product_info->quantity;
                    $product_category_id        = $product_info->pimCategoryId;
                    $product_dimensional_weight = $product_info->dimensionalWeight;
                    $product_vatRate            = $product_info->vatRate;

                    $product_info_data = [
                        'title'             => $product_title,
                        'brandId'           => $product_brand_id,
                        'categoryId'        => $product_category_id,
                        'quantity'          => $product_stock,
                        'dimensionalWeight' => $product_dimensional_weight,
                        'description'       => $product_desc,
                        'images'            => $product_images,
                        'vatRate'           => $product_vatRate,
                    ];

                    $update_product = $this->update_product_info($barcode, $product_info_data);
                    return $update_product;

                }

            }

            return false;
        }

        public function update_product_description($barcode = null, $new_desc= null){

            if($barcode != null and $new_desc != null){

                $get_my_product = $this->get_my_product($barcode);
                if(isset($get_my_product->content)){

                    $product_info = $get_my_product->content[0];

                    $product_title              = $product_info->title;
                    $product_brand_id           = $product_info->brandId;
                    $product_desc               = $new_desc;
                    $product_images             = $product_info->images;
                    $product_stock              = $product_info->quantity;
                    $product_category_id        = $product_info->pimCategoryId;
                    $product_dimensional_weight = $product_info->dimensionalWeight;
                    $product_vatRate            = $product_info->vatRate;

                    $product_info_data = [
                        'title'             => $product_title,
                        'brandId'           => $product_brand_id,
                        'categoryId'        => $product_category_id,
                        'quantity'          => $product_stock,
                        'dimensionalWeight' => $product_dimensional_weight,
                        'description'       => $product_desc,
                        'images'            => $product_images,
                        'vatRate'           => $product_vatRate,
                    ];

                    $update_product = $this->update_product_info($barcode, $product_info_data);
                    return $update_product;

                }

            }

            return false;
        }

        public function update_product_brand($barcode = null, $brand_id = null){

            if($barcode != null and $brand_id != null){

                $get_my_product = $this->get_my_product($barcode);
                if(isset($get_my_product->content)){

                    $product_info = $get_my_product->content[0];

                    $product_title              = $product_info->title;
                    $product_brand_id           = $brand_id;
                    $product_desc               = $product_info->description;
                    $product_images             = $product_info->images;
                    $product_stock              = $product_info->quantity;
                    $product_category_id        = $product_info->pimCategoryId;
                    $product_dimensional_weight = $product_info->dimensionalWeight;
                    $product_vatRate            = $product_info->vatRate;

                    $product_info_data = [
                        'title'             => $product_title,
                        'brandId'           => $product_brand_id,
                        'categoryId'        => $product_category_id,
                        'quantity'          => $product_stock,
                        'dimensionalWeight' => $product_dimensional_weight,
                        'description'       => $product_desc,
                        'images'            => $product_images,
                        'vatRate'           => $product_vatRate,
                    ];

                    $update_product = $this->update_product_info($barcode, $product_info_data);
                    return $update_product;

                }

            }

            return false;
        }

    }