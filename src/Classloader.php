<?php

namespace Scipper\Classloader;

/**
 * Class Classloader
 *
 * @author Steffen Kowalski <scipper@myscipper.de>
 *
 * @namespace Scipper\Classloader
 * @package Scipper\Classloader
 */
class Classloader {

	/**
	 * 
	 * @var string
	 */
	protected $includePath;
	
	/**
	 * 
	 * @var string
	 */
	protected $directorySeparator;
	
	/**
	 * 
	 * @var string
	 */
	protected $fileExtension;


	/**
	 * Classloader constructor.
	 *
	 * @param null $includePath
	 * @param string $directorySeparator
	 * @param string $fileExtension
	 */
	public function __construct($includePath = null, $directorySeparator = DIRECTORY_SEPARATOR, $fileExtension = ".php") {
		$this->includePath = $includePath;
		$this->directorySeparator = $directorySeparator;
		$this->fileExtension = $fileExtension;
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
	 * @param string $class
	 *
	 * @return bool
	 */
	public function autoload($class) {
		$class = str_replace("\\", $this->directorySeparator, $class);
		$file = $this->includePath . $this->directorySeparator . $class . $this->fileExtension;
		if(is_readable($file)) {
			require_once $file;
			return true;
		}
		return false;
	}

}

?>