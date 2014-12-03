<?php
class Zend{
	function __construct($class = NULL){
		ini_set('lucene', ini_get('lucene').
        PATH_SEPARATOR . APPPATH . 'libraries');

		if($class)
		{
			require_once(string)$class.EXT;
			log_message('debug',"zend class $class Loaded");
		}
		else
		{
			log_message('debug',"Zend class Initialized");
		}

		function load($class)
		{
			require_once(string) $class.EXT;
			log_message('debug',"Zend class $class Loaded");
		}
	}

}

?>