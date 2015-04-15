<?php

$start = microtime(true);
?>
<html>
<head>
    <base href="<?php echo App::$config['baseUrl']; ?>/index.php">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo App::$config['SiteName']; ?></title>
    <link rel="stylesheet" href="<?php echo App::$config['baseUrl']; ?>/css/style.css"/>

</head>
<body>
<header>
    <div class="wrapper">
        <a class="logo" href="<?php echo App::$config['baseUrl']; ?>"><?php echo App::$config['SiteName']; ?></a>

        <form method="get" style="float: right">
            <input type="text" name="search"/>
            <button type="submit" >Поиск</button>
        </form>
    </div>
</header>
<div class="wrapper">
<?php

RouteClass::run();
?>
    <div class="stat">

        [<?php
        $model = new SiteModel();
        $PHPtime = microtime(true) - $start;
        $SQLtime = $model->getSqlTime();
        $sql = round(($SQLtime / $PHPtime) * 100);
        $php = 100 - $sql;
        printf('Time: %.4F s.', $PHPtime);?>
        | <?php echo 'PHP: ' . $php . '%' . ' SQL: ' . $sql . '%';?>
        | <?php printf('Sql Time %.4F s.', $SQLtime); ?>
        | <?php  echo ('Запросов выполнено: '. $model::$query_count);?>]
    </div>
</div>
</body>
<?php

?>
</html>