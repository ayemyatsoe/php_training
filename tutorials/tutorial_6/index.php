<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>

<body>
    <h3>File Store</h3>
    <form method="Post" enctype="multipart/form-data">
        <input type="file" name="profile" accept="image/x-png, image/gif, image/jpeg"=><br><br><br>
        <input type="text" name="folder"><br><br><br>
        <input type="submit" name="btn" value="Save">
    </form>
    <?php
        if(isset($_POST['btn'])){
            //echo "<pre>";
            //print_r($_FILES);
            $imgName= $_FILES['profile']['name'];
            $temName= $_FILES['profile']['tmp_name'];
            $folder = $_POST['folder'];
            $dirPath = ''.$folder;
            if(!is_dir($dirPath)){
                mkdir($dirPath);
            }
            $target =  $dirPath. "/" .basename($imgName);
            $result = move_uploaded_file($temName,$target);
            if ($result) {
                 echo ' was uploaded<br />';
            } else {
                 echo ' failed to upload<br />';
            }

        }
    ?>
</body>

</html>