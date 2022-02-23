<?php
require_once("phpChart_Lite/conf.php");
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>phpChart - Basic Chart</title>
</head>

<body>

    <?php
    $db = mysqli_connect('localhost', 'root', 'root', 'db_crud');
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else {
       
    }
    $results = mysqli_query($db, "SELECT phone FROM tb_crud");
    $age = array();
    while ($row = mysqli_fetch_assoc($results)) {
        $age[] = $row['phone']; 
    }
    $pc = new C_PhpChartX(array($age),'basic_chart');
    $pc->set_animate(true);
    $pc->set_title(array('text'=>'Age Chart'));
    $pc->draw();
    ?>

</body>

</html>