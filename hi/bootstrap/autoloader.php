<?php

/**
* Autoload by PSR-0 standards for class autoloading using namespaces
*
* Diego Mariani February 2, 2015
*
*/

function autoload($className) {
    $root = dirname(dirname(dirname(__FILE__)));
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