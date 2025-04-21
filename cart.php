<?php
@include 'config.php';

if(isset($_POST['buy'])){
    $m_id = $_POST['m_id'];
    $m_name = $_POST['m_name'];
    $m_price = $_POST['m_price'];
    $m_available_quantity = $_POST['m_available_quantity'];
   
    $m_mfg_date = $_POST['m_mfg_date'];
    $m_exp_date = $_POST['m_exp_date'];
    $m_company_name = $_POST['m_company_name'];
    $m_image = $_POST['medicine_image'];
   
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$m_name'");
    if(mysqli_num_rows($select_cart) > 0){
        echo "<script>alert('Medicine already added to order page');window.location.href='cart.php';</script></script>";
        exit();
    } else {
        $insert_medicine = mysqli_query($conn, "INSERT INTO `cart`(id, name, price, image, available_quantity,mfg_date, exp_date, company_name) VALUES ('$m_id', '$m_name', '$m_price', '$m_image', '$m_available_quantity', '$m_mfg_date', '$m_exp_date', '$m_company_name')");
        if($insert_medicine){
            echo "<script>alert('Medicine added to order page successfully');window.location.href='orderpage.php';</script>";
            exit();
        } else {
            echo "<script>alert('Failed to add medicine to order page');</script>";
        }
    }
}


if(isset($_POST['remove'])){
    $remove_id = $_POST['remove']; 
    $remove_query = mysqli_query($conn, "DELETE FROM `cartt` WHERE id = '$remove_id'");
    if($remove_query){
      echo "<script>alert('Medicine deleted successfully');window.location.href='cart.php';</script>";
        exit();
    } else {
        echo "Error removing item: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Medicines</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>

      .box {
         border: 1px solid #ccc;
         border-radius: 5px;
         padding: 10px;
         margin-bottom: 20px;
         background-color: #fff;
         box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      }
.box-container{
margin-top:30px;
}
      .box img {
         max-width: 100%;
         height: auto;
         margin-bottom: 10px;
      }
      .no-stock {
         color: red;
         font-size: 18px;
         font-weight: bold;
         text-transform: uppercase;
         background-color: #f8d7da; 
         padding: 10px; 
         border-radius: 5px; 
         margin-top: 10px; 
         text-align: center;
      }
      .empty {
         text-align: center;
         margin-top: 20px;
         color: #6c757d;
         font-size: 20px;
         font-weight: bold;
      }
      .box h3 {
         font-size: 18px;
         margin-bottom: 5px;
      }

      .box p {
         font-size: 13px;
         margin: 5px 0;
         font-family: bold;
      }

      .price {
         font-weight: bold;
         color: #1abc9c;
      }

      .btn-container {
         display: flex;
         justify-content: space-between;
         align-items: center;
      }

      .btn {
         background-color: sky-blue;
         color: #fff;
         border: none;
         padding: 5px 5px; 
         border-radius: 6px;
         cursor: pointer;
         margin-left:10px;
         transition: background-color 0.3s;
         flex: 1; 
      }

      .btn:hover {
         background-color: darkblack;
      }

      .disabled {
         pointer-events: none;
         opacity: 0.5;
      }

      .quantity-info {
         margin-top: 10px;
         margin-left: 30px; /* Adjust the left margin as needed */
         font-size: 16px;
         color: #555;
         display: flex;
         align-items: center;
      }

      .quantity-info .available {
         font-weight: bold;
         margin-right: 20px;
      }

      .quantity-info .available-quantity {
         color: #1abc9c;
      }

      .quantity-container {
         margin-top: 10px;
         margin-left: 50px; 
         display: flex;
         align-items: center;
      }

      .quantity-container label {
         font-size: 14px;
         font-weight: bold;
         color: #333;
         margin-right: 40px;
      }

      .quantity-input {
         width: 80px;
         padding: 10px;
         border: 2px solid #ccc;
         border-radius: 5px;
         text-align: center;
         font-size: 16px;
         outline: none;
         transition: border-color 0.3s;
      }

      .quantity-input:focus {
         border-color: #1abc9c;
         box-shadow: 0 0 5px rgba(26, 188, 156, 0.5);
      }
   </style>
</head>
<body>  

<?php include 'header1.php'; ?>
<?php include 'config.php'; ?>
<div class="container">

<section class="medicines">

   <h1 class="heading">Cart Medicines</h1>

   <div class="box-container">

      <?php
      
      $select_medicines = mysqli_query($conn, "SELECT * FROM `cartt`");
      if(mysqli_num_rows($select_medicines) > 0){
         while($fetch_medicine = mysqli_fetch_assoc($select_medicines)){
      ?>

      <div class="box">
         <form action="" method="post">
            <img src="<?php echo 'uploaded_img/'.$fetch_medicine['image']; ?>" alt="Medicine Image">

            <h3><?php echo $fetch_medicine['name']; ?></h3>
         
           
            
            <p>Manufacture Date: <?php echo $fetch_medicine['mfg_date']; ?></p>
            <p>Expiry Date: <?php echo $fetch_medicine['exp_date']; ?></p>
            <p>Company Name: <?php echo $fetch_medicine['company_name']; ?></p>
 <?php if ($fetch_medicine['available_quantity'] > 0): ?>
               <p style="font-size:15px;"><b>Selected Quantity: <?php echo $fetch_medicine['available_quantity']; ?></b></p>
               
            <div class="price">Price: &#8377;<?php echo $fetch_medicine['price']; ?>/-</div>




            <?php else: ?>
               <p class="no-stock">No Stock Available</p>
            <div class="price">Price: &#8377;<?php echo $fetch_medicine['price']; ?>/-</div>
            <?php endif; ?>
            <?php if ($fetch_medicine['available_quantity'] > 0): ?>
               <div class="btn-container">
                  <input type="hidden" name="m_id" value="<?php echo $fetch_medicine['id']; ?>">
                  <input type="hidden" name="m_name" value="<?php echo $fetch_medicine['name']; ?>">
                  <input type="hidden" name="m_price" value="<?php echo $fetch_medicine['price']; ?>">
                  <input type="hidden" name="m_mfg_date" value="<?php echo $fetch_medicine['mfg_date']; ?>">
                  <input type="hidden" name="m_exp_date" value="<?php echo $fetch_medicine['exp_date']; ?>">
                  <input type="hidden" name="m_company_name" value="<?php echo $fetch_medicine['company_name']; ?>">
                  <input type="hidden" name="m_available_quantity" value="<?php echo $fetch_medicine['available_quantity']; ?>">
                  <input type="hidden" name="medicine_image" value="<?php echo $fetch_medicine['image']; ?>">
                  <input type="hidden" name="remove" value="<?php echo $fetch_medicine['id']; ?>"> 
                  <input type="submit" class="btn" name="buy" value="Buy Now">
                  <input type="submit" class="btn" value="Remove">
               </div>
            <?php else: ?>
               <div class="btn-container">
                  
                  <input type="submit" class="btn disabled" value="Buy Now" name="buy" disabled>
                  <input type="submit" class="btn" value="Remove">
               </div>
            <?php endif; ?>
         </form>
      
      </div>
      <?php
         }
      } else {
       
         echo "<div class='empty'>No medicines available</div>";
      }
      ?>

   </div>
</body>
</html>
