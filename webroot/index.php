<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

require_once(ROOT.DS.'lib'.DS.'init.php');

$router = new Router($_SERVER['REQUEST_URI']);

echo '<pre>'; print_r('route: '.$router->getRoute().PHP_EOL);
echo '<pre>'; print_r('Language: '.$router->getLanguage().PHP_EOL);
echo '<pre>'; print_r('Controller: '.$router->getController().PHP_EOL);
echo '<pre>'; print_r('Action: '.$router->getMethodPrefix().$router->getAction().PHP_EOL);

echo "params: \r\n";
print_r($router->getParams());


?>
