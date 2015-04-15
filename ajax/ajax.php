<?php
if (isset($_POST['id_post']) && isset($_POST['theme']) && isset($_POST['content'])){
    $message = [
        'id_post'   => mysql_real_escape_string($_POST['id_post']),
        'theme'     => mysql_real_escape_string($_POST['theme']),
        'content'   => mysql_real_escape_string($_POST['content']),
    ];

    $message['id_post']     = mysql_real_escape_string($_POST['id_post']);
    $message['theme']       = mysql_real_escape_string($_POST['theme']);
    $message['content']     = mysql_real_escape_string($_POST['content']);

    echo '<h3>Тема:' . $message['theme'] . '</h3>';
    echo '<p>' . $message['content'] . '</p><hr/>';

require_once '../core/App.php';
$config = '../config/main.php';
App::getConfig($config);
App::Register();
$controller = new MessagesController();
$controller->addMessage($message);
?>

<?php } ?>

