<?php
/**
 * Created by PhpStorm.
 * User: Viktor Afanasjev
 * Date: 02.04.2015
 * Time: 18:10
 */

class TopicController extends SiteController{

    function __construct()
    {
        parent::__construct();
        $this->setModel('TopicModel');
    }

    public function index(){
        $model = $this->getModel();
        $time = $model->getSqlTime();
        $page = new PaginationClass($model->getTable(), $time);
        $this->renderView('index', [
            'model' => $model,
            'page' => $page,
        ]);

    }
} 