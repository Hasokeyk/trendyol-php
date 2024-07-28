<?php

	namespace Hasokeyk\Trendyol\Marketplace;

	class TrendyolMarketplaceProducts{

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

		function request(){
			return $this->trendyol->request;
		}

		public function get_my_products($filter = []){

			//			$url = 'https://api.trendyol.com/sapigw/suppliers/'.$this->supplierId.'/products';
			$url = $this->trendyol->request->api_url.'suppliers/'.$this->supplierId.'/products';

			$required_query_data = [
				'barcode'       => null,
				'startDate'     => null,
				'endDate'       => null,
				'page'          => 0,
				'dateQueryType' => null,
				'size'          => 1000,
				'supplierId'    => $this->supplierId,
			];
			if(is_array($filter)){
				$required_query_data = array_merge($required_query_data, $filter);
			}
			$new_url = http_build_query($required_query_data);
			$result  = $this->request()->get($url.'?'.$new_url);

			return $result;
		}

		public function get_my_product($barcode = null){

			if($barcode != null){

				$product_main_id_products = $this->get_my_products([
					'productMainId' => $barcode,
				]);

				if(isset($product_main_id_products->totalElements) and $product_main_id_products->totalElements > 0){
					return $product_main_id_products;
				}

				$barcode_product = $this->get_my_products([
					'barcode' => $barcode,
				]);

				if(isset($barcode_product->totalElements) and $barcode_product->totalElements > 0){
					return $barcode_product;
				}

				$stock_code_products = $this->get_my_products([
					'stockCode' => $barcode,
				]);

				if(isset($stock_code_products->totalElements) and $stock_code_products->totalElements > 0){
					return $stock_code_products;
				}
			}

			return false;
		}

		public function create_product($data = []){
			$url = 'https://api.trendyol.com/sapigw/suppliers/'.$this->supplierId.'/v2/products';
			$url = $this->request()->api_url.'suppliers/'.$this->supplierId.'/v2/products';

			$post_data = [
				'items' => [
					[
						'barcode'            => $data['barcode'] ?? null,
						'title'              => $data['title'] ?? null,
						'productMainId'      => $data['productMainId'] ?? null,
						'brandId'            => $data['brandId'] ?? null,
						'categoryId'         => $data['categoryId'] ?? null,
						'quantity'           => $data['quantity'] ?? null,
						'stockCode'          => $data['stockCode'] ?? null,
						'dimensionalWeight'  => $data['dimensionalWeight'] ?? null,
						'description'        => $data['description'] ?? '',
						'currencyType'       => $data['currencyType'] ?? 'TRY',
						'listPrice'          => $data['listPrice'] ?? null,
						'salePrice'          => $data['salePrice'] ?? null,
						'cargoCompanyId'     => $data['cargoCompanyId'] ?? null,
						'deliveryOption'     => [
							'deliveryDuration' => $data['deliveryDuration'] ?? null,
							'fastDeliveryType' => $data['fastDeliveryType'] ?? null,
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
			$url = $this->request()->api_url.'suppliers/'.$this->supplierId.'/v2/products';

			$post_data = [
				'items' => [
					[
						'barcode'           => $barcode,
						'title'             => $data['title'] ?? null,
						'productMainId'     => $data['productMainId'] ?? null,
						'brandId'           => $data['brandId'] ?? null,
						'categoryId'        => $data['categoryId'] ?? ($data['pimCategoryId'] ?? null),
						'quantity'          => $data['quantity'] ?? null,
						'stockCode'         => $data['stockCode'] ?? null,
						'dimensionalWeight' => $data['dimensionalWeight'] ?? null,
						'description'       => $data['description'] ?? '',
						'currencyType'      => $data['currencyType'] ?? 'TRY',
						//                        'listPrice'          => $data['listPrice'] ?? null,
						//                        'salePrice'          => $data['salePrice'] ?? null,
						//                        'cargoCompanyId'     => $data['cargoCompanyId'] ?? null,
						//                        'deliveryDuration'   => $data['deliveryDuration'] ?? null,
						'images'            => $data['images'] ?? null,
						'vatRate'           => $data['vatRate'] ?? '20',
						//                        'shipmentAddressId'  => $data['shipmentAddressId'] ?? null,
						//                        'returningAddressId' => $data['returningAddressId'] ?? null,
						'attributes'        => $data['attributes'] ?? null,
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
			//			$url = 'https://api.trendyol.com/sapigw/suppliers/'.$this->supplierId.'/products/price-and-inventory';
			$url = $this->request()->api_url.'suppliers/'.$this->supplierId.'/products/price-and-inventory';

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
			//			$url    = 'https://api.trendyol.com/sapigw/suppliers/'.$this->supplierId.'/products/batch-requests/'.$batch_id;
			$url    = $this->request()->api_url.'suppliers/'.$this->supplierId.'/products/batch-requests/'.$batch_id;
			$result = $this->request()->get($url);
			return $result;
		}

		public function update_product_title($barcode = null, $new_title = null){
			if($barcode != null and $new_title != null){
				$get_my_product = $this->get_my_product($barcode);
				if(isset($get_my_product->content)){
					$product_info = json_decode(json_encode($get_my_product->content[0]), true);
					foreach($product_info['attributes'] as $id => $attribute){
						$product_info['attributes'][$id]['customAttributeValue'] = $attribute['attributeValue'];
					}
					$product_info['title'] = $new_title;
					$update_product        = $this->update_product_info($barcode, $product_info);
					return $update_product;
				}
			}

			return false;
		}

		public function update_product_description($barcode = null, $new_desc = null){
			if($barcode != null and $new_desc != null){
				$get_my_product = $this->get_my_product($barcode);
				if(isset($get_my_product->content)){
					$product_info = json_decode(json_encode($get_my_product->content[0]), true);
					foreach($product_info['attributes'] as $id => $attribute){
						$product_info['attributes'][$id]['customAttributeValue'] = $attribute['attributeValue'];
					}
					$product_info['description'] = $new_desc;
					$update_product              = $this->update_product_info($barcode, $product_info);
					return $update_product;
				}
			}
		}

		public function update_product_brand($barcode = null, $brand_id = null){
			if($barcode != null and $brand_id != null){
				$get_my_product = $this->get_my_product($barcode);
				if(isset($get_my_product->content)){
					$product_info = json_decode(json_encode($get_my_product->content[0]), true);
					foreach($product_info['attributes'] as $id => $attribute){
						$product_info['attributes'][$id]['customAttributeValue'] = $attribute['attributeValue'];
					}
					$product_info['brandId'] = $brand_id;
					$update_product          = $this->update_product_info($barcode, $product_info);
					return $update_product;
				}
			}

			return false;
		}

		public function update_product_images($barcode = null, $images = null){
			if($barcode != null and $images != null){
				$get_my_product = $this->get_my_product($barcode);
				if(isset($get_my_product->content)){
					$product_info = json_decode(json_encode($get_my_product->content[0]), true);
					foreach($product_info['attributes'] as $id => $attribute){
						$product_info['attributes'][$id]['customAttributeValue'] = $attribute['attributeValue'];
					}
					$product_info['images'] = $images;
					$update_product         = $this->update_product_info($barcode, $product_info);
					return $update_product;
				}
			}

			return false;
		}

		public function get_product_comment($barcode = null, $page = 0, $rating = null, $only_seller_reviews = false, $order_number = 1){

			if($barcode != null){
				$product_info = $this->get_my_product($barcode);
				if(isset($product_info->content[0])){
					$product_content_id = $product_info->content[0]->productContentId;

					$url_params = http_build_query([
						'merchantId'        => $this->supplierId,
						'storefrontId'      => 1,
						'culture'           => 'tr-TR',
						'order'             => $order_number, //SIRALAMA 5 -> ÖNERİLEN  | 2 -> ESKİDEN YENİDE | 1 -> YENİDEN ESKİYE
						'searchValue'       => '',
						'onlySellerReviews' => $only_seller_reviews, //SADECE BU SATICI
						'ratingValues'      => $rating,
						'page'              => $page,
						'channelId'         => 1,
						'size'              => 1,
					]);

					$url  = 'https://public-mdc.trendyol.com/discovery-web-socialgw-service/api/review/'.$product_content_id.'?'.$url_params;
					$body = $this->request()->get($url);

					if(isset($body->result) and $body->result != null){
						return $body;
					}
				}
			}

			return false;
		}

	}