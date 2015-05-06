<?php

namespace Hi\Core\Router;

use Exception;



class RouteEntity {

	public $pattern_uri;

    public $options = [];

    public $middleware = [];

    public $is_closure = false;

    public $closure = null;

    public $method;

    public $handler;

    public $controller_name;

    public $controller_action;

	public function __construct( $pattern_uri, $options )
    {

        $this->pattern_uri = $pattern_uri;

        $this->init($options);

        $this->parseURI();

    }

    public function init( $options )
    {
        if(is_array($options) && empty($options))
            throw new Exception("Route misconfiguration !");

        $this->options = $options;

        $this->parseMethod($options);

        if($this->is_closure($options['controller']) === false)
            $this->parseController($options);
        else
            $this->parseClosure($options);

        $this->parseName($options);

    }

    public function parseURI()
    {

    }

    public function parseClosure($options) {
        $this->is_closure = true;
        $this->closure = $options['controller'];
    }

    public function parseController($options)
    {
        $controller_raw = isset($options['controller']) ? $options['controller'] : '/';
        $controller_name = substr($controller_raw, 0, strpos($controller_raw,":"));
        $controller_action = substr($controller_raw, strpos($controller_raw,":")+1 );

        $this->controller_name = $controller_name;
        $this->controller_action = $controller_action;
    }

    public function parseMethod($options)
    {
        $this->method = isset($options['method']) ? $options['method'] : 'GET';
    }

    public function parseName($options)
    {
        $this->name = isset($options['name']) ? $options['name'] : null;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;

        $this->init();
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function dispatch( $uri, $method )
    {        
        if($this->method == $method && $this->pattern_uri == $uri) {
            return true;
        }
    }

    public function is_closure($c) {
        return is_object($c) && ($c instanceof \Closure);
    }

}