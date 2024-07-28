<?php

	namespace Hasokeyk\Trendyol\Marketplace;

	use Hasokeyk\Trendyol\TrendyolRequest;

	class TrendyolMarketplaceCustomerQuestions{

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

		public function product(): TrendyolMarketplaceProducts{
			return new TrendyolMarketplaceProducts($this->trendyol);
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

		public function get_product_question_web($barcode = null){

			if($barcode != null){
				$product_info = $this->product()->get_my_product($barcode);
				if(isset($product_info->content[0])){
					$product_content_id = $product_info->content[0]->productContentId;

					$url_params = http_build_query([
						'page'           => 0,
						'storefrontId'   => 1,
						'culture'        => 'tr-TR',
						'contentId'      => $product_content_id,
						'fulfilmentType' => 'MP,ST,FT',
						'channelId'      => 1,
					]);

					$url  = 'https://public-mdc.trendyol.com/discovery-web-socialgw-service/api/questions/answered/filter?'.$url_params;
					$body = $this->request()->get($url);
					return $body;
				}
			}

			return false;
		}

	}