<?php

namespace hi\Core\Router;

use Hi\Core\Router\RouteEntity as Route;
use Hi\Core\Lib\Uri;
use Hi\Core\Http\HttpRequest as Request;
use Hi\Core\Http\HttpResponse as Response;

class Router {

    protected $allRoutes = [];

    protected $routeGroups = [];

    protected $namedRoutes = [];

    protected $basePath = '';

    protected $controller_404 = 'NotFoundController';

    protected $matchTypes = array(
        'd'  => '[0-9]++',
        's'  => '[0-9A-Za-z]++',
        'h'  => '[0-9A-Fa-f]++',
        '*'  => '.+?',
        '**' => '.++',
        ''   => '[^/\.]++'
    );

    public function map()
    {
        return new RouteEntity(func_get_args());
    }

    public function get ($pattern_uri, $options)
    {
        $options = is_string($options) ? ['method' => 'GET', 'controller' => $options] : array_push($options,['method' => 'GET']);
        $this->addNewRoute(new Route( $pattern_uri, $options ));
    }

    public function post ($pattern_uri, $options)
    {
        $options = is_string($options) ? ['method' => 'POST', 'controller' => $options] : array_push($options,['method' => 'POST']);
        $this->addNewRoute(new Route( $pattern_uri, $options ));
    }

    public function put()
    {
        $options[] = ['method' => 'PUT'];
        $this->addNewRoute(new Route( $pattern_uri, $options ));
    }

    public function delete()
    {
        $options[] = ['method' => 'DELETE'];
        $this->addNewRoute(new Route( $pattern_uri, $options ));
    }

    public function addNewRoute(Route $route)
    {
        $this->allRoutes[] = $route;
    }

    public function addRoutes(array $routes)
    {
        array_merge( $this->allRoutes[], $routes);
    }

    public function setBasePath($base_path)
    {
        $this->basePath = $base_path;
    }

    public function requestURI()
    {
        $uri = $_SERVER['REQUEST_URI'];

        $pos = stripos( $uri, $this->basePath );

        if($pos != false)
            return '/'.substr($uri, strlen($this->basePath) + 2 );
        else
            return '/'.substr( $uri, 1);

    }

    public function dispatch(Request $request, Response $response)
    {

        $uri = $this->requestURI();
        
        $method = $_SERVER['REQUEST_METHOD'];

        foreach($this->allRoutes as $route)
        {
            if( $route->dispatch( $uri, $method ) )
            {
                $controller_namespace = 'App\\controllers\\'.$route->controller_name;
                $controller_obj = new $controller_namespace($request, $response);
                call_user_func_array([$controller_obj, $route->controller_action], array());
                return true;
            }
        }

        $controller_namespace = 'App\\controllers\\'.$this->controller_404;
        $controller_obj = new $controller_namespace($request, $response);
        call_user_func_array([$controller_obj, 'index'], array());
        return false;

    }
}