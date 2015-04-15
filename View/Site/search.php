<?php
/**
 *
 * User: Viktor Afanasjev
 * Date: 03.04.2015
 * Time: 14:29
 */
?>
<div class="wrapper">
<?php
if($data){
foreach($data as $result):
?>
<h3>Тема: <?php echo $result[0]; ?></h3><br/>
<h4>Комментарий:    <?php echo $result[1]; ?><br/></h4>
<p>Содержание:    <?php echo $result[2]; ?></p><br/>
 <hr/>
<?php endforeach; }
else {
    echo 'Ничего не найдено';
}
?>

</div>