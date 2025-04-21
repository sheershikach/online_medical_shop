<?php

$servername = "localhost"; 
$admin_name = "root";
$password = ""; 
$dbname = "admin_database"; 
$conn = new mysqli($servername, $admin_name, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $admin_name = $_POST['admin_login_name'];
    $admin_password = $_POST['admin_login_password'];

   
    $sql = "SELECT * FROM admin WHERE admin_name = '$admin_name' AND  password = '$admin_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('Login successfully done!!'); window.location.href='new adminhomepg.html';</script>";
        exit();
    } else {
        echo "<script>alert('Invalid credentials. Please try again.'); window.location.href='admin.html';</script>";
        
        exit();
    }
}


$conn->close();
?>
