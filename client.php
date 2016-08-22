<?php
    session_start();
    if($_SESSION['Email'] == null){
        header("Location: login.php");
    }else{
        if($_SESSION['id'] == 'admin'){
            header("Location: admin.php");
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
         $user = $_SESSION['Email'];

        // $result = mysql_query("SELECT * FROM user where Email IN(SELECT email FROm user GROUP by Email HAVING count(*)>1)");
        $result =  mysql_query("SELECT * FROM user WHERE Email='$user'");
         echo "<table class='table table-hover'>
         <tr>
         <th>Nombre</th>
         <th>Apellido</th>
         <th>Correo</th>
         <th>Factura</th>

         </tr>";

         while($user = mysql_fetch_array($result)){
             echo "<form action=admin.php method=post>";
             echo "<tr>";
             echo "<td>". "<input class=form-control  disabled='disabled' type=text name=fname value=" .  $user['Fname'] . " /> </td>";
             echo "<td>". "<input class=form-control  disabled='disabled' type=text name=lname value=" . $user['Lname'] . " /> </td>";
             echo "<td>". "<input class=form-control type=email name=email value=" . $user['Email'] . " /> </td>";
             echo "<td><a href=assets/img/".$user['FILE_NAME'].">Factura</a></td>";

             echo "<td>". "<input class=form-control type=hidden name=hidden value=" .  $user['Fname'] . " </td>";

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
