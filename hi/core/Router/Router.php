<?php

namespace hi\Core\Router;

use Hi\Core\Router\RouteEntity as Route;
use Hi\Core\Lib\Uri;

class Router {

    protected static $allRoutes = [];

    protected static $routeGroups = [];

    protected static $namedRoutes = [];

    protected static $basePath = '';

    protected static $controller_404 = 'NotFoundController';

    protected static $matchTypes = array(
        'd'  => '[0-9]++',
        's'  => '[0-9A-Za-z]++',
        'h'  => '[0-9A-Fa-f]++',
        '*'  => '.+?',
        '**' => '.++',
        ''   => '[^/\.]++'
    );

    public static function map()
    {
        return new RouteEntity(func_get_args());
    }

    public static function get ($pattern_uri, $options)
    {
        $options = is_string($options) ? ['method' => 'GET', 'controller' => $options] : array_push($options,['method' => 'GET']);
        self::addNewRoute(new Route( $pattern_uri, $options ));
    }

    public static function post ($pattern_uri, $options)
    {
        $options = is_string($options) ? ['method' => 'POST', 'controller' => $options] : array_push($options,['method' => 'POST']);
        self::addNewRoute(new Route( $pattern_uri, $options ));
    }

    public static function put()
    {
        $options[] = ['method' => 'PUT'];
        self::addNewRoute(new Route( $pattern_uri, $options ));
    }

    public static function delete()
    {
        $options[] = ['method' => 'DELETE'];
        self::addNewRoute(new Route( $pattern_uri, $options ));
    }

    public static function addNewRoute(Route $route)
    {
        self::$allRoutes[] = $route;
    }

    public static function addRoutes(array $routes)
    {
        array_merge( self::$allRoutes[], $routes);
    }

    public static function setBasePath($base_path)
    {
        self::$basePath = $base_path;
    }

    public static function requestURI()
    {
        $uri = $_SERVER['REQUEST_URI'];

        $pos = stripos( $uri, self::$basePath );

        if($pos != false)
            return '/'.substr($uri, strlen(self::$basePath) + 2 );
        else
            return '/'.substr( $uri, 1);

    }

    public static function dispatch()
    {

        $uri = self::requestURI();
        
        $method = $_SERVER['REQUEST_METHOD'];

        foreach(self::$allRoutes as $route)
        {
            if( $route->dispatch( $uri, $method ) )
            {
                $controller_namespace = 'Hi\\app\\controllers\\'.$route->controller_name;
                $controller_obj = new $controller_namespace;
                call_user_func_array([$controller_obj, $route->controller_action], array());
                return true;
            }
        }

        $controller_namespace = 'Hi\\app\\controllers\\'.self::$controller_404;
        $controller_obj = new $controller_namespace;
        call_user_func_array([$controller_obj, 'index'], array());
        return false;

    }
}