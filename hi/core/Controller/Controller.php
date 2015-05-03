<?php

namespace Hi\Core\Controller;

use Hi\Core\View\View as View;

class Controller {

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