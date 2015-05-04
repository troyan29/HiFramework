<?php

namespace Hi\Core\Http;
	
class HttpRequest {
	
	protected $request;
	
	public function post($name) {
		if(isset($_POST[$name])) return $_POST[$name];
		return [];
	}
	
	public function get($name) {
		if(isset($_GET[$name])) return $_GET[$name];
		return [];
	}
	
	
}