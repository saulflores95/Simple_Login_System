<?php
    session_start();
    include("connect.php");

    if(isset($_POST['submit']))
    {
        $Fname = $_POST['Fname'];
        $Lname = $_POST['Lname'];
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];


        $result = mysql_query("SELECT Email FROM user WHERE Email='$Email'", $conn);
        $Emailcheck = mysql_num_rows($result);

        if($Emailcheck > 0){
            header("Location: ../index.php");
            exit();
        }else{
            //echo $Fname."<br/>".$Lname."<br/>".$Email."<br/>".$Password."<br/>";

            $result= mysql_query("INSERT INTO user (UserID, Fname, Lname,Email,Password) VALUES (NULL,'$Fname', '$Lname', '$Email','$Password')", $conn);
            //echo $Fname . "'s data added";
        }


    }

 ?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/styles.css">
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
    <div class="login-card"><img src="assets/img/avatar_2x.png" class="profile-img-card">
        <p class="profile-name-card"> </p>
        <form method="POST" action="register.php" enctype="multipart/form-data" class="form-signin">
            <input class="form-control" type="text" name="Fname" required="" placeholder="Nombre" maxlength="20" minlength="3" autofocus="" inputmode="latin-name">
            <input class="form-control" type="text" name="Lname" required="" placeholder="Apellido" maxlength="20" minlength="3" inputmode="latin-name">
            <input class="form-control" type="email" name="Email" required="" placeholder="Correo" autofocus="" id="inputEmail">
            <input class="form-control" type="password" name="Password" required="" placeholder="Contraseña" id="inputPassword">
            <div class="checkbox"></div>
            <button class="btn btn-primary btn-block btn-lg btn-signin" name="submit" type="submit">Registrar </button>
        </form>
        <a href="login.php" class="forgot-password">Regresar</a>

    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
