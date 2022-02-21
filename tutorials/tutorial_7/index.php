<html>

<body>
    <div id="wrapper">
        <form method="post" action="">
            Name<input type="text" name="qr_text"><br><br><br>
            Folder<input type="text" name="folder"><br><br><br>
            <input type="submit" name="generate_text" value="Generate">
        </form>
    </div>
    <?php
    include('phpqrcode/qrlib.php'); 
    if(isset($_POST['generate_text'])){
        $text=$_POST['qr_text'];
        $folder = $_POST['folder'];
        $dirPath = ''.$folder;
        if(!is_dir($dirPath)){
            mkdir($dirPath);
        }
        $file_name1="qr.png";
        $file_name= $dirPath. "/" .$file_name1;
        QRcode::png($text,$file_name);
        echo "<img alt='".$file_name."' src='".$file_name."'>";
        $text=$_POST['qr_text'];
        echo "<img alt='testing' src='php-barcode/barcode.php?codetype=Code39&size=40&text=".$text."&print=true' />";
    }
    ?>
</body>

</html>