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
function autoload($className) {
    $root = dirname(dirname(__FILE__));
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require_once $root .'/'. $fileName;
}

spl_autoload_register('autoload');

