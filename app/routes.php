<?php

$app->get('/', 'HomeController:index');

$app->get('/home', 'HomeController:home');

$app->get('/contact', 'HomeController:index')
	->middleware('AuthMiddleware:index');

$app->get('/welcome/:name', function($name){
	echo 'Hi '.$name.', welcome to HiFramework !';
})->with(['name' => 'string']);

