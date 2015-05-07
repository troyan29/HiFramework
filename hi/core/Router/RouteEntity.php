<?php

namespace Hi\Core\Router;

use Exception;
use Hi\Core\Lib\UriParser as UriParser;

class RouteEntity {

	public $pattern_uri;

    public $params = ['key' => [], 'value' => []];

    public $matching_options = ['key' => [], 'type' => []];

    protected $matchTypes = array(
        'int'  => '/^[1-9][0-9]*$/',
        'string'  => '/^[A-Za-z0-9_-]*$/',
        'hex'  => '/^0x[0-9A-F]{1,4}$/',
        '*'  => '.+?',
        '**' => '.++',
        ''   => '[^/\.]++'
    );

    public $options = [];

    public $middleware = [];

    public $is_closure = false;

    public $closure = null;

    public $method;

    public $handler;

    public $controller_name;

    public $controller_action;

    private $UrlParser;

	public function __construct( $pattern_uri, $options )
    {

        $this->pattern_uri = $pattern_uri;

        $this->init($options);

        $this->parser = new UriParser();

    }

    public function init($options)
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

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        return $this->name;
    }

    public function setMatchingOption($options) {
        foreach ($options as $key => $type) {
            array_push($this->matching_options['key'], $key);
            array_push($this->matching_options['type'], $type);
        }
    }

    public function setMiddlewares(array $middlewares) {
        $this->middleware = array_merge($this->middleware, $middlewares);
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getMethod(){
        return $this->method;
    }

    public function getURI(){
        return $this->pattern_uri;
    }

    public function dispatch($request_uri, $method)
    {        
        if(strpos($this->pattern_uri, ':') !== false) {
            
            //Bisogna mappare parametri
            $request_ = explode('/', $request_uri);
            $this_ = explode('/', $this->pattern_uri);

            if(count($request_) == count($this_)) {

                foreach ($this_ as $key => $value) {
                    if(strpos($value, ':') !== false){
                        if(in_array(substr($value, strpos($value, ':')+1), $this->matching_options['key'])){

                            //Esiste una regola di match
                            $key_ = array_search(substr($value, strpos($value, ':')), $this->matching_options['key']);
                            $matching = $this->matching_options['type'][$key_];
                            if(preg_match($this->matchTypes[$matching], $request_[$key])) {
                                $this->params['key'][] = substr($value, strpos($value, ':'));
                                $this->params['value'][] = $request_[$key];
                            } else {
                                return false;
                            }
                        }else{
                            $this->params['key'][] = substr($value, strpos($value, ':') + 1);
                            $this->params['value'][] = $request_[$key];
                        }
                    }else{
                        if($value !== $request_[$key]) return false;
                    }
                }

                return true;

            } else {
                return false;
            }

        } else {
            if($this->method == $method && $this->pattern_uri == $request_uri) {
                return true;
            }
        }
        
        
    }

    public function is_closure($c) {
        return is_object($c) && ($c instanceof \Closure);
    }

}