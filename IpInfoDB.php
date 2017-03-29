<?php 
	
	/**
	*
	* Basic PHP wrapper for the IPInfoDB Geolocation API <http://ipinfodb.com/>
	*
	* @author Daan De Smedt <daan.desmedt@sdp.be>
	* @date 29/03/2017
	*
	*/
	class IpInfoDB {
		
		/**
		* @const string API url
		*/
		const API_BASE_URL = 'http://api.ipinfodb.com';
		
		/**
		* @const string API version
		*/
		const API_VERSION = 'v3';
	
		/**
        * @var string API key
		* Register yourn own API key at <http://ipinfodb.com/register.php>
        */
		private $apiKey;
		
		/**
        * @var string responseFormat
		* API call request format - raw, xml, json
        */
		private $responseFormat;
	
		
		
		/**
		* Constructor
		*
		* @param string $apiKey
		* @param string $responseFormat (raw, xml, json)
		*/
		public function __construct($apiKey, $responseFormat){
			$this->apiKey = $apiKey;
			$this->responseFormat = $responseFormat;
		}
		
		
		/**
		* Get IP GEO by country precision
		*
		* @param string $ip - IP address
		*
		* @return string/false - data or false
		*
		*/
		public function getCountry($ip) {
			return $this->fetch($ip, 'ip-country');
		}
		
		
		/**
		* Get IP GEO by city precision
		*
		* @param string $ip - IP address
		*
		* @return string/false - data or false
		*
		*/
		public function getCity($ip) {
			return $this->fetch($ip, 'ip-city');
		}
  
		
		/**
		* Fetch GeoLocation data for IP with precision
		*
		* @param string $ip - IP to retrieve GeoLocation data
		* @param string $precision - API precision
		*
		* @return string/bool - data
		*/
		private function fetch($ip, $precision){
			
			// check valid IP
			if(!filter_var($ip, FILTER_VALIDATE_IP)){
				throw new Exception('Invalid IP');
			}
			
			// build API url
			$url = $this::API_BASE_URL . '/' . $this::API_VERSION . '/' . $precision . '/?key=' . $this->apiKey . '&ip='. $ip .'&format='. $this->responseFormat;
			
			// CURL handler
			$curl = curl_init();
			// Options
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			// fetch
			$response = curl_exec($curl);
			// response
			$errorCode = curl_errno($curl);
			$errorMessage = curl_error($curl);
			$HTTPCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			// close curl handler
			curl_close($curl);
			
			// check response
			if ($HTTPCode == '200'){
				if ($errorCode == 0){
					return $response;
				}else{
					throw new Exception('CURL ERROR <' . $errorMessage. '> for url <' . $url . '>');
					return false;
				}
			}else{
				throw new Exception('HTTP RESPONSE <' . $HTTPCode. '> for url <' . $url . '>');
				return false;
			}
			
		}		
		
	}
	
?>