<?php

	namespace Hasokeyk\Trendyol\Marketplace;

	class TrendyolMarketplaceWebhook{

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

		public function get_my_webhooks(){
			$url    = 'https://apigw.trendyol.com/integration/webhook/sellers/'.$this->supplierId.'/webhooks';
			$result = $this->request()->get($url);
			return $result;
		}

		public function create_webhook($webhook_url = null, $username = null, $password = null){

			if($webhook_url != null){

				$url = 'https://apigw.trendyol.com/integration/webhook/sellers/'.$this->supplierId.'/webhooks';

				$post_data = [
					'url'      => $webhook_url,
					'username' => $username ?? $this->username,
					'password' => $password ?? $this->password
				];

				$result = $this->request()->post($url, $post_data);
				return $result;

			}

			return false;
		}

		public function update_webhook($webhook_id = null, $new_webhook_url = null){

			if($webhook_id != null and $new_webhook_url != null){

				$url = 'https://apigw.trendyol.com/integration/webhook/sellers/'.$this->supplierId.'/webhooks/'.$webhook_id;

				$post_data = [
					'url'      => $new_webhook_url,
					'username' => $this->username,
					'password' => $this->password
				];

				$result = $this->request()->put($url, $post_data);
				return $result;

			}

			return false;
		}

		public function del_webhook($webhook_id = null, $new_webhook_url = null){

			if($webhook_id != null and $new_webhook_url != null){
				$url    = 'https://apigw.trendyol.com/integration/webhook/sellers/'.$this->supplierId.'/webhooks/'.$webhook_id;
				$result = $this->request()->delete($url);
				return $result;
			}

			return false;
		}

		public function callback_webhook(){
			$json = file_get_contents('php://input');
			return $json;
		}

	}