<?php
$app = dirname(__FILE__) . '/core/App.php';
$config = dirname(__FILE__) . '\config\main.php';
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__FILE__));
if (!defined('_VIEW'))
        define('_VIEW', BASE_PATH . '/View');


}
require_once($app);
App::init($config);

?>