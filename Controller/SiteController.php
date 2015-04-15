<?php

/**
 * Created by PhpStorm.
 * User: helena
 * Date: 21.03.2015
 * Time: 2:19
 */
class SiteController
{
    private $model;

    function __construct()
    {
        $this->setModel('SiteModel');
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = new $model();
    }


    public function index(){
        $this->renderView('index');
    }


    public function Topic($id){
        if (isset($id) && !empty($id)){
            $topic = $this->getModel()->getTopic($id);
            return $topic;
        } else {
            return false;
        }
    }
    public function Comments($id){
        if (isset($id) && !empty($id)){
            $comments = $this->getModel()->getComments($id);
            return $comments;
        } else {
            return false;
        }
    }
    function renderView($viewFile,$data_=null,$return=false)
    {
        $class= get_class($this);
        if($class !== 'Site'){
        $dir = '/'. substr("$class", 0, -10) . '/';
        } else {
            $dir = '/layout/';
        }


        if(is_array($data_))
            extract($data_,EXTR_PREFIX_SAME,'data');
        else
            $data=$data_;
        if($return)
        {
            ob_start();
            ob_implicit_flush(false);
            require(_VIEW . $dir . $viewFile .'.php');
            return ob_get_clean();
        }
        else{
            require(_VIEW . $dir . $viewFile .'.php');
        }
    }


    public function search()
    {
        $data = $this->getModel()->search();
       if(!$data || empty($data) ){
           $data = false;
       }
        $this->renderView('search', [
            'data' => $data,
        ]);
    }


} 