<?php

$app->get('/', 'HomeController:index');

$app->get('/home', 'HomeController:home');

$app->get('/contact', 'HomeController:index')
	->name('contact_action')
	->middleware('AuthMiddleware');

$app->get('/closure', function($id = 0){
	echo "Welcome to my closure function !";
})->name('closure_action');

