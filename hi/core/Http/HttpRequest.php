<?php

namespace Hi\Core\Http;

use Hi\Core\Lib\Helper\Uri as Uri;

class HttpRequest {
	
	protected $request;
	
	protected $GET_METHOD = 'GET';

	protected $POST_METHOD = 'POST';
	
	public function post($name) {
		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($_POST[$name])) return $_POST[$name];
		return [];
	
	}
	
	public function get($name) {
		$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
		if(isset($_GET[$name])) return $_GET[$name];
		return [];
	
	}

	public function requestURI($base) {
		$uri = $_SERVER['REQUEST_URI'];

        $pos = stripos($uri, $base);

        if($pos != false)
            return '/'.substr($uri, strlen($base) + 2);
        else
            return '/'.substr($uri, 1);
	}

	public function requestMethod(){
		
		return $_SERVER['REQUEST_METHOD'];
	
	}
	
	
}