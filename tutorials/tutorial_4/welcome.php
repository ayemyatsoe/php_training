<?php 
 session_start();
if(isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $psw = $_POST['lpsw'];
    if($uname ==  $_SESSION['name'] and $psw ==  $_SESSION['psw'])
    {
        ?>
        Welcome <?php echo $uname; ?>. Click here to <a href="logout.php">Logout.
        <?php
        }else echo "<h1>Please login first .</h1>";
       
   }
?>

