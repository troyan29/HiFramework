<?php

$app->get('/', 'HomeController:index');

$app->get('/home','HomeController:home');

$app->get('/login','AuthController:loginGet');

$app->post('/login','AuthController:loginPost');