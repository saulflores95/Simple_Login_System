<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Uploading Images</title>
    </head>
    <body>
        <form method="POST" action="fUpload.php" enctype="multipart/form-data">
            <input type="file" name="fileUpload">
            <input type="submit" name="upload" value="Upload Now">
        </form>

    </body>
</html>
<?php
if(isset($_POST['upload'])){

     $file_name = $_FILES['fileUpload']['name'];
     $file_type = $_FILES['fileUpload']['type'];
     $file_size = $_FILES['fileUpload']['size'];
     $file_tmp_name = $_FILES['fileUpload']['tmp_name'];

    if($file_name == ''){
        echo "<script>alert('Selecciona un archivo')</script>";
        exit();
    }else{
        move_uploaded_file($file_tmp_name,"../assets/img/$file_name");
        echo "Archivo arriba";
    }

}
 ?>
