<?php

    $name=$_POST['name'];
    $email=$_POST['email'];
    $number=$_POST['number'];
    $message=$_POST['message'];

    $con=mysql_connect("localhost","root","");
    mysql_select_db("shop_db",$con);
    mysql_query("insert into request values('$name','$email','$number','$message')"); 
 
    echo "<script>alert('Thank You For Your Message.');window.location.href='customer_home.html';</script>";
   
    exit;

?>