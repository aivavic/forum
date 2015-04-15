<?php

/**
 * Created by PhpStorm.
 * User: helena
 * Date: 31.03.2015
 * Time: 18:05
 */
class AddEntryClass extends DbaseClass
{
    private $model;

    public $txt_file = '';

    public function __construct()
    {
        $this->setTxtFile('messages.txt');
        $this->model = new SiteModel();
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getTxtFile()
    {
        return $this->txt_file;
    }

    /**
     * @param string $txt_file
     */
    public function setTxtFile($txt_file)
    {
        $this->txt_file = BASE_PATH . '/db_content/' . $txt_file;
    }

    public function addMessage()
    {
        ini_set('memory_limit', '-1');
        $id = $this->model->getId();
        foreach ($id as $id_) {
            for ($i = 0; $i < 3; $i++) {
                $value[$id_ . $i] = "NULL,$id_,theme_message - $id_ - $i,content_message - $id_ - $i";
            }
        }
        $comma_separated = implode("\n", $value);
        file_put_contents($this->getTxtFile(), $comma_separated);
    }

    public function addMessageFileToBd()
    {

        $query = 'LOAD DATA INFILE "/xampp2/htdocs/forum.local/db_content/messages.txt" INTO TABLE `forum1.3`.`messages` FIELDS TERMINATED BY "," LINES TERMINATED BY "\n";';


        if (!mysql_query($query)) {
            die('Не удалось добавить запись' . mysql_errno() . ' - ' . mysql_error());
        }
    }
} 