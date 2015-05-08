<?php

namespace Hi\Core\Lib\Helper;

class Config {

	private static $base;

	private static $basename;

	private static $database_config;

	private static $app_config;

	public static function init() {
		
		static::$base = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
		static::$basename = basename(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
		
		static::$database_config = parse_ini_file( static::$base . '/config/.database');
		static::$app_config = parse_ini_file( static::$base . '/config/.app');

	}

	public static function getDatabaseConfig(){
		return static::$database_config;
	}
	
	public static function getBase() {
		return static::$base;
	}

	public static function getBaseName() {
		return static::$basename;
	}
}