<?php
	
	namespace Hasokeyk\Trendyol\Marketplace;
	
	use Hasokeyk\Trendyol\TrendyolRequest;
	class TrendyolMarketplaceStore{
		
		public $supplierId;
		public $username;
		public $password;
		public $trendyol;
		
		function __construct($trendyol){
			$this->supplierId = $trendyol->supplierId;
			$this->username   = $trendyol->username;
			$this->password   = $trendyol->password;
			$this->trendyol   = $trendyol;
		}
		
		function request():TrendyolRequest{
			return $this->trendyol->request;
		}
		
		public function get_store_info($store_id = null){
			$url = 'https://apigw.trendyol.com/discovery-pdp-websfxsellerstorecore-santral/store-headers/'.$store_id;
			
			$required_query_data = [
				'culture'   => 'tr-TR',
				'channelId' => 1,
			];
			$required_query_data = array_merge($required_query_data, ($filter ?? []));
			
			$headers = [
				'accept: application/json',
				'accept-language: tr,en;q=0.9',
				'content-type: application/json',
				'if-none-match: W/"59-sQGkP052fBPsEpA07yJX3KXuy8M"',
				'origin: https://www.trendyol.com',
				'priority: u=1, i',
				'sec-ch-ua: "Not;A=Brand";v="99", "Google Chrome";v="139", "Chromium";v="139"',
				'sec-ch-ua-mobile: ?1',
				'sec-ch-ua-platform: "Android"',
				'sec-fetch-dest: empty',
				'sec-fetch-mode: cors',
				'sec-fetch-site: same-site',
				'user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36',
				'Cookie: storefrontId=1; language=en; countryCode=TR;',
			];
			
			$new_url = $url.'?'.http_build_query($required_query_data);
			return $this->request()->get($new_url, $headers, false);
		}
		
		public function get_store_follower($store_id = null){
			$url = 'https://apigw.trendyol.com/discovery-sellerstore-gateway-service/api/follow/';
			
			$required_query_data = [
				'sellerId' => $store_id,
				'culture'  => 'tr-TR',
			];
			$required_query_data = array_merge($required_query_data, ($filter ?? []));
			
			$headers = [
				'accept: application/json',
				'accept-language: tr,en;q=0.9',
				'content-type: application/json',
				'if-none-match: W/"59-sQGkP052fBPsEpA07yJX3KXuy8M"',
				'origin: https://www.trendyol.com',
				'priority: u=1, i',
				'sec-ch-ua: "Not;A=Brand";v="99", "Google Chrome";v="139", "Chromium";v="139"',
				'sec-ch-ua-mobile: ?1',
				'sec-ch-ua-platform: "Android"',
				'sec-fetch-dest: empty',
				'sec-fetch-mode: cors',
				'sec-fetch-site: same-site',
				'user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36',
				'Cookie: storefrontId=1; language=en; countryCode=TR;',
			];
			
			$new_url = $url.'?'.http_build_query($required_query_data);
			return $this->request()->get($new_url, $headers, false);
		}
		
		public function get_store_product_social_proof($product_id = null){
			$url = 'https://apigw.trendyol.com/discovery-sfint-search-service/api/social-proof/';
			
			$required_query_data = [
				'contentIds'   => is_array($product_id) ? $product_id : [$product_id],
				'culture'      => 'tr-TR',
				'channelId'    => 1,
				'storefrontId' => 1,
			];
			$required_query_data = array_merge($required_query_data, ($filter ?? []));
			
			$headers = [
				'accept: application/json',
				'accept-language: tr,en;q=0.9',
				'content-type: application/json',
				'if-none-match: W/"59-sQGkP052fBPsEpA07yJX3KXuy8M"',
				'origin: https://www.trendyol.com',
				'priority: u=1, i',
				'sec-ch-ua: "Not;A=Brand";v="99", "Google Chrome";v="139", "Chromium";v="139"',
				'sec-ch-ua-mobile: ?1',
				'sec-ch-ua-platform: "Android"',
				'sec-fetch-dest: empty',
				'sec-fetch-mode: cors',
				'sec-fetch-site: same-site',
				'user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36',
				'Cookie: storefrontId=1; language=en; countryCode=TR;',
			];
			
			$new_url = $url.'?'.http_build_query($required_query_data);
			return $this->request()->get($new_url, $headers, false);
		}
		
	}