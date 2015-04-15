<?php
/**
 * Created by PhpStorm.
 * User: helena
 * Date: 02.04.2015
 * Time: 18:11
 */

class MessagesController extends SiteController{

    function __construct()
    {
        parent::__construct();
        $this->setModel('MessagesModel');
    }

    public function index(){

        $model = $this->getModel();
        $current = $_GET['topic'];
        $where = "WHERE `id_topic` = $current";
        $page = new PaginationClass($model->getTable(), $where);


        $app = new CounterClass();
        $app->upBrowsing($current);
        $topic = $this->topic($current);
        $comments = $this->Comments($current);

        $this->renderView('index', [
            'model' => $model,
            'page' => $page,
            'topic' => $topic,
            'comments' => $comments,
        ]);
    }

    public function addMessage($message){
        $model = $this->getModel();
        $model->sendMessage($message);

    }

} 