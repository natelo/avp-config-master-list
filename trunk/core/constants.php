<?php

# Load settings
require_once 'core/config.php';


# Set defines

## SQL
define('DB_HOST', $db_host);
define('DB_DATABASE', $db_database);
define('DB_USER', $db_user);
define('DB_PASSWORD', $db_password);
## SQL DB
define('DB_PREFIX', $db_prefix);
define('TBL_CVARS', $tbl_cvars);
define('TBL_CMDS', $tbl_cmds);

# General
define('DEBUG', $debug);
define('ROOT_DIR', $directory);
define('FULL_URL', $link);