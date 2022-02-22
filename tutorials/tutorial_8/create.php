<?php 
	$db = mysqli_connect('localhost', 'root', 'root', 'db_crud');
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	$name = "";
	$address = "";
    $email = "";
	$phone = "";
    $password ="";
    $confirm_password ="";
    $education = "";
    $id=0;
    $update = false;
    
function checkStrongPassword($password){
    $upperStatus= false;
    $lowerStatus= false;
    $numberStatus= false;
    $specialStatus= false;
    if(preg_match('/[A-Z]/',$password)){
        $upperStatus = true;
    }
    if(preg_match('/[a-z]/',$password)){
        $lowerStatus = true;
    }
    if(preg_match('/[0-9]/',$password)){
        $numberStatus = true;
    }
    if(preg_match('/[!@#$%*&]/',$password)){
        $specialStatus = true;
    }
    if($upperStatus && $lowerStatus && $numberStatus && $specialStatus){
        return true;
    }
    else {
       return false;
    }
}
	if (isset($_POST['save'])) {
		$name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
		$confirm_password  = $_POST['confirm_password'];
		$address = $_POST['address'];
        $phone = $_POST['phone'];
        $education = $_POST['education'];
        if(!empty($name)){
            mysqli_query($db, "INSERT INTO tb_crud (name, email,address,phone,education,password,confirm_password) VALUES ('$name', '$email', '$address', '$phone', '$education','$password','$confirm_password')"); 
            echo "Success";
        }
        else {
            echo "please";
        }
      
	}
    ?>