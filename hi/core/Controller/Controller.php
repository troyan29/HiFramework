<?php

namespace Hi\Core\Controller;

use Hi\Core\View\View as View;
use Hi\Core\App as App;
use Hi\Core\Http\HttpRequest as Request;
use Hi\Core\Http\HttpResponse as Response;

class Controller {

    protected $view;

    protected $model;

    protected $request;

    public function __construct(Request $request, Response $response)
    {
     	 $this->request = $request;
     	 $this->response = $response;
    }

    public function render($view, array $data)
    {
    	return new View($view, $data);
    }
}