<?php

$app->get('/', 'HomeController:index');

$app->get('/home', 'HomeController:home');

$app->get('/contact/:who', 'HomeController:index')
	->middleware('AuthMiddleware');

$app->get('/welcome/:name', function($name){
	echo 'Hi '.$name.', welcome to HiFramework !';
})->with(['name' => 'hex']);

