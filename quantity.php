<?php
$available_quantity = $_POST['available_quantity']; // available quantity name
$requested_quantity = $_POST['quantity'];

if ($available_quantity <= $requested_quantity) {
    
       
} elseif ($available_quantity > $requested_quantity) {
    // Display message for more than quantity
    echo '<script>alert("Error: Available quantity is more than requested quantity.");';
    echo 'window.location.href = "cart.php";</script>';
} else {
    // Display message for no stack
    echo '<script>alert("Error: No stack available.");';
    echo 'window.location.href = "cart.php";</script>';
}
?>