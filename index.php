<?php
    session_start();
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

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
                                  echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='.bs-example-modal-sm'>" .$_SESSION['Email']. "</button>";
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
    <div class="jumbotron hero">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-push-7 phone-preview">
                    <div class="iphone-mockup"><img src="" class="device">
                        <div class="screen"></div>
                    </div>
                </div>
                <div class="col-md-6 col-md-pull-3 get-it">
                    <h1>Our Fantastic App</h1>
                    <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
                    <p><a class="btn btn-primary btn-lg" role="button" href="#"><i class="fa fa-apple"></i> Available on the App Store</a><a class="btn btn-success btn-lg" role="button" href="#"><i class="fa fa-google"></i> Available on Google Play</a></p>
                </div>
            </div>
        </div>
    </div>
    <section class="testimonials">
        <h2 class="text-center">People Love It!</h2>

    </section>

    <?php
      include("connect.php");
      error_reporting( error_reporting() & ~E_NOTICE );

       $FILE_NAME = $_FILES['file']['name'];
       $FILE_SIZE = $_FILES['file']['size'];
       $FILE_TYPE = $_FILES['file']['type'];
       $tmp_name =  $_FILES['file']['tmp_name'];
       $client = $_POST['filter'];
       $dropDownContent = '';
       $userFilter = mysql_query("select Email FROM user");
       while($row = mysql_fetch_array($userFilter)){
         $dropDownContent .="<option>" . $row['Email'] . "</option>";
       }

       $menu="
           <select class='form-control' name='filter' id='filter'>
             " . $dropDownContent . "
           </select>";
      if (isset($FILE_NAME)){
        if(!empty($FILE_NAME)){
          $location = 'assets/facturas/';
          if (move_uploaded_file($tmp_name, $location.$FILE_NAME)) {

            $result= mysql_query("INSERT INTO files (id, FILE_NAME, CLIENT_EMAIL,FILE_SIZE,FILE_TYPE) VALUES (NULL,' $FILE_NAME', '$client ', '$FILE_SIZE',' $FILE_TYPE')", $conn);

            echo 'Terminado Correctamente';
          }
        }else{
          echo 'Escoje un archivo!';
        }
      }

     ?>

    <div class="containers" style="margin-top:100px;">
       <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
         <div class="modal-dialog modal-sm" role="document">
           <div class="modal-content" style="padding-left:30px; padding-right:30px;">
             <div class="form-group">
               <br><br>
             <form action="index.php"  method="POST" enctype="multipart/form-data">
               <?php
                  echo $menu;
                ?>
               <label for="file-upload" class="custom-file-upload">
                   <i class="glyphicon glyphicon-upload"></i> Sube Factura
               </label>
               <input id="file-upload" type="file" name="file"/>
                <br>
                <input class="btn" type="submit" value="Submit" />
              </div>
             </form>
           </div>
         </div>
       </div>
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
