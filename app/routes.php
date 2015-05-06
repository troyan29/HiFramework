<?php

$app->get('/', 'HomeController:index');

$app->get('/home','HomeController:prodotti');

$app->get('/test', function($id = 9) {
	echo "Ciao amici".$id;
});

$app->get('/login','AuthController:loginGet');

$app->post('/login','AuthController:loginPost');