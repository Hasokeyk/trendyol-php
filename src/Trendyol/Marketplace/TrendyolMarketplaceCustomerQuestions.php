<?php

	namespace Hasokeyk\Trendyol\Marketplace;

	class TrendyolMarketplaceCustomerQuestions{

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

		function request(){
			return $this->trendyol->request;
		}

		public function product(): TrendyolMarketplaceProducts{
			return new TrendyolMarketplaceProducts($this->trendyol);
		}

		public function get_my_customer_questions($filter){

			$url                 = "https://apigw.trendyol.com/integration/qna/sellers/{$this->supplierId}/questions/filter";
			$required_query_data = [
				'barcode'            => null,
				'page'               => null,
				'size'               => null,
				'supplierId'         => $this->supplierId,
				'endDate'            => null,
				'startDate'          => null,
				'status'             => 'ANSWERED',
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
			$url = "https://apigw.trendyol.com/integration/qna/sellers/{$this->supplierId}/questions/{$question_id}/answers";

			$post_data = [
				'text' => $answer,
			];

			$result = $this->request()->post($url, $post_data);
			return $result;
		}

		public function get_product_question_web($barcode = null){

			if($barcode != null){
				$product_info = $this->product()->get_my_product($barcode);
				if(isset($product_info->body->content[0])){

					$product_content_id = $product_info->body->content[0]->productContentId??$product_info->body->content[0]->platformListingId;

					$url_params = http_build_query([
						'sellerId'  => $this->supplierId,
						'contentId' => $product_content_id,
						'pageSize'  => 10,
						'channelId' => 1,
					]);

					$url  = 'https://apigw.trendyol.com/discovery-web-websfxsocialreviewrating-santral/product-reviews-detailed?'.$url_params;
					return $this->request()->get($url);
				}
			}

			return false;
		}

	}