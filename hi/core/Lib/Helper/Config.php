<?php

namespace Hi\Core\Lib\Helper;

class Config {

	public static function init() {
		
	}
	
	public static function getBase() {
		return dirname(dirname(dirname(dirname(dirname(__FILE__)))));
	}

	public static function getBaseName() {
		return basename(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
	}
}