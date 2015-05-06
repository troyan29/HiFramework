<?php

namespace Hi\Core\Http;
	
class HttpRequest {
	
	protected $request;
	
	protected $GET_METHOD = 'GET';

	protected $POST_METHOD = 'POST';
	
	public function post($name) {
		if(isset($_POST[$name])) return $_POST[$name];
		return [];
	}
	
	public function get($name) {
		if(isset($_GET[$name])) return $_GET[$name];
		return [];
	}

	public function requestedMethod(){
		return $_SERVER['REQUEST_METHOD'];
	}
	
	
}