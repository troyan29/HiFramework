<?php

/**
 * Hi - A Simple PHP Framework
 *
 * @package  Hi
 * @author   Diego Mariani <diegomariani.com@gmail.com>
 * @version  0.0.1
 * @since    January 2015 
 */

/**
 * Requiring autoloader file that register default autoloader function
 */

require_once 'hi/bootstrap/autoloader.php';


/**
 * Instantiating App instance that will be used all over the application
 */

$app = new Hi\Core\App();


/**
 * Requiring routes file that contains all routes definitions
 */

require_once 'hi/app/routes.php';


/**
 * Running the app
 */

$app->run();







