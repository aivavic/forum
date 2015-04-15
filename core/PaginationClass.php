<?php

/**
 * Created by PhpStorm.
 * User: helena
 * Date: 31.03.2015
 * Time: 15:28
 */
class PaginationClass extends SiteModel
{

    private $count_pages = 50;
    private $active = 15;
    private $count_show_pages = 10;
    private $url = "/index.php";
    private $url_page = "/index.php?page=";
    private $id_count;
    private $table;





    public function __construct($table, $time, $where = 'WHERE 1')
    {

        $this->setTable($table);
        $this->setIdCount($where);
    }



    public function setTable($table)
    {
        $this->table = $table;
    }

    public function getTable()
    {
        return $this->table;
    }

    public function setCountPages($count_pages)
    {
        $this->count_pages = $count_pages;
    }

    public function getCountPages()
    {
        return $this->count_pages;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setCountShowPages($count_show_pages)
    {
        $this->count_show_pages = $count_show_pages;
    }


    public function getCountShowPages()
    {
        return $this->count_show_pages;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setUrlPage($url_page)
    {
        $this->url_page = $url_page;
    }

    public function setIdCount($where = 1)
    {
        $table = $this->getTable();
        $id = "SELECT COUNT(id) FROM `$table` $where";
        $result = $this->query($id);
        if ($result) {
            $row = mysql_fetch_assoc($result);
        }


        $this->id_count = $row["COUNT(id)"];
    }

    public function getIdCount()
    {
        return $this->id_count;
    }

    public function start()
    {
        $pages = round($this->getIdCount() / $this->count_pages);
        echo "Страниц: " . $pages;
    }

    public function getPage()
    {
        $table = $this->getTable();
        $current = 0;
        if (isset($_GET['page'])) {
            $current = $_GET['page'];
        }
        $this->setActive($current);
        $startEntry = $this->getActive() * $this->getCountPages();


        $sql = "SELECT * FROM `$table` LIMIT " . $startEntry . ", " . $this->getCountPages() . "";
        $result = $this->query($sql);
        $topic = [];
        $i = 0;
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $topic[$i++] = $row;
        }

        mysql_free_result($result);


        return $topic;
    }

    public function getLinks()
    {
        $end = floor($this->getIdCount() / $this->getCountPages());

        $prev = $this->getActive() - 1;
        if($prev <= 0){
            $prev = 0;
        }

        $next = $this->getActive() + 1;
        if($next >= $end){
            $next = $end;
        }
        $max_show = $prev + $this->getCountShowPages();
        echo '<div class="pagination">';
        echo '<a href="' . $this->url_page . 0 . '"> <<< Начало </a>';
        echo '<a href="' . $this->url_page . $prev . '"> < Предыдущая </a>';
        echo '<a href="' . $this->url_page . $this->getActive() . '" style="font-weight: bold;">' . $this->getActive() . '</a>';
        for ($i = $next; $i <= $max_show && $i <= $end; $i++) {
            echo '<a href="' . $this->url_page . $i . '">' . $i . '</a>';
        }
        echo '<a href="' . $this->url_page . $next . '"> Следующая > </a>';
        echo '<a href="' . $this->url_page . $end . '"> Конец >>> </a>';
        echo '</div>';
    }
} 