<?php
@include 'config.php';

if(isset($_POST['order_btn'])){
   
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
   $medicine_name = array(); // Initialize an empty array to hold medicine names
   
   if(mysqli_num_rows($cart_query) > 0){
      while($medicine_item = mysqli_fetch_assoc($cart_query)){

         if($medicine_item['available_quantity'] > 0) {
            $medicine_name[] = $medicine_item['name'] .' ('. $medicine_item['available_quantity'] .') '; // Add medicine name to array
            $medicine_price = $medicine_item['price'] * $medicine_item['available_quantity']; // Remove number_format here
            $price_total += $medicine_price;

         
            $total_product += $medicine_item['available_quantity'];

            mysqli_query($conn, "UPDATE `cart` SET available_quantity = available_quantity - {$medicine_item['available_quantity']} WHERE id = {$medicine_item['id']}");
            
               mysqli_query($conn, "DELETE FROM `cart` WHERE id = '{$medicine_item['id']}'");

            mysqli_query($conn, "UPDATE `medicines` SET available_quantity = available_quantity - {$medicine_item['available_quantity']} WHERE name = '{$medicine_item['name']}'");
         }
         else {
            
         }
      }
   }

   $total_medicine = implode(', ',$medicine_name);

$currentDate = date('Y-m-d');
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(name, number, email, method, flat, street, city, state, country, pin_code, dob,alnumber,total_medicines, total_price) VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$dob','$alnumber','$total_medicine','$price_total')") or die('query failed');

   if($detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>Total Products :".$total_product."</span>
            <span class='total'> total : &#8377;".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email.  "</span> </p>
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
   <title>Checkout</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .error-msg {
         color: #ff0000;
         font-size: 14px;
         margin-top: 5px;
      }
   </style>
</head>
<body>

<?php include 'header2.php'; ?>

<div class="container">
   <section class="checkout-form">
      <h1 class="heading">Complete Your Order</h1>
      <form action="" method="post" onsubmit="return validateForm()" name="checkoutForm">
    
         <div class="flex">
            <div class="inputBox">
               <span>Your Name</span>
               <input type="text" placeholder="Enter your name" name="name" required>
               <p id="nameError" class="error-msg"></p>
            </div>
            <div class="inputBox">
               <span>Your Number</span>
               <input type="text" placeholder="Enter your number" name="number" required>
               <p id="numberError" class="error-msg"></p>
            </div>
            <div class="inputBox">
               <span>Alternative Number</span>
               <input type="text" placeholder="Enter alternative number" name="alnumber">
               <p id="alnumberError" class="error-msg"></p>
            </div>
            <div class="inputBox">
               <span>Your Email</span>
               <input type="email" placeholder="Enter your email" name="email" required>
            </div>
            <div class="inputBox">
               <span>Payment Method</span>
               <select name="method">
                  <option value="cash on delivery" readonly>Cash on Delivery</option>
               </select>
            </div>
            <div class="inputBox">
               <span>Address Line 1</span>
               <input type="text" placeholder="e.g. flat no." name="flat" required>
            </div>
            <div class="inputBox">
               <span>Address Line 2</span>
               <input type="text" placeholder="e.g. street name" name="street" required>
            </div>
            <div class="inputBox">
               <span>City</span>
               <input type="text" placeholder="e.g. Mumbai" name="city" required>
               <p id="cityError" class="error-msg"></p>
            </div>
            <div class="inputBox">
               <span>State</span>
               <input type="text" placeholder="e.g. Maharashtra" name="state" required>
               <p id="stateError" class="error-msg"></p>
            </div>
            <div class="inputBox">
               <span>Country</span>
               <input type="text" value="India" name="country"  required readonly>
               <p id="countryError" class="error-msg"></p>
            </div>
            <div class="inputBox">
               <span>Pin Code</span>
               <input type="text" placeholder="e.g. 123456" name="pin_code" required>
               <p id="pinCodeError" class="error-msg"></p>
            </div>
             <div class="inputBox">
               <span>Date</span>
               <input type="date" placeholder="DATE" name="dob" value="<?php echo date('Y-m-d'); ?>" required readonly>
            </div>
         </div>
         <input type="submit" value="Order Now" name="order_btn" class="btn">
      </form>
   </section>
</div>

<!-- Custom JS file link -->
<script src="js/script.js"></script>

<script>
   function validateForm() {
      var name = document.forms["checkoutForm"]["name"].value;
      var number = document.forms["checkoutForm"]["number"].value;
      var alnumber = document.forms["checkoutForm"]["alnumber"].value;
      var pin_code = document.forms["checkoutForm"]["pin_code"].value;
      var city = document.forms["checkoutForm"]["city"].value;
      var state = document.forms["checkoutForm"]["state"].value;
      var country = document.forms["checkoutForm"]["country"].value;

      var namePattern = /^[a-zA-Z\s]+$/;
      var numberPattern = /^[0-9]{10}$/; // 10 digits
      var pinCodePattern = /^[0-9]{6}$/; // 6 digits
      var cityPattern = /^[a-zA-Z\s]+$/;
      var statePattern = /^[a-zA-Z\s]+$/;
      var countryPattern = /^[a-zA-Z\s]+$/;

      document.getElementById("nameError").innerHTML = "";
      document.getElementById("numberError").innerHTML = "";
      document.getElementById("alnumberError").innerHTML = "";
      document.getElementById("pinCodeError").innerHTML = "";
      document.getElementById("cityError").innerHTML = "";
      document.getElementById("stateError").innerHTML = "";
      document.getElementById("countryError").innerHTML = "";
      var isValid = true;

      if (!namePattern.test(name)) {
         document.getElementById("nameError").innerHTML = "Name should contain only alphabetic characters.";
         isValid = false;
      }

      if (!numberPattern.test(number)) {
         document.getElementById("numberError").innerHTML = "Phone number should be 10 digits.";
         isValid = false;
      }

       if (alnumber.trim() !== "" && !numberPattern.test(alnumber)) {
         document.getElementById("alnumberError").innerHTML = "Alternative number should be 10 digits.";
         isValid = false;
      }

      if (!pinCodePattern.test(pin_code)) {
         document.getElementById("pinCodeError").innerHTML = "Pin code should be 6 digits.";
         isValid = false;
      }

      if (!cityPattern.test(city)) {
         document.getElementById("cityError").innerHTML = "City should contain only alphabetic characters.";
         isValid = false;
      }

      if (!statePattern.test(state)) {
         document.getElementById("stateError").innerHTML = "State should contain only alphabetic characters.";
         isValid = false;
      }

      if (!countryPattern.test(country)) {
         document.getElementById("countryError").innerHTML = "Country should contain only alphabetic characters.";
         isValid = false;
      }

      if (isValid) {
         setTimeout(function() {
            document.getElementById("nameError").innerHTML = "";
            document.getElementById("numberError").innerHTML = "";
            document.getElementById("alnumberError").innerHTML = "";
            document.getElementById("pinCodeError").innerHTML = "";
            document.getElementById("cityError").innerHTML = "";
            document.getElementById("stateError").innerHTML = "";
            document.getElementById("countryError").innerHTML = "";
         }, 3000); 
      }

      return isValid;
   }
</script>

</body>
</html>
