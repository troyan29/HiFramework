<?php

/**
 * Hi - A Simple PHP Framework.
 *
 * @author   Diego Mariani <info@diegomariani.com>
 *
 * @version  0.0.1
 *
 * @since    January 2015
 */

/**
 * Requiring autoloader file that register default autoloading function.
 */
require_once 'bootstrap/autoloader.php';

/*
 * Instantiating App class that will be used all over the application
 */

$hi = new Hi\Core\App();

/**
 * Requiring routes file that contains all routes definitions.
 */
require_once 'app/routes.php';

/*
 * Running the app
 */

$hi->run();
