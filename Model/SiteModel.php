<?php

/**
 * Created by PhpStorm.
 * User: helena
 * Date: 31.03.2015
 * Time: 8:40
 */
class SiteModel extends DbaseClass
{

    private $table;
    static $sql_time = 0;
    static $query_count = 0;

    /**
     * @return int
     */
    public function getSqlTime()
    {
        return self::$sql_time;
    }

    /**
     * @param int $sql_time
     */
    public static function setSqlTime($time)
    {
        self::$sql_time = $time;
    }


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    public function getId()
    {
        $table = $this->getTable();
        $sql = "SELECT id FROM `$table`";
        $result = $this->query($sql);
        $id = [];
        $i = 0;
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $id[$i++] = $row['id'];
        }

        mysql_free_result($result);
        return $id;
    }

    public function getTopic($id)
    {

        $query = "SELECT * FROM `topic` WHERE id = '$id' LIMIT 1";


        return $this->result($query);
    }

    public function getComments($id)
    {


        $query = "SELECT `theme`, `content` FROM  `messages` WHERE `id_topic` = $id";

        return $this->resultRow($query);
    }

    private function result($query)
    {
        $result = $this->query($query);
        if ($result) {
            $row = mysql_fetch_assoc($result);
            return $row;
        } else {
            return false;
        }
    }

    private function resultRow($query)
    {
        $result = $this->query($query);
        if ($result) {
            $i = 0;
            $row = [];
            while ($row_ = mysql_fetch_row($result)) {
                $i++;
                $row[$i] = $row_;
            }
            return $row;
        } else {
            return false;
        }
    }

    private function countRow($table, $field = 'id')
    {


        $query = "SELECT COUNT($field) FROM `$table`";
        $result = $this->query($query);
        if ($result) {
            $row = mysql_fetch_assoc($result);

        }
        return $row["COUNT(id)"];

    }

    public function search()
    {
        $search = $_GET['search'];
        $query = "
                  SELECT
                      topic.name, messages.theme, messages.content
                  FROM
                      messages
                  JOIN
                      topic
                  ON
                      topic.id = messages.id_topic
                  WHERE
                      messages.theme LIKE '%$search%'
                  OR
                      topic.name LIKE '%$search%'
                  OR
                      messages.content LIKE '%$search%'

                  ";



        $result = $this->query($query);
        if ($result) {
            $i = 0;
            $row_ = [];
            while ($row = mysql_fetch_row($result)) {
                $i++;
                $row_[$i] = $row;
            }
            return $row_;
        } else {
            return false;
        }

    }

    public function query($query)
    {
self::$query_count++;
        $time = microtime(true);
        $result = mysql_query($query);
        $duration = microtime(true);
        $this->setSqlTime($this->getSqlTime() + ($duration - $time));
        return $result;
    }


}