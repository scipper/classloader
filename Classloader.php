<?php

/**
 * 
 * @author Steffen Kowalski <scipper@myscipper.de>
 *
 * @since 11.12.2014
 * @package Classloader
 *
 */
class Classloader {

	/**
	 * 
	 * @var string
	 */
	protected $ip;
	
	/**
	 * 
	 * @var string
	 */
	protected $ds;
	
	/**
	 * 
	 * @var string
	 */
	protected $fe;
	
	/**
	 * 
	 * @param string $ip
	 * @param string $ds
	 * @param string $fe
	 */
	public function __construct($ip = null, $ds = DIRECTORY_SEPARATOR, $fe = ".php") {
		$this->ip = $ip;
		$this->ds = $ds;
		$this->fe = $fe;
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
		$class = str_replace("\\", $this->ds, $class);
		$file = $this->ip . $this->ds . $class . $this->fe;
		if(is_readable($file)) {
			require_once $file;
			return true;
		}
		return false;
	}

}

?>