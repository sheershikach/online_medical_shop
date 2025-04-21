<?php
@include 'config.php';

if(isset($_POST['order_btn'])){
   // Initialize total_product variable
   $total_product = 0;

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];
   $dob = $_POST['dob'];
   $alnumber = $_POST['alnumber'];
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;

   if(mysqli_num_rows($cart_query) > 0){
      while($medicine_item = mysqli_fetch_assoc($cart_query)){
         $medicine_name[] = $medicine_item['name'] .' ('. $medicine_item['available_quantity'] .') ';
         $medicine_price = number_format($medicine_item['price'] * $medicine_item['available_quantity']);
         $price_total += $medicine_price;

         // Increment total_product for each cart item
         $total_product += $medicine_item['available_quantity'];

         // Decrease the available quantity of the medicine in the cart
         if($medicine_item['available_quantity'] > 0) {
            mysqli_query($conn, "UPDATE `cart` SET available_quantity = available_quantity - {$medicine_item['available_quantity']} WHERE id = {$medicine_item['id']}");
            
            // Update the available quantity of the medicine in the 'medicines' table
            mysqli_query($conn, "UPDATE `medicines` SET available_quantity = available_quantity - {$medicine_item['available_quantity']} WHERE name = '{$medicine_item['name']}'");
         }
      }
   }

   $total_medicine = implode(', ',$medicine_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(name, number, email, method, flat, street, city, state, country, pin_code, dob,alnumber,total_medicines, total_price) VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$dob','$alnumber','$total_medicine','$price_total')") or die('query failed');

   if($detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>Total Products: ".$total_product."</span> <!-- Use total_product here -->
            <span class='total'> total : &#8377;".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
            <p> your payment mode : <span>".$method."</span> </p>
           
            <p>(*pay when medicine arrives*)</p>
         </div>
            <a href='medicines.php' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header2.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['price'] * $fetch_cart['available_quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['available_quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : &#8377;<?= $grand_total; ?>/- </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>your number</span>
            <input type="number" placeholder="enter your number" name="number" required>
         </div>
         
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
               <option value="cash on delivery" readonly>cash on delivery</option>
               
            </select>
         </div>
         <div class="inputBox">
            <span>address line 1</span>
            <input type="text" placeholder="e.g. flat no." name="flat" required>
         </div>
         <div class="inputBox">
            <span>address line 2</span>
            <input type="text" placeholder="e.g. street name" name="street" required>
         </div>
         <div class="inputBox">
            <span>city</span>
            <input type="text" placeholder="e.g. mumbai" name="city" required>
         </div>
         <div class="inputBox">
            <span>state</span>
            <input type="text" placeholder="e.g. maharashtra" name="state" required>
         </div>
         <div class="inputBox">
            <span>Country</span>
            <input type="text" placeholder="e.g. india" name="country"  required>

         </div>
         <div class="inputBox">
            <span>pin code</span>
            <input type="text" placeholder="e.g. 123456" name="pin_code" required>
         </div>
 <div class="inputBox">
            <span>Date</span>
            <input type="date" placeholder="DATE" name="dob" required>
         </div>
 <div class="inputBox">
            <span>Alternative Number</span>
            <input type="number" placeholder="Enter Mobile number" name="alnumber" required>
         </div>
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>