<?php

namespace App\Middlewares;

use Hi\Core\Middleware\Middleware as Middleware;

class AuthMiddleware extends Middleware {
	
	public function index() {
		echo "This is a Middleware<br />";
	}
}