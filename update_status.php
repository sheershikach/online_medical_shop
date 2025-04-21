<?php
$db_connection = mysqli_connect("localhost", "root", "", "shop_db");

if (!$db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$order_id = $_POST['id'];
$new_status = $_POST['new_status'];

$update_query = "UPDATE `order` SET Status='$new_status' WHERE id=$order_id";
mysqli_query($db_connection, $update_query);

header("Location: Status.php");

mysqli_close($db_connection);
?>
