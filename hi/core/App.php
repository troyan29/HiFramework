<?php 

namespace Hi\Core;

use Hi\Core\Router\Router as Router;
use Hi\Core\Lib\Uri as Uri;
use Hi\Core\Container\Container as Container;
use Hi\Core\Http\HttpRequest as Request;
use Hi\Core\Http\HttpResponse as Response;

class App extends Container {

    private $router;
    
    private $request;

    private $response;

    public function __construct(){

        $this->applicationSetup();
        
        static::setInstance($this);
        
        $this->initialBindings();
        
    }
    
    public function applicationSetup() {

        Uri::setProjectFolder(basename(dirname(dirname(dirname(__FILE__)))));
        Uri::setBase(dirname(dirname(dirname(__FILE__))).'/');
        Uri::setSystem(Uri::base() . 'hi/');
        Uri::setApp(Uri::base() . 'app/');
        Uri::setCore(Uri::system() . 'core/');
        Uri::setLib(Uri::system() . 'lib/');
        Uri::setController(Uri::app() . 'controllers/');
        Uri::setModel(Uri::app() . 'models/');
        Uri::setView(Uri::app() . 'views/');
    }
    
    public function initialBindings() {
        
        $this->bind('app', $this);
        
        $this->request = $this->bindAndResolve('request', new Request());
        
        $this->response = $this->bindAndResolve('response', new Response());

        $this->router = $this->bindAndResolve('router', new Router());
    }
	
	public function run(){
        
        $this->router->setBasePath(Uri::ProjectFolder());

		$this->router->dispatch($this->request, $this->response);

	}

    public function get( $pattern_uri, $options )
    {
        $this->router->get( $pattern_uri, $options );
    }

    public function post( $pattern_uri, $options )
    {
        $this->router->post( $pattern_uri, $options );
    }

    public function getRequest() {
        return $this->request;
    }

    public function getResponse() {
        return $this->response;
    }
}

?>