<?php

namespace Hi\Core\Controller;

use Hi\Core\View\View as View;
use Hi\Core\Http\HttpResonse as HttpResponse;
use Hi\Core\Http\HttpRequest as HttpRequest;

class Controller extends HttpResponse, HttpRequest {

    protected $view;

    protected $model;

    public function __controller()
    {
        
    }

    public function render($view, array $data)
    {
    	return new View($view, $data);
    }
}