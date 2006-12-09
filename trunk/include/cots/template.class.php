<?php

/**
 * This is the template class.
 *
 * LICENSE: This program is free software. You can redistribute it and/or
 * modify it under the terms of the GNU General Public License version 2
 * as published by the Free Software Foundation.
 *
 * @author     David Triendl <david@triendl.name>
 * @date       $Date: 2006-11-26 01:56:40 +0100 (Son, 26 Nov 2006) $
 * @copyright  2006 David Triendl
 * @package    CheetahBB
 * @subPackage COTS (CheetahBB's Own Template Engine)
 * @license    http://www.fsf.org/licensing/licenses/gpl.html  GNU General Public License 2
 */

require_once(dirname(__FILE__) . '/template_compiler.class.php');

class Template {

	private $config = array(); // Contains the configuration
	private $file = ''; // The template file
	private $language = 'en'; // Language
	
	/**
	 * @param  array   $config: Array containing config variables (optional).
	 */
	public __construct($config = array()) {
		$default_config = array(
			'template_directory' => 'templates/default',
			'gzip' => true,
			'language' => 'en',
			'override_language' => true
		);
		$this->config = array_merge($default_config, $config);
		$this->language = $this->config['language'];
		if($this->config['override_language'] && !empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			# Todo
		}
	}

	/**
	 * Loads the template (or a cached version)
	 *
	 * @param  string  $file: The name of the template
	 */
	function load_template($file) {
		if(!file_exists($this->config['template_direcotry'] . '/' . $file . '.tpl')) {
			ErrorHandler::Trigger(ER_DATA + ER_HALT, 'Template ' $file . ' does not exist');
		}
		$this->file = $file;
		if(file_exists($this->config['template_directory'] . '/' . $file . '.' . $this->language . '.cache')) { // There is a cached version of the template file
			if(filemtime($this->config['template_directory'] . '/' . $file . '.' . $this->language . '.cache') >= filemtime($this->config['template_directory'] . '/' . $file . '.tpl')) { // The cache version is up to date, so there is nothing to do
				return;
			}
		}
		$template_compiler = new TemplateCompiler(array(
			'template_direcotry' => $this->config['template_direcotry'];
			'file' => $file;
			
		));
	}
	
	/**
	 * Returns the template without any output filters (gzip, comment removeal, ..)
	 *
	 * @return string  $output: Complete output
	 */
	public function fetch() {
		return $output;
	}
	
	/**
	 * Applies the output filters (gzip, comment removal, ...) and sends the template
	 */
	public function output() {
		echo $this->fetch();
	}
		
}

?>