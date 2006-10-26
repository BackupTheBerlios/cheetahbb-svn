<?php

/**
 * This file is the index file. It includes all the necessary files,
 * cretes a database class instance, creates a template class instance. At
 * the end it checks if the database-connection got closed properly and
 * sends the HTML code to the user.
.* If you want to include a file just place a require() or a require_once
 * here.
 *
 * LICENSE: This program is free software. You can redistribute it and/or
 * modify it under the terms of the GNU General Public License version 2
 * as published by the Free Software Foundation.
 *
 * @author     David Triendl <david@triendl.name>
 * @copyright  2006 David Triendl
 * @package    CheetahBB
 * @license    http://www.fsf.org/licensing/licenses/gpl.html  GNU General Public License 2
 */

// Include necessary libs, classes, ...
require_once('include/config.php');
require_once('include/errorhandler.php');
require_once('include/template.class.php');
require_once('include/database/mysql.class.php');

// Start an instante of the template and the mysql class
$error_handler = new ErrorHandler();
$template = new Template();
$database = new Database($private_config['mysql']);

// Here goes the code


// Exit
$template->output();

?>
