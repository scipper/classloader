<?php

namespace classloader;

/**
 * 
 * @author Steffen Kowalski <sk@traiwi.de>
 *
 * @since 11.12.2014
 * @namespace classloader
 * @package classloader
 *
 */
class Classloader {

	/**
	 * 
	 * @var string
	 */
	private $include_path;
	
	/**
	 * 
	 * @var string
	 */
	private $dir_separator;
	
	/**
	 * 
	 * @var string
	 */
	private $file_extension;
	
	/**
	 * 
	 * @param string $include_path
	 * @param string $dir_separator
	 * @param string $file_extension
	 */
	public function __construct($include_path = null, $dir_separator = DIRECTORY_SEPARATOR, $file_extension = ".php") {
		$this->include_path = $include_path;
		$this->dir_separator = $dir_separator;
		$this->file_extension = $file_extension;
	}
	
	/**
	 * 
	 */
	public function register() {
		spl_autoload_register(array($this, 'autoload'));
	}
	
	/**
	 * 
	 */
	public function unregister() {
		spl_autoload_unregister(array($this, 'autoload'));
	}

	/**
	 * 
	 * @param string $class
	 * @return boolean
	 */
	public function autoload($class) {
		$class = str_replace("\\", $this->dir_separator, $class);
		$file = $this->include_path.$this->dir_separator.$class.$this->file_extension;
		if(is_readable($file)) {
			require_once $file;
			return true;
		}
		return false;
	}

}

?>