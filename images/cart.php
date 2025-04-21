<?php
include 'config.php';

if(isset($_POST['update_update_btn'])){
    $update_value = $_POST['update_available_quantity'];
    $update_id = $_POST['update_available_quantity_id'];

    $select_medicine = mysqli_query($conn, "SELECT available_quantity FROM `medicines` WHERE id = '$update_id'");
    if($select_medicine && mysqli_num_rows($select_medicine) > 0) {
        $fetch_medicine = mysqli_fetch_assoc($select_medicine);
        $available_quantity = $fetch_medicine['available_quantity'];

        if($update_value > $available_quantity) {
            echo "<script>alert('Quantity exceeds available stock!');</script>";
        } elseif($update_value <= 0) {
            echo "<script>alert('Please select a valid quantity!');</script>";
        } else {
            // Update quantity in the cart
            $update_query = mysqli_query($conn, "UPDATE `cart` SET available_quantity = '$update_value' WHERE id = '$update_id'");
            if($update_query){
                echo "<script>alert('Quantity updated successfully!');</script>";
            } else {
                echo "<script>alert('Error updating quantity');</script>";
            }
        }
    } else {
        echo "<script>alert('Error fetching available quantity');</script>";
    }
}

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    $remove_query = mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
    if($remove_query){
        header('location:cart.php');
        exit();
    } else {
        echo "Error removing item: " . mysqli_error($conn);
    }
}

if(isset($_GET['delete_all'])){
    $delete_all_query = mysqli_query($conn, "DELETE FROM `cart`");
    if($delete_all_query){
        header('location:cart.php');
        exit();
    } else {
        echo "Error deleting all items: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Cart</title>
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style.css">
  
</head>
<body>
<div class="container">
    <section class="medicine-cart">
        <h1 class="heading">Medicine Cart</h1>
        <table>
            <thead>
                <!-- Table headers -->
                <th>Image</th>
                <th>Id</th>
                <th>Name</th>
                <th>Price</th>
                <th>Available Quantity</th> 
                <th>Manufactured date</th>
                <th>Expiry date</th>
                <th>Company name</th>
                <th>Total Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php 
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                $grand_total = 0;
                if(mysqli_num_rows($select_cart) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                        // Fetch available quantity for each item from the database
                        $m_id = $fetch_cart['id'];
                        $select_medicine = mysqli_query($conn, "SELECT available_quantity FROM `medicines` WHERE id = '$m_id'");
                        if($select_medicine && mysqli_num_rows($select_medicine) > 0) {
                            $fetch_medicine = mysqli_fetch_assoc($select_medicine);
                            $available_quantity = $fetch_medicine['available_quantity'];
                        } else {
                            $available_quantity = 'N/A'; 
                        }
                        
                        // Calculate subtotal based on updated quantity
                        $sub_total = $fetch_cart['price'] * $fetch_cart['available_quantity'];
                        $grand_total += $sub_total;
                ?>
                <tr <?php if($available_quantity == 0) echo 'style="opacity: 0.5;"'; ?>>
                    <!-- Table data -->
                    <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                    <td><?php echo $fetch_cart['id']; ?></td>
                    <td><?php echo $fetch_cart['name']; ?></td>
                    <td>&#8377;<?php echo number_format($fetch_cart['price']); ?>/-</td>
                    <td><?php echo $available_quantity; ?></td>
                    <td><?php echo $fetch_cart['mfg_date']; ?></td>
                    <td><?php echo $fetch_cart['exp_date']; ?></td>
                    <td><?php echo $fetch_cart['company_name']; ?></td>
                    <td>&#8377;<?php echo number_format($sub_total); ?>/-</td>
                    <td>
                        <form action="" method="post" onsubmit="return validateQuantity(<?php echo $available_quantity; ?>)" <?php if($available_quantity == 0) echo 'disabled'; ?>>
                            <input type="hidden" name="update_available_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                            <input type="number" name="update_available_quantity" min="0" value="<?php echo $fetch_cart['available_quantity']; ?>" <?php if($available_quantity == 0) echo 'disabled'; ?>>
                            <input type="submit" value="Update" name="update_update_btn" <?php if($available_quantity == 0) echo 'disabled'; ?>>
                        </form>
                    </td>
                    <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> Remove</a></td>
                </tr>
                <?php
                    }
                }
                ?>
                <!-- Table footer and checkout button -->
                <tr class="table-bottom">
                    <td><a href="medicines.php" class="option-btn" style="margin-top: 0;">Continue Shopping</a></td>
                    <td colspan="3">Grand Total</td>
                    <td>&#8377;<?php echo number_format($grand_total); ?>/-</td>
                    <td><a href="cart.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> Delete All </a></td>
                </tr>
            </tbody>
        </table>
        <div class="checkout-btn">
            <a href="checkout.php" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
        </div>
    </section>
<div class="back-button">
            <a href="customer_home.html">Back</a>
        </div>

</div>
</body>
</html>
