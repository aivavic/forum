<?php
/**
 * Created by PhpStorm.
 * User: helena
 * Date: 02.04.2015
 * Time: 18:09
 */

class RouteClass {

    static function run(){
        $key = key($_GET);
        switch ($key) {
            case 'page':
                $controller = new TopicController;
                $action = 'index';
                break;
            case 'topic':
                $controller = new MessagesController;
                $action = 'index';
                break;
            case 'search':
                $controller = new SiteController;
                $action = 'search';
                break;
            case 'newMessage':
                $controller = new MessagesController();
                $action = 'AjaxAddMessages';
                break;
            default:
                $controller = new TopicController;
                $action = 'index';
                break;
        }
       $controller->$action();

    }
} 