<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEWS_PATH', ROOT.DS.'views');
require_once(ROOT.DS.'lib'.DS.'init.php'); //include init, trong init da include cac file can thiet

session_start();

App::run($_SERVER['REQUEST_URI']);

?>
