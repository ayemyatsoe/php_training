<?php 

if(isset($_POST['registerbtn'])) {
	session_start(); 
	$name = $_POST['name'];
	$email= $_POST['email'];
	$password = $_POST['psw'];
	$psw_repeat= $_POST['psw-repeat'];
	$_SESSION['name']=$name;
	$_SESSION['email']=$email;
	$_SESSION['psw']=$password;
	$_SESSION['psw-repeat']=$psw_repeat;
	echo  $_SESSION['name'];
}
if(isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $psw = $_POST['lpsw'];
     
    if($uname ==  $_SESSION['name'] and $psw ==  $_SESSION['psw'])
    {    
        session_start();
        echo "Logged in successfully";
    }
    else {
        echo "Your information is not correct";
    }
    
   }
 ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}


</style>
</head>
<body>

<h2>Login Form</h2>

<form action="welcome.php" method="post">
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="lpsw" required>
    <button type="submit" name="login">Login</button>
  </div>
</form>

</body>
</html>
