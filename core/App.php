<?php
/**
 * Created by PhpStorm.
 * User: helena
 * Date: 21.03.2015
 * Time: 1:58
 */
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__FILE__) . '/../');}
class App {
    static $content = '';
    static $config = [];

    static function init($config){
       self::getConfig($config);
        self::Register();

        require_once BASE_PATH . '/View/layout/main.php';
    }
    public  static function getConfig($config){
        self::$config = include($config);
    }

    public static function Register(){
        spl_autoload_register(array('App', 'Load'));
    }
    public static function Load($strObjectName)
    {
        if(file_exists(BASE_PATH . '/core/' . $strObjectName . '.php')){
            $strObjectFilePath = BASE_PATH . '/core/' . $strObjectName . '.php';
            include($strObjectFilePath);
        }
        $controller = "/Controller\b/i";
        if(preg_match($controller, $strObjectName)){
            include(BASE_PATH . '/Controller/' . $strObjectName . '.php');
        }
        $model = "/Model\b/i";
        if(preg_match($model, $strObjectName)){
            include(BASE_PATH . '/Model/' . $strObjectName . '.php');
        }
        $view = "/View\b/i";
        if(preg_match($view, $strObjectName)){
            include(BASE_PATH . '/View/' . $strObjectName . '.php');
        }
        $core = "/Class\b/i";
        if(preg_match($core, $strObjectName)){
            require_once(BASE_PATH . '/core/' . $strObjectName . '.php');
        }


    }

} 