<?php
    
    namespace Hasokeyk\Trendyol;
    
    use Exception;
    
    class TrendyolRequest{
        
        public $supplierId;
        public $username;
        public $password;
        public $cache_path;
        public $cache_time = 1440; //Minute
        
        function __construct($supplierId = null, $username = null, $password = null){
            $this->supplierId = $supplierId;
            $this->username   = $username;
            $this->password   = $password;
            $this->cache_path = (__DIR__).'/cache';
        }
        
        public function get($url, $headers = null, $authorization = true){
            
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
            
            $headers   = $headers ?? [];
            $headers[] = 'User-Agent: '.$this->userAgent();
            
            if($authorization){
                $headers[] = 'Authorization: Basic '.$this->authorization();
            }
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $result   = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if(!in_array($httpcode, [200, 400, 500]) or empty($result)){
                throw new Exception("Trendyol API'sine bağlanılamıyor.");
            }
            
            $result = json_decode($result);
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
            
            if(!in_array($httpcode, [200, 400, 500]) or empty($result)){
                throw new Exception("Trendyol API'sine bağlanılamıyor.");
            }
            
            $result = json_decode($result);
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
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
            
            $result   = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            if(!in_array($httpcode, [200, 400, 500]) or empty($result)){
                throw new Exception("Trendyol API'sine bağlanılamıyor.");
            }
            
            $result = json_decode($result);
            curl_close($ch);
            return $result;
            
        }
        
        protected function userAgent(){
            return $this->supplierId.' - HayatiKodla';
        }
        
        protected function authorization(){
            return base64_encode($this->username.':'.$this->password);
        }
        
        public function cache($cache_name, $content = false, $json = false, $rewrite = false){
            
            if($cache_name != null){
                
                $cache_file_path = $this->cache_path.'/';
                $cache_file      = $cache_file_path.($cache_name.'.json');
                
                if($rewrite === true){
                    goto rewrite;
                }
                
                if(file_exists($cache_file) and time() <= strtotime('+'.$this->cache_time.' minute', filemtime($cache_file))){
                    $content = file_get_contents($cache_file);
                    return json_decode($content);
                }
                else if($content !== false){
                    rewrite:
                    if($json){
                        file_put_contents($cache_file, $content);
                    }
                    else{
                        file_put_contents($cache_file, json_encode($content));
                    }
                    return $content;
                }
                
            }
            return false;
            
        }
        
    }