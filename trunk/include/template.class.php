<?php

/**
 * This is the template class.
 *
 * LICENSE: This program is free software. You can redistribute it and/or
 * modify it under the terms of the GNU General Public License version 2
 * as published by the Free Software Foundation.
 *
 * @author     David Triendl <david@triendl.name>
 * @date       $Date$
 * @copyright  2006 David Triendl
 * @package    CheetahBB
 * @subPackage COTS (CheetahBB's Own Template Engine)
 * @license    http://www.fsf.org/licensing/licenses/gpl.html  GNU General Public License 2
 */

class Template {
	
	private $variables = array(); // Template variables
	
	public function __construct() {
		
	}
	
	public function fetch() {
		
	}
	
	public function output() {
		echo $this->fetch();
	}
	
}

?>
 
