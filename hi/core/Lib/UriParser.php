<?php
	
namespace Hi\Core\Lib;

class UriParser {
	
	protected $matchTypes = array(
        'd'  => '[0-9]++',
        's'  => '[0-9A-Za-z]++',
        'h'  => '[0-9A-Fa-f]++',
        '*'  => '.+?',
        '**' => '.++',
        ''   => '[^/\.]++'
    );
    
}