<?php
/**
 * Created by PhpStorm.
 * User: helena
 * Date: 02.04.2015
 * Time: 14:15
 */

class CounterClass extends SiteController{

    public function getBrowsings($id){
        $query = "SELECT `browsing` FROM `topic` WHERE id = $id";
        $result = mysql_query($query);
        if($result){
            $row = mysql_fetch_assoc($result);
            $name = $row["browsing"];
            return $name;
        }
        else {
            return false;
        }
    }

    public function upBrowsing($id){
        $counter = $this->getBrowsings($id);
        $counter = ++$counter;
        $query = "UPDATE `topic` SET `browsing`='$counter' WHERE `id`='$id' LIMIT 1";
        if(!mysql_query($query)){
            die(mysql_error());
        }
    }
} 