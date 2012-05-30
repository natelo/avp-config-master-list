<?php
# Set cfg name
$cfg = (empty($_POST['cfg'])) ? "config-error.txt" : $_POST['cfg'];

# Declare it as a file
header('Content-type: application/txt');
header('Content-Disposition: attachment; filename="'.$cfg.'"');

# Since it's not part of any file we need to declare it here as well..
date_default_timezone_set('Europe/Ljubljana');

# Error check
if (@empty($_POST['cfg']))
  die("DOH! This file gives no results if accessed directly...");

# Do the magic
echo "//\n// Config".$_POST['version']."\n//\n// Generated on http://avp.rtcwx.com. \n// Created: ".date("D, d/M/Y H:i:s" )."\n// AvP Mod Config created by: Nate 'L0,\n//\n\n";

# Strip out what we don't need ...
$sum = array_diff($_POST, array($_POST['cfg'], $_POST['version'], $_POST['submit']));

# Dump cfg vars now..
foreach ($sum as $var => $value) {
	echo 'seta ' . $var . ' "'.$value . '" '. "\n";
}