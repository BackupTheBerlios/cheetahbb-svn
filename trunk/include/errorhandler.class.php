<?php

/**
 * This is the errorhandler class. PHP's trigger_error is nice, but this class is more comfortable.
 *
 * LICENSE: This program is free software. You can redistribute it and/or modify it under the terms
 * of the GNU General Public License version 2 as published by the Free Software Foundation.
 *
 * @author     David Triendl <david@triendl.name>
 * @date       $Date$
 * @copyright  2006-2007 David Triendl
 * @package    CheetahBB
 * @license    http://www.fsf.org/licensing/licenses/gpl.html  GNU General Public License 2
 */


// Error level constants
define('ER_LANGUAGE', 1); // Translation is incmplete
define('ER_NOTICE', 2); // Just if something could be done better
define('ER_WARNING', 4); // Bad, but not fatal
define('ER_DATA', 8); // No permission for fopen, file does not exist or similar. Only halts the script when combined with ER_HALT.
define('ER_HALT', 16);// Fatal error, the script hast to be halted

class ErrorHandler {
	
	public $minimal_level = 1; // Set this to 4 in official releases
	private static $instance;
	private $total_error_counter = 0; // Counts all errors
	private $error_counter = 0; // Counts only errors >= $this->minimal_level
	private $errors = array();
	
	/**
	 * The constructor is private because this class uses the Singleton pattern as described
	 * on http://www.php.net/manual/en/language.oop5.patterns.php.
	 */
	private function __construct() {
	
	}
	
	/**
	 * This functions triggers an error.
	 *
	 * @param  integer $level: The error level. This can either be one of the predefined
	 *				constants (see above) or the sum of two or more of these
	 *				constants.
	 * @param  string  $file: The file in which the error occured. This can also be the
	 *				complete path to the file.
	 * @param  string  $message: The optional error message which gets printed.
	 */
	public function trigger($level = 4, $file, $line, $message = 'Unknown error.') {
		if(!isset(self::$instance)) { // Create instance of this class if none exists
			self::$instance = new __CLASS__;
		}
		$file = basename($file);
		if($level < $this->minimal_level) {
			if($level >= ER_HALT) { // If the error level is greater or equal 16 this function halts the script
				$this->crash($message);
			} else {
				if(0) {
					$this->errors[] = array($level, $file, $line, $message);
				}
			}
			++$this->error_counter();
		}
		++$this->total_error_counter;
	}
	
	/**
	 * This function prints a fatal error and halts the script. If
	 * possible the function also send the HTTP status 500.
	 *
	 * @param  string  $message: The error message.
	 */
	private function crash($file, $line, $message) {
		@ob_end_clean(); // Always worth a try
		if(!headers_sent()) { // Check if the server alreay sent something to the client
			header('HTTP/1.0 500 Internal Server Error');
		}
		/**
		 * IMPORTANT: This code breaks the PHP Coding Standard rule #15 because it is easier
		 * to output this bulk of XHTML code than to write a small template engine for just
		 * one function.
		 */
		echo '<' . '?xml version="1.0" encoding="UTF-8"?' . '>'; // Stupod short_open_tags
		echo <<<
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/2001/REC-xhtml11-20010531/DTD/xhtml11-flat.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
 <head>
  <title>CheetahBB Error</title>
  <meta http-equiv="pragma" content="no-cache" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="content-language" content="de" />
  <meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
  <meta name="author" content="The CheetahBB developement team" />
  <!--[if IE]><meta name="MSSmartTagsPreventParsing" content="true" /><![endif]-->
  <meta http-equiv="imagetoolbar" content="no" />
 </head>
 <body>
  <h2>CheetahBB Error</h2>
  <h4><a href="http://cheetahbb.net">Go to the CheetahBB homepage</a></h4>
  <p>
  
EOT;
		echo htmlspecialchars($message, ENT_NOQUOTES, 'UTF-8');
		echo <<<
		
  </p>
 </body>
</html>
EOT;
		exit();
	}
	
	/**
	 * This function formats returns an array containing all errors. This function gets used
	 * by the template class to integrate the errors into the (X)HTML code using valid (X)HTML.
	 *
	 * @return array   $errors: Array containing all errors. Can be empty
	 */
	public function error_list() {
		return array();
	}
	
}

?>
 
