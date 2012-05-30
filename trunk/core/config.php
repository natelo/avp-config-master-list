<?php

# SQL specific
$db_host = "localhost";
$db_database = "nate_modcfg";
$db_user = "nate_modcfg";
$db_password = "WiOaWTISdrr";
# SQL DB
$db_prefix = "mod_";
$tbl_cvars = $db_prefix . "cvars";
$tbl_cmds = $db_prefix . "cmds";

# General
$debug = "1";
error_reporting(-1); // PROD = 0 | Dev = -1
date_default_timezone_set('Europe/Ljubljana');
$directory = "/";
$link = "localhost/";