<?php

/**
 * Created by PhpStorm.
 * User: helena
 * Date: 31.03.2015
 * Time: 7:54
 */
class DbaseClass
{
    private $dbh;
    private $params = [];


    /**
     * @return string
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param string $host
     */
    public function setParams()
    {
        $this->params['host']       = App::$config['db']['host'];
        $this->params['user']       = App::$config['db']['user'];
        $this->params['password']   = App::$config['db']['password'];
        $this->params['database']   = App::$config['db']['database'];
    }




    public function __construct()
    {
        $this->setParams();
        $this->dbh = mysql_connect(
            $this->params['host'],
            $this->params['user'],
            $this->params['password']
        ) or die("Не могу соединиться с MySQL.");

        mysql_select_db(
            $this->params['database']
        ) or die("Не могу подключиться к базе.");

    }







} 