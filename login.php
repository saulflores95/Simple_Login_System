<?php
    session_start();

    include("connect.php");

    if(isset($_POST['submit']))
    {
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];

    //        echo $Email."<br/>".$Password."<br/>";

        $result = mysql_query("SELECT * FROM user WHERE Email='$Email' AND Password = '$Password'", $conn);


        if(!$row = mysql_fetch_assoc($result)){
            echo"<script>alert('Correo o contrasena son incorrectos')</script>";
        } else{
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['id'] = $row['user_type'];

            header("Location: index.php");


        }

    }

 ?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign_In</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="index.php"><i class="glyphicon glyphicon-phone"></i>Mobile App</a>
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
    <div class="login-card"><img src="assets/img/avatar_2x.png" class="profile-img-card">
        <p class="profile-name-card"> </p>
        <form method="POST" action="login.php" enctype="multipart/form-data" class="form-signin">
            <input name="Email" class="form-control" type="email" required="" placeholder="Correo" autofocus="" id="inputEmail">
            <input name="Password" class="form-control" type="password" required="" placeholder="Contrasena" id="inputPassword">
            <div class="checkbox">
                <div class="checkbox">
                    <label>
                        <input type="checkbox">Recordar</label>
                </div>
            </div>



            <button class="btn btn-primary btn-block btn-lg btn-signin" name="submit" type="submit">Ingresa </button>
        </form><a href="#" class="forgot-password">Olvidaste la contraseña?</a>


        <div class="row">
            <div class="col-md-12"><a href="register.php" class="forgot-password">Crear Usuario</a></div>
        </div>

        <?php
        if(isset($_SESSION['Email'])){
            echo $_SESSION['Email'];
        }else{
            echo "No a iniciado session";
        }
         ?>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
