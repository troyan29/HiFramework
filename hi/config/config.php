<?php

$db_config = [

    'db_host' => 'localhost',
    
    'db_user' => 'root',
    
    'db_password' => 'secret',

    'db_name' => 'hiframework'

];

$app_config = [
	
    'debug' => true,
    
    'key' => 'ENCRYPTION KEY HERE !!',
    
	'default_controller' => 'HomeController:index',
	
    'custom_404_controller' => 'NotFoundController:index'

];