<?php 
	
class Github {
	
	/**
	 * API options
	 */
	private $_url = 'https://api.github.com';
	private $_username = null;
	private $_password = null;
	
	/**
	 * Errors
	 */
	private $_errors = array();
	
	/**
	 * Pagination
	 */
	public $page = null;
	public $perPage = null;
	
	/**
	 * Construct with github account
	 *
	 * @param string $username Default: null
	 * @param string $password Default: null
	 */
	public function __construct($username = null, $password = null) {
		$this->_username = $username;
		$this->_password = $password;
	}
	
	/**
	 * Reset the pagination options
	 */
	private function _resetPagination() {
		$this->page = null;
		$this->perPage = null;
	}
	
	/**
	 * Construct complete url
	 *
	 * @param string $ressource
	 * @param array $params Default: array()
	 */
	private function _parseUrl($ressource, $params = array()) {
		$set = false;
		
		$url = $this->_url;
		$url .= $ressource;
		
		if (!is_null($this->page)) {
			$set = true;
			$url .= '?page='.$this->page;
			
			if (!is_null($this->perPage)) {
				$url .= '&per_page='.$this->perPage;
			}
		}
		elseif (!is_null($this->perPage)) {
			$set = true;
			$url .= '?per_page='.$this->perPage;
		}
		
		if (is_array($params) and (!empty($params))) {
			foreach ($params as $k => $v) {
				if ($set) {
					$url .= '&';
				}
				else {
					$set = true;
					$url .= '?';
				}
				
				$url .= $k.'='.$v;
			}
		}
		
		$this->_resetPagination();
		
		return $url;
	}
	
	private function _parseParams($params = array()) {
		if (is_array($params) and !empty($params)) {
			$return = array();
			
			foreach ($params as $k => $v) {
				if ($v !== false) {
					$return[$k] = $v;
				}
			}
		}
		else {
			$return = $params;
		}
		
		return $return;
	}
	
	/**
	 * Add error to error list
	 *
	 * @param string $url Request url
	 * @param string $message Error message. Default: ''
	 * @param int $code HTTP error code. Default: 0
	 * @param array $errors Error details. Default: array()
	 * @param array $params Request params. Default: array()
	 */
	public function addError($url, $message = '', $code = 0, $errors = array(), $params = array(), $method) {
		$this->_errors[] = array(
			'url' => $url,
			'message' => $message,
			'code' => $code,
			'errors' => $errors,
			'params' => $params,
			'method' => $method,
		);
	}
	
	/**
	 * Return all errors
	 */
	public function getErrors() {
		return $this->_errors;
	}
	
	/**
	 * Check if a error exists
	 */
	public function hasError() {
		return (!empty($this->_errors));
	}
	
	/**
	 * Exectute curl request
	 *
	 * @param string $ressource
	 * @param string $method Default: GET
	 * @param array $params Default: array
	 * @param boolean $code Return status code
	 */
	public function request($ressource = '', $method = 'GET', $params = array(), $code = false) {
		//Parse params
		$params = $this->_parseParams($params);
		
		//Parse url
		if ($method == 'GET') {
			$url = $this->_parseUrl($ressource, $params);
		}
		else {
			$url = $this->_parseUrl($ressource);
		}
		
		$handle = curl_init();
		
		//Set options
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
		
		//Set username and password
		if (!is_null($this->_username) and !is_null($this->_password)) {
			curl_setopt($handle, CURLOPT_USERPWD, $this->_username.':'.$this->_password);
		}
		
		//Set method and params
		switch ($method) {
			case 'GET':
				break;
			case 'PUT':
			case 'DELETE':
			case 'POST':
			case 'PATCH':
				curl_setopt($handle, CURLOPT_CUSTOMREQUEST, $method);
				curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($params));
				break;
			default:
				$this->addError('Unknown method '.$method);
				return false;
				break;
		}
		
		//Execute
		$buffer = curl_exec($handle);
		$info = curl_getinfo($handle);
		curl_close($handle);
		
		$response = json_decode($buffer);
		
		//Return
		if ($code) {
			return $info['http_code'];
		}
		else {
			if (!is_array($response) and isset($response->message)) {
				$errors = isset($response->errors) ? $response->errors : array();
				$this->addError($url, $response->message, $info['http_code'], $errors, $params, $method);
				return false;
			}
			else {
				return $response;
			}
		}
	}
	
	/**
	 * Check rate limit. This check does not increase the limit
	 *
	 * @return array Remaining API calls and the limit per hour
	 */
	public function rateLimit() {
		$response = $this->request('/rate_limit');
		if (($response !== false) and (isset($response->rate) and (isset($response->rate->remaining)) and (isset($response->rate->limit)))) {
			return array(
				'remaining' => $response->rate->remaining,
				'limit' => $response->rate->limit,
			);
		}
		else {
			return false;
		}
	}
	
}
	
?>