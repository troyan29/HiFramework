<?php

namespace Hi\Core\Factory;

abstract class AbstractFactory {
	public abstract function getComponent($name);
}