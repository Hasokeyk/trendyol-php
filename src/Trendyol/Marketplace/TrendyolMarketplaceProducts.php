<?php

	namespace Hasokeyk\Trendyol\Marketplace;

	class TrendyolMarketplaceProducts{

		public  $supplierId;
		public  $username;
		public  $password;
		private $trendyol;

		function __construct($trendyol){
			$this->supplierId = $trendyol->supplierId;
			$this->username   = $trendyol->username;
			$this->password   = $trendyol->password;
			$this->trendyol   = $trendyol;
		}

		private function request(){
			return $this->trendyol->request;
		}

		public function get_my_products($filter = []){
			$url = 'https://apigw.trendyol.com/integration/product/sellers/'.($this->supplierId).'/products';

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
			return $this->request()->get($url.'?'.$new_url);
		}

		public function get_my_product($barcode = null){

			if($barcode != null){

				$product_main_id_products = $this->get_my_products([
					'productMainId' => $barcode,
				]);

				if(isset($product_main_id_products->status, $product_main_id_products->body) and $product_main_id_products->status == 'success' and $product_main_id_products->body->totalElements > 0){
					return $product_main_id_products;
				}

				$barcode_product = $this->get_my_products([
					'barcode' => $barcode,
				]);

				if(isset($barcode_product->status, $barcode_product->body) and $barcode_product->status == 'success' and $barcode_product->body->totalElements > 0){
					return $barcode_product;
				}

				$stock_code_products = $this->get_my_products([
					'stockCode' => $barcode,
				]);

				if(isset($stock_code_products->status, $stock_code_products->body) and $stock_code_products->status == 'success' and $stock_code_products->body->totalElements > 0){
					return $stock_code_products;
				}

			}

			return false;
		}

		public function create_multi_product($data = []){
			$url                = 'https://apigw.trendyol.com/integration/product/sellers/'.$this->supplierId.'/products';
			$post_data['items'] = $data;
			return $this->request()->post($url, $post_data);
		}

		public function create_product($data = []){
			$url = 'https://apigw.trendyol.com/integration/product/sellers/'.$this->supplierId.'/products';

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

			return $this->request()->post($url, $post_data);
		}

		public function update_product_info($barcode = null, $data = []){
			$url = 'https://apigw.trendyol.com/integration/product/sellers/'.$this->supplierId.'/products';

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
						'description'       => $data['description'] ?? null,
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

			return $this->request()->put($url, $post_data);
		}

		public function update_product_price_and_stock($barcode = null, $quantity = null, $sale_price = null, $list_price = null){
			$url = 'https://apigw.trendyol.com/integration/inventory/sellers/'.$this->supplierId.'/products/price-and-inventory';

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

			return $this->request()->post($url, $post_data);
		}

		public function get_batch_request_result($batch_id = null){
			$url = 'https://apigw.trendyol.com/integration/product/sellers/'.$this->supplierId.'/products/batch-requests/'.$batch_id;
			return $this->request()->get($url);
		}

		public function update_product_title($barcode = null, $new_title = null){
			if($barcode != null and $new_title != null){
				$get_my_product = $this->get_my_product($barcode);
				if(isset($get_my_product->status, $get_my_product->body) and $get_my_product->status == 'success' and $get_my_product->body->totalElements > 0){
					$product_info = $get_my_product->body->content[0];
					foreach($product_info->attributes as $id => $attribute){
						$product_info->attributes[$id]->customAttributeValue = $attribute->attributeValue;
					}
					$product_info->title = $new_title;
					return $this->update_product_info($barcode, (array)$product_info);
				}
			}
			return false;
		}

		public function update_product_description($barcode = null, $new_desc = null){
			if($barcode != null and $new_desc != null){
				$get_my_product = $this->get_my_product($barcode);
				if(isset($get_my_product->status, $get_my_product->body) and $get_my_product->status == 'success' and $get_my_product->body->totalElements > 0){
					$product_info = $get_my_product->body->content[0];
					foreach($product_info->attributes as $id => $attribute){
						$product_info->attributes[$id]->customAttributeValue = $attribute->attributeValue;
					}
					$product_info->description = $new_desc;
					return $this->update_product_info($barcode, (array)$product_info);
				}
			}
			return false;
		}

		public function update_product_brand($barcode = null, $brand_id = null){
			if($barcode != null and $brand_id != null){
				$get_my_product = $this->get_my_product($barcode);
				if(isset($get_my_product->status, $get_my_product->body) and $get_my_product->status == 'success' and $get_my_product->body->totalElements > 0){
					$product_info = $get_my_product->body->content[0];
					foreach($product_info->attributes as $id => $attribute){
						$product_info->attributes[$id]->customAttributeValue = $attribute->attributeValue;
					}
					$product_info->brandId = $brand_id;
					return $this->update_product_info($barcode, (array)$product_info);
				}
			}
			return false;
		}

		public function update_product_images($barcode = null, $images = null){
			if($barcode != null and $images != null){
				$get_my_product = $this->get_my_product($barcode);
				if(isset($get_my_product->status, $get_my_product->body) and $get_my_product->status == 'success' and $get_my_product->body->totalElements > 0){
					$product_info = $get_my_product->body->content[0];
					foreach($product_info->attributes as $id => $attribute){
						$product_info->attributes[$id]->customAttributeValue = $attribute->attributeValue;
					}
					$product_info->images = $images;
					return $this->update_product_info($barcode, (array)$product_info);
				}
			}
			return false;
		}

		public function get_product_comment($barcode, $page = 0, $rating = null, $only_seller_reviews = false, $order_number = 1){

			if($barcode != null){
				$product_info = $this->get_my_product($barcode);
				if(isset($product_info->body->content[0])){
					$product_content_id = $product_info->body->content[0]->productContentId ?? 0;

					$headers = [
						'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
						'Accept-Language: en-US,en;q=0.5',
						'Accept-Encoding: deflate, b, php, html, txt',
						'Connection: keep-alive',
						'Upgrade-Insecure-Requests: 1'
					];

					$url_params = http_build_query([
						'merchantId' => $this->supplierId,
						'logged-in'  => false,
						'isBuyer'    => false,
						'contentId'  => $product_content_id,

					]);
					$url        = 'https://apigw.trendyol.com/discovery-web-socialgw-service/reviews/heiluna/urun-p-'.$product_content_id.'/yorumlar?'.$url_params;
					$body       = $this->request()->get($url, $headers, false);
					preg_match('/{(.*?)};/ius', $body->body->result->hydrateScript, $matches);
					$json   = json_decode(rtrim($matches[0], ';'));
					$result = json_encode(['result' => $json->ratingAndReviewResponse->ratingAndReview ?? []]);
					return json_decode($result);
				}
			}

			return false;
		}
	}