<?php
/*
 * API front end.
 * 
 * File that tieds all the dots.
 * 
 */

/********** Check for permission ***********/
if (!ROOT_LEVEL)
	die('Not allowed...');

/********** Load constants ***********/
require_once 'core/constants.php';

/*********** Autoload classes ************/
function __autoload($class_name) {
	require_once "class/class_" . $class_name . '.php';
}

$pages = new pages();


