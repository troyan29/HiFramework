<?php


class ContainerTest extends \PHPUnit_Framework_TestCase
{
	public function testContainer()
	{
		$object = new StdClass();
		$c = new Hi\Core\Container\Container();
		$c->bind('object', $object);
		//$this->assertInstanceOf('StdClass', $c->resolve('object'));		
	}
}