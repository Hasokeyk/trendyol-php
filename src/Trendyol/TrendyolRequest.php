<?php

	namespace Hasokeyk\Trendyol;

	use Exception;

	class TrendyolRequest{

		public $supplierId;
		public $username;
		public $password;
		public $cache_path;
		public $cache_time = 1440; //Minute

		function __construct($trendyol){

			$this->supplierId = $trendyol->supplierId;
			$this->username   = $trendyol->username;
			$this->password   = $trendyol->password;

			if($trendyol->test){
				$this->api_url = 'https://stageapi.trendyol.com/stagesapigw/';
			}
			else{
				$this->api_url = 'https://api.trendyol.com/sapigw/';
			}

		}

		public function get($url, $headers = null, $authorization = true){

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

			$headers = $headers ?? [];

			if($authorization){
				$headers[] = 'Authorization: Basic '.$this->authorization();
				$headers[] = 'User-Agent: '.$this->userAgent();
			}

			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result   = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			if(curl_errno($ch)){
				throw new Exception("cURL Hatası: ".curl_error($ch));
			}

			if(empty($result) and $httpcode != 200){
				throw new Exception("Trendyol API'sine bağlanılamıyor. HTTP Kodu: $httpcode");
			}

			$results = json_encode([
				'http_code' => $httpcode,
				'status'    => $httpcode == 200 ? 'success' : 'fail',
				'body'      => json_decode($result),
			]);

			$result = json_decode($results);
			curl_close($ch);
			return $result;

		}

		public function post($url, $post_data = null, $headers = null, $authorization = true){

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

			$headers   = $headers ?? [];
			$headers[] = 'User-Agent: '.$this->userAgent();

			if($authorization){
				$headers[] = 'Authorization: Basic '.$this->authorization();
			}
			$headers[] = 'Content-Type: application/json';

			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

			$result   = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			if(curl_errno($ch)){
				throw new Exception("cURL Hatası: ".curl_error($ch));
			}

			if(empty($result) and $httpcode != 200){
				throw new Exception("Trendyol API'sine bağlanılamıyor. HTTP Kodu: $httpcode");
			}

			$results = json_encode([
				'http_code' => $httpcode,
				'status'    => $httpcode == 200 ? 'success' : 'fail',
				'body'      => json_decode($result),
			]);

			$result = json_decode($results);
			curl_close($ch);
			return $result;

		}

		public function put($url, $post_data = null, $headers = null, $authorization = true){

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

			$headers   = $headers ?? [];
			$headers[] = 'User-Agent: '.$this->userAgent();

			if($authorization){
				$headers[] = 'Authorization: Basic '.$this->authorization();
			}
			$headers[] = 'Content-Type: application/json';

			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			if(!is_null($post_data)){
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
			}

			$result   = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			if(curl_errno($ch)){
				throw new Exception("cURL Hatası: ".curl_error($ch));
			}

			if(empty($result) and $httpcode != 200){
				throw new Exception("Trendyol API'sine bağlanılamıyor. HTTP Kodu: $httpcode");
			}

			$results = json_encode([
				'http_code' => $httpcode,
				'status'    => $httpcode == 200 ? 'success' : 'fail',
				'body'      => json_decode($result),
			]);

			$result = json_decode($results);
			curl_close($ch);
			return $result;

		}

		public function delete($url, $post_data = null, $headers = null, $authorization = true){

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

			$headers   = $headers ?? [];
			$headers[] = 'User-Agent: '.$this->userAgent();

			if($authorization){
				$headers[] = 'Authorization: Basic '.$this->authorization();
			}
			$headers[] = 'Content-Type: application/json';

			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			if(!is_null($post_data)){
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
			}

			$result   = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			if(curl_errno($ch)){
				throw new Exception("cURL Hatası: ".curl_error($ch));
			}

			if(empty($result) and $httpcode != 200){
				throw new Exception("Trendyol API'sine bağlanılamıyor. HTTP Kodu: $httpcode");
			}

			$results = json_encode([
				'http_code' => $httpcode,
				'status'    => $httpcode == 200 ? 'success' : 'fail',
				'body'      => json_decode($result),
			]);

			$result = json_decode($results);
			curl_close($ch);
			return $result;
		}


		protected function userAgent(){
			return $this->supplierId.' - HayatiKodla';
		}

		protected function authorization(){
			return base64_encode($this->username.':'.$this->password);
		}

	}