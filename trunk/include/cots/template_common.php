<?php

/**
 * This file contains some things that are shared between the template class and the template
 * compiler.
 *
 * LICENSE: This program is free software. You can redistribute it and/or modify it under the terms
 * of the GNU General Public License version 2 as published by the Free Software Foundation.
 *
 * @author     David Triendl <david@triendl.name>
 * @date       $Date$
 * @copyright  2006-2007 David Triendl
 * @package    CheetahBB
 * @subPackage COTS (CheetahBB's Own Template Engine)
 * @license    http://www.fsf.org/licensing/licenses/gpl.html  GNU General Public License 2
 */

define(COTS_TEMPLATE_VERSION, 1);
define(COTS_COMPILER_VERSION, 1);

define(COTS_PREG_VARIABLE, '^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$');

$cots_default_config = array(
	'template_directory' => 'templates/default',
	'gzip' => true,
	'language' => 'en',
	'override_language' => true
);

$cots_modifier_list = array( // Array containing a list of modifiers and the parameter count
	'htmlentities' => array(0, 1, 2),
	'substring' => array(1, 2),
	'now' => array(0)
);

?>