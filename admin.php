<?php
    session_start();
    if($_SESSION['Email'] == null){
        header("Location: login.php");
    }else{
        if($_SESSION['id'] == 'client'){
            header("Location: client.php");
        }
    }
 ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Landing Page</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/user.css">
    </head>

    <body>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header"><a class="navbar-brand navbar-link" href="#"><i class="glyphicon glyphicon-phone"></i>Mobile App</a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active" role="presentation">
<?php
                                 if(isset($_SESSION['Email'])){
                                     echo "<a href='logout.php'>Log  Out</a></li>";
                                 }else{
                                     echo "<a href='login.php'>Log  In</a></li>";
                                 }
?>




                                <li role="presentation">
<?php
                                if(isset($_SESSION['Email'])){
                                    if($_SESSION['id'] == "admin"){
                                    echo "<a href='admin.php'>" .$_SESSION['Email']. "</a>";
                                }else{
                                    echo "<a href='client.php'>" .$_SESSION['Email']. "</a>";
                                }
                                }else{
                                    echo "<a href='login.php' >No a iniciado session</a>";
                                }
 ?>
                                </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container">
<?php
         include("connect.php");

         if(isset($_POST['update'])){

             $file_name = $_FILES['fileUpload']['name'];
             $file_type = $_FILES['fileUpload']['type'];
             $file_size = $_FILES['fileUpload']['size'];
             $file_tmp_name = $_FILES['fileUpload']['tmp_name'];


            $updateQuery = mysql_query("UPDATE user SET Fname='$_POST[fname]', Lname='$_POST[lname]', Email='$_POST[email]', user_type='$_POST[usser_type]', FILE_NAME='$file_name', FILE_SIZE='$file_size', FILE_TYPE='$file_type'  WHERE Email = '$_POST[hidden]'");
            move_uploaded_file($file_tmp_name,"assets/img/$file_name");
         };
         if(isset($_POST['delete'])){
            $deleteQuery = mysql_query("DELETE FROM user WHERE Email = '$_POST[hidden]'");

         };

         $result = mysql_query("SELECT * FROM user");
         echo "<table class='table table-hover'>
         <tr>
         <th>Nombre</th>
         <th>Apellido</th>
         <th>Correo</th>
         <th>user_type</th>
         <th>Factura</th>

         </tr>";

         while($user = mysql_fetch_array($result)){
             echo "<form action=admin.php method=post enctype=multipart/form-data>";
             echo "<tr>";
             echo "<td>". "<input  class=form-control type=text name=fname value=" .  $user['Fname'] . " </td>";
             echo "<td>". "<input  class=form-control type=text name=lname value=" . $user['Lname'] . " </td>";
             echo "<td>". "<input  class=form-control type=email name=email value=" . $user['Email'] . " </td>";

             echo "<td>".  "<input class=form-control type=text name=usser_type value=" . $user['user_type'] . " </td>";
             echo "<td>".  "<input class=form-control type=file name=fileUpload value=" . $user['FILE_NAME'] . " </td>";

             echo "<td>". "<input class=form-control type=hidden name=hidden value=" .  $user['Email'] . " </td>";

             echo "<td>". "<input class='btn btn-primary' type=submit name=update value=update" . " </td>";
             echo "<td>". "<input class='btn btn-danger' type=submit name=delete value=delete" . " </td>";
             echo "</tr>";
             echo "</form>";

         }

         echo "</table>";

         mysql_close($conn)


?>

        </div>
        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h5>Mobile App © 2016</h5></div>
                    <div class="col-sm-6 social-icons"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
                </div>
            </div>
        </footer>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>

    </html>
