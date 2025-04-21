<?php
include 'config.php';
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    $remove_query = mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
    if($remove_query){
        header('location:orderpage.php');
        exit();
    } else {
        echo "Error removing item: " . mysqli_error($conn);
    }
}

if(isset($_GET['delete_all'])){
    $delete_all_query = mysqli_query($conn, "DELETE FROM `cart`");
    if($delete_all_query){
        header('location:orderpage.php');
        exit();
    } else {
        echo "Error deleting all items: " . mysqli_error($conn);
    }
}
?>
<html>
<head>
    <title>Medicine Cart</title>
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style.css">
<style>
    
  body {
        font-family: Arial, sans-serif; 
        background-color: #f4f4f4;
    }
    .container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    .heading {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    .checkout-btn {
        text-align: center;
        margin-top: 20px;
    }

    .checkout-btn .btn {
        padding: 15px 30px;
        background-color: #1abc9c;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .checkout-btn .btn:hover {
        background-color: #16a085;
    }

    .table-bottom td {
        padding-top: 15px;
        font-weight: bold;
    }


.back-button {
         display: block;
         margin: 20px auto;
         text-align: center;
         font-size:14px;
         font-weight:bold;
      }

      .back-button a {
         padding: 15px 30px;
         background-color: #333;
         color: white;
         text-decoration: none;
         border-radius: 10px;
         transition: background-color 0.3s ease;
      }

      .back-button a:hover {
         background-color: #555;
      }


</style>
</head>
<body>
<div class="container">
    <section class="medicine-cart">
        <h1 class="heading">Medicine Order Page</h1>
        <table>
            <thead>
                <!-- Table headers -->
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Available Quantity</th> 
               
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

                        // Only display rows if available quantity is not zero
                        if($available_quantity > 0) {
                            // Calculate subtotal based on updated quantity
                            $sub_total = $fetch_cart['price'] * $fetch_cart['available_quantity'];
                            $grand_total += $sub_total;
                ?>
                <tr>
                    <!-- Table data -->
                    <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                    <td><?php echo $fetch_cart['name']; ?></td>
                    <td>&#8377;<?php echo number_format($fetch_cart['price']); ?>/-</td>
                    <td><?php echo $available_quantity; ?></td>
                  
                    <td><?php echo $fetch_cart['company_name']; ?></td>
                    <td>&#8377;<?php echo number_format($sub_total); ?>/-</td>
                    <td><?php echo $fetch_cart['available_quantity']; ?></td>
                    <td><a href="orderpage.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> Remove</a></td>
                </tr>
                <?php
                        }
                    }
                }
                ?>
                <!-- Table footer and checkout button -->
                <tr  class="table-bottom">
                    <td><a href="medicines.php" class="option-btn" style="margin-top: 0;">Continue Shopping</a></td>

                    <td colspan="3">Grand Total</td>
           
                    <td>&#8377;<?php echo number_format($grand_total); ?>/-</td>
                    <td></td>
                    <td></td>
                    <td><a href="orderpage.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> Delete All </a></td>
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
