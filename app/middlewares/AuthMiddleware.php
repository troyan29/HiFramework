<?php

namespace App\Middlewares;

use Hi\Core\Middleware\Middleware as Middleware;

class AuthMiddleware extends Middleware {
	
	public function index($who) {
		echo "This is a Middleware for $who<br />";
	}
}