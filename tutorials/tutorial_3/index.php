<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.form-wrapper{
  margin:0 auto;
  width:50%;
  padding:20px;
  margin-top:30px;
  background: #fff;
  box-shadow: 0 3px 10px rgba(140,152,164,0.3);
}
.input-wrapper{
  margin-bottom: 20px;
}
.input-wrapper label{
  padding-right:20px;
}
.result-wrapper{
  font-size: 20px;
    font-weight: bold;
    padding: 10px;
    background: #609460;
    color: #fff;
}
body{
  background: #eee;
}
h1.center{
  text-align: center;
}
</style>

</head>
<body>
<?php
function getAge($dob){
  $bday = new DateTime($dob);
  $today = new Datetime(date('m.d.y'));
  if($bday>$today){
    return 'You are not born yet';
  }
  $diff = $today->diff($bday);
  return 'Your Current Age is : '.$diff->y.' Years, '.$diff->m.' month, '.$diff->d.' days';
}
?>
<h1 class="center">Calculate Age from DOB</h1>
<hr>
<div class="form-wrapper">
  <form>
    <div class="input-wrapper">
      <label>Date of Birth</label>
      <input type="date" name="dob" value="<?php echo (isset($_GET['dob']))?$_GET['dob']:'';?>">
      <input type="submit" value="Calculate Age">
    </div>
  </form>
  <?php
  $age=$_GET['dob'];
    if(isset($age) && $age!=''){?>
      <div class="result-wrapper">
        <?php echo getAge($age);?>
      </div>
    <?php }
  ?>
</div>
</body>
</html>