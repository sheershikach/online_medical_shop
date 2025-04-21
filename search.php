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
        echo "<script>alert('Medicine already added to order page');</script>";
    } else {
        $insert_medicine = mysqli_query($conn, "INSERT INTO `cart`(id, name, price, image, available_quantity,mfg_date, exp_date, company_name) VALUES ('$m_id', '$m_name', '$m_price', '$m_image', '$m_available_quantity', '$m_mfg_date', '$m_exp_date', '$m_company_name')");
        if($insert_medicine){
            echo "<script>alert('Medicine added to order page successfully');window.location.href='orderpage.php';</script>";
        } else {
            echo "<script>alert('Failed to add medicine to order page');</script>";
        }
    }
}

if(isset($_POST['add_to_cart'])){
    $m_id = $_POST['m_id'];
    $m_name = $_POST['m_name'];
    $m_price = $_POST['m_price'];
    $available_quantity = $_POST['available_quantity'];
   
    $m_mfg_date = $_POST['m_mfg_date'];
    $m_exp_date = $_POST['m_exp_date'];
    $m_company_name = $_POST['m_company_name'];
    $m_image = $_POST['medicine_image'];
   
    $select_cart = mysqli_query($conn, "SELECT * FROM `cartt` WHERE name = '$m_name'");
    if(mysqli_num_rows($select_cart) > 0){
        echo "<script>alert('Medicine already added to order page');</script>";
    } else {
        $insert_medicine = mysqli_query($conn, "INSERT INTO `cartt`(id, name, price, image, available_quantity,mfg_date, exp_date, company_name) VALUES ('$m_id', '$m_name', '$m_price', '$m_image', '$available_quantity', '$m_mfg_date', '$m_exp_date', '$m_company_name')");
        if($insert_medicine){
            echo "<script>alert('Medicine added to cart successfully');window.location.href='medicines.php';</script>";
        } else {
            echo "<script>alert('Failed to add medicine to cart');</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search Results</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   
   <style>
   body {
      background: url('backgroundimagbe.jpg');
      margin: 0;
      padding: 0;
   }

   .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 20px;
   }

   .search-results {
      flex-basis: 100%;
   }

   .box-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
   }

   .box {
      width: 330px;
      margin: 20px;
      text-align: center;
      background-color: #fff;
      padding: 35px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border: 1px solid rgba(0, 0, 0, 0.5);
      font-size: 20px;
   }

   .box img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-radius: 10px; /* Added border-radius to images */
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

  .box h2 {
         font-size: 25px;
         margin-bottom: 5px;
      }

   .box p {
      margin: 5px 0;
      font-size: 13px;
      font-family: bold;
   }

  .price {
         font-weight: bold;
         
         font-size: 25px;
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
     
       margin-right:5px;
        padding: 5px 20px; 
         border-radius: 6px;
      margin-top: 10px;
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
      margin-left: 30px; 
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
      margin-left: 30px;
      display: flex;
      align-items: center;
   }

   .quantity-container label {
      font-size: 14px;
      font-weight: bold;
      color: #333;
      margin-right: 20px;
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

<div class="container">
   <section class="search-results">
      <h1 class="heading">Search Results</h1>
      <div class="box-container">
         <?php
         include 'config.php';
         if(isset($_GET['query'])){
            $query = $_GET['query'];

            $select_medicines = mysqli_query($conn, "SELECT * FROM `medicines` WHERE name LIKE '%$query%'");
            if(mysqli_num_rows($select_medicines) > 0){
               while($fetch_medicine = mysqli_fetch_assoc($select_medicines)){
         ?>
         <div class="box">
           <form action="" method="post">
            <img src="<?php echo 'uploaded_img/'.$fetch_medicine['image']; ?>" alt="Medicine Image">

            <h2><?php echo $fetch_medicine['name']; ?></h2>
         
           
            
            <p>Manufacture Date: <?php echo $fetch_medicine['mfg_date']; ?></p>
            <p>Expiry Date: <?php echo $fetch_medicine['exp_date']; ?></p>
            <p>Company Name: <?php echo $fetch_medicine['company_name']; ?></p>
 <?php if ($fetch_medicine['available_quantity'] > 0): ?>
               <p>Available Quantity: <?php echo $fetch_medicine['available_quantity']; ?></p>
               
            <div class="price">Price: &#8377;<?php echo $fetch_medicine['price']; ?>/-</div>



<div class="quantity-container">
                  <label for="quantity">Enter Quantity:</label>
                  <input type="number" class="quantity-input" name="m_available_quantity" min="1" max="<?php echo $fetch_medicine['available_quantity']; ?>" value="1">
               </div>
            <?php else: ?>
               <p class="no-stock">No Stock Available</p>
            <div class="price">Price: &#8377;<?php echo $fetch_medicine['price']; ?>/-</div>
            <?php endif; ?>
            <?php if ($fetch_medicine['available_quantity'] > 0): ?>
               <div class="btn-container">
                  <input type="hidden" name="m_id" value="<?php echo $fetch_medicine['id']; ?>">
                  <input type="hidden" name="m_name" value="<?php echo $fetch_medicine['name']; ?>">
                  <input type="hidden" name="m_price" value="<?php echo $fetch_medicine['price']; ?>">
                  <input type="hidden" name="available_quantity" value="<?php echo $fetch_medicine['available_quantity']; ?>">
                  <input type="hidden" name="m_mfg_date" value="<?php echo $fetch_medicine['mfg_date']; ?>">
                  <input type="hidden" name="m_exp_date" value="<?php echo $fetch_medicine['exp_date']; ?>">
                  <input type="hidden" name="m_company_name" value="<?php echo $fetch_medicine['company_name']; ?>">
                  <input type="hidden" name="medicine_image" value="<?php echo $fetch_medicine['image']; ?>">
                   <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
                  <input type="submit" class="btn" name="buy" value="Buy Now">
               </div>
            <?php else: ?>
               <div class="btn-container">
                  <input type="submit" class="btn disabled" value="Add to Cart" name="add_to_cart" disabled>
                  <input type="submit" class="btn disabled" value="Buy Now" name="buy" disabled>
               </div>
            <?php endif; ?>
         </form>

         </div>
         <?php 
               }
            } else {
               echo "No results found.";
            }
         }
         ?>
      </div>
   </section>
</div>

</body>
</html>
