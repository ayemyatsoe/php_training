<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>
<div class="container">
    <form method="post" action="">
        <div class="input-group"><label>Name</label><input type="text" name="name" value=""></div>
        <div class="input-group"><label>Email</label><input type="email" name="email" value=""></div>
        <div class="input-group"><label>Password</label><input type="password" name="password" value=""></div>
        <div class="input-group"><label>Confirm_Password</label><input type="password" name="confirm_password" value=""></div>
        <div class="input-group"><label>Address</label><input type="text" name="address" value=""></div>
        <div class="input-group"><label>Phone</label><input type="phone" name="phone" value=""></div>
        <div class="input-group"><label>Education</label><input type="text" name="education" value=""></div>
        <div class="input-group"><button class="btn" type="submit" name="save">Save</button></div>
    </form>

</div>
<div class="container">
    <?php 
    $db = mysqli_connect('localhost', 'root', 'root', 'db_crud');
    $results = mysqli_query($db, "SELECT * FROM tb_crud"); ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Education</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['education']; ?></td>

            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit_btn">Edit</a>
            </td>
            <td>
                <a href="delete_student.php?id=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
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
        if(!empty($name) && !empty($email) && !empty($password) && !empty($confirm_password) && !empty($address) && !empty($phone) && !empty($education)){
            if(strlen($password) >= 6 && strlen($confirm_password) >= 6){
                if($password == $confirm_password){
                 $status = checkStrongPassword($password);
                 if($status){
                    mysqli_query($db, "INSERT INTO tb_crud (name, email,address,phone,education,password,confirm_password) VALUES ('$name', '$email', '$address', '$phone', '$education','$password','$confirm_password')"); 
                    
                 }
                 else {
                     echo "Your Password is not Strong Password eg A-Z and a-z and 0-9 ";
                 }
                }
                else {
                    echo "Password not same";
                }
             }
             else {
                 echo "Password must not greater 6";
             }
            
        }
        else {
            echo "Need to Fill";
        }
	}
    ?>
<?php include('includes/footer.php'); ?>