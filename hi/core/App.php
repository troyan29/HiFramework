<?php 

namespace Hi\Core;

use Hi\Core\Router\Router as Router;
use Hi\Core\Lib\Uri as Uri;
use Hi\Core\Container as Container;

class App extends Container {

    public function __construct(){

        static::setInstance($this);

        $this->instance('app', $this);

        $this->setup();
    }

    public function setup()
    {
        $this->bind();
        
        Uri::setProjectFolder(basename(dirname(dirname(dirname(__FILE__)))));
        Uri::setBase(dirname(dirname(dirname(__FILE__))).'/');
        Uri::setSystem(Uri::base() . 'hi/');
        Uri::setApp(Uri::system() . 'app/');
        Uri::setCore(Uri::system() . 'core/');
        Uri::setLib(Uri::system() . 'lib/');
        Uri::setController(Uri::app() . 'controllers/');
        Uri::setModel(Uri::app() . 'models/');
        Uri::setView(Uri::app() . 'views/');
    }
	
	public function run(){
        
        Router::setBasePath(Uri::ProjectFolder());

		Router::dispatch();

	}

    public function get( $pattern_uri, $options )
    {
        Router::get( $pattern_uri, $options );
    }

    public function post( $pattern_uri, $options )
    {
        Router::post( $pattern_uri, $options );
    }
}

?>