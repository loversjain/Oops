<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

define('SITE_ROOT', DS. 'gallery'.DS.'admin'.DS. 'upload'.DS);
defined('INCLUDE_PATH') ? null : define('INCLUDE_PATH', SITE_ROOT.DS.'admin'.DS.'includes');

require_once 'config.php';
require_once 'database.php';
require_once 'function.php';
require_once 'session.php';
require_once 'db_object.php';
require_once 'user.php';
