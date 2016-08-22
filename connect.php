<?php
    $conn = mysql_connect("localhost", "root","");
    mysql_select_db("_system");


    if(!$conn){
        echo "Error occured while connecting with database...".mysql_connect_errno();
    }else{
        //echo "Got connected...<br/>";
    }

 ?>
