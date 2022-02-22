<?php
include("db.php");
$name = "";
$address = "";
$email = "";
$phone = "";
$education = "";
$password ="";
$confirm_password ="";
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM tb_crud WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $name = $row['name'];
    $email = $row['email'];
	$address = $row['address'];
    $phone = $row['phone'];
    $education = $row['education'];
    $confirm_password  = $row['confirm_password'];
    $password = $row['password'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $education = $_POST['education'];
  $password = $_POST['password'];
  $confirm_password  = $_POST['confirm_password'];
  $query = "UPDATE tb_crud set 
      name = '$name',
      email = '$email',
      address = '$address',
      phone = '$phone',
      education = '$education',
      password ='$password',
      confirm_password ='$confirm_password'
    WHERE id=$id";
  mysqli_query($conn, $query);
  header('Location: index.php');
}
?>
<?php include('includes/header.php'); ?>
<div class="container">
    <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="input-group"><label>NameU</label><input type="text" name="name" value="<?php echo $name; ?>" placeholder="Update Name"></div>
        <div class="input-group"><label>Email</label><input type="email" name="email" value="<?php echo $email; ?>" placeholder="Update Email"></div>
        <div class="input-group"><label>Password</label><input type="password" name="password" value="<?php echo $password; ?>" placeholder="Update Password"></div>
        <div class="input-group"><label>Confirm_Password</label><input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>" placeholder="Update Password"></div>
        <div class="input-group"><label>Address</label><input type="text" name="address" value="<?php echo $address; ?>" placeholder="Update Title"></div>
        <div class="input-group"><label>Phone</label><input type="phone" name="phone" value="<?php echo $phone; ?>" placeholder="Update Title"></div>
        <div class="input-group"><label>Education</label><input type="text" name="education" value="<?php echo $education; ?>" placeholder="Update Title"></div>
        <div class="input-group"><button class="btn" name="update">Update</button></div>
    </form>
</div>
<?php include('includes/footer.php'); ?>