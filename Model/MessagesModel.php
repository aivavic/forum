<?php
/**
 * Created by PhpStorm.
 * User: helena
 * Date: 02.04.2015
 * Time: 18:34
 */

class MessagesModel extends  SiteModel{

    public function __construct()
    {
        parent::__construct();
        $this->setTable('messages');
    }

    public function sendMessage($message)
    {
        $id_topic = $message['id_post'];
        $theme = $message['theme'];
        $content = $message['content'];
        $sql = "INSERT INTO `messages`
                    (`id`, `id_topic`, `theme`, `content`)
                VALUES
                    (NULL, '$id_topic', '$theme', '$content' );";
$result2 = $this->query($sql);
        if(!$result2){
            die(mysql_error());
        }
        $get_num = "SELECT reply FROM `topic` WHERE id = $id_topic";

        $result = $this->query($get_num);
        if($result){
            $row = mysql_fetch_row($result);
            $i = ++$row[0];
$time = microtime(true);

            $query = "UPDATE `topic` SET `reply` = '$i', `update_time` = '$time' WHERE `id` = $id_topic;";
            $update =$this->query($query);



            if(!$update) {
                die(mysql_error());
            }
        }

    }
} 