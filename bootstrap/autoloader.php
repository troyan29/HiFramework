<?php

/**
 * Requiring RedBeanPHP ORM class library
 */
require_once dirname(__DIR__) . '/hi/core/lib/orm/rb.php';

/**
 * Autoload by PSR-0 standards for class autoloading using namespaces
 *
 * @author: Diego Mariani 
 * @version: 0.0.1 2015-02-02
 *
 */
function autoload($class) {
    
    $root = dirname(dirname(__FILE__));
    
    preg_match('/^(.*\\\\)(.*)/',  ltrim($class, '\\'), $match );
    
    require_once $root.'/'. str_replace( '\\', '/', $match[1] ). $match[2] . '.php';
}

spl_autoload_register('autoload');

