
<div class="detail">
    <h3>тема: <?php echo $topic['name']; ?></h3>
    <h6>Создана: <?php echo date('F j, Y, H:i:s', $topic['create_time']); ?></h6>
    <h6>Последнее сообщение: <?php echo date('F j, Y, H:i:s', $topic['update_time']); ?></h6>
    <div class="send">
        <form name="new_message"">
            <h4>Ответить</h4>
            <label for="theme">Тема:</label><br/><input id="theme" name="theme" value="" type="text"><br/>
            <label for="content">Сообщение:</label><br/><textarea id="content" name="content" value="" type="text"></textarea><br/>
            <input type='button' onclick='ajaxFunction()' value='Отправить'>
        </form>
    </div>

    <div class="request">
        <h2>Комментарии:</h2>
        <div id='ajaxDiv'>
        </div>
        <?php foreach ($comments as $comment): ?>
            <h3>Тема: <?php echo $comment[0] ?></h3>
            <p><?php echo $comment[1] ?></p>
            <hr/>
        <?php endforeach; ?>

    </div>

</div>

<script language="javascript" type="text/javascript">
    <!--
    //Browser Support Code
    function ajaxFunction(){
        var ajaxRequest;

        try{
            // Opera 8.0+, Firefox, Safari
            ajaxRequest = new XMLHttpRequest();
        } catch (e){
            // Internet Explorer Browsers
            try{
                ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try{
                    ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e){

                    alert("Your browser broke!");
                    return false;
                }
            }
        }

        ajaxRequest.onreadystatechange = function(){
            if(ajaxRequest.readyState == 4){
                var     ajaxDisplay             = document.getElementById('ajaxDiv');
                        ajaxDisplay.innerHTML   = ajaxRequest.responseText;
            }
        };
        var theme   = document.getElementById('theme').value;
        var content = document.getElementById('content').value;
        var id_post = '<?php echo $_GET['topic'];?>';


        var queryString = "&theme=" + theme + "&content=" + content + "&id_post=" + id_post  ;
        ajaxRequest.open("POST" , '/ajax/ajax.php' , true);
        ajaxRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        ajaxRequest.send(queryString);

    }

    //-->
</script>


