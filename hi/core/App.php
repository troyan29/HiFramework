<?php 

namespace Hi\Core;

use Hi\Core\Lib\Helper\Uri as UriHelper;
use Hi\Core\Lib\Helper\Config as Config;
use Hi\Core\Container\Container as Container;
use Hi\Core\Factory\ComponentFactory as Factory;

class App extends Container {

    private $router;

    public function __construct(){

        $this->applicationSetup();
        
        static::setInstance($this);
        
        $this->initialBindings();
        
    }
    
    public function applicationSetup() {

        Config::init();

        UriHelper::init();
    }
    
    public function initialBindings() {
        
        $this->bind('app', $this);

        $factory = $this->bindAndResolve('factory', new Factory());

        $this->router = $this->bindAndResolve('router', $factory->getComponent('router'));

        $this->bind('request', $factory->getComponent('request'));
        
        $this->bind('response', $factory->getComponent('response'));

    }
	
	public function run(){
        
        $this->router->setBasePath( UriHelper::ProjectFolder() );

		$this->router->dispatch($this->resolve('request'), $this->resolve('response'));

	}

    public function get( $pattern_uri, $options )
    {
        $this->router->get( $pattern_uri, $options );
    }

    public function post( $pattern_uri, $options )
    {
        $this->router->post( $pattern_uri, $options );
    }

    public function closure($pattern_uri, $closure){
        $this->router->closure($pattern_uri, $closure);
    }
}

?>