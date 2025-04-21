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
 body {
      background-color: #f0f0f0;
      background-size: cover; 
      background-repeat: no-repeat; 
      background: url('update.jpeg');
      margin: 0;
      padding: 0;
      font-family: "Arial", sans-serif;
      color: #333;
    }
     
     
      .box {
         border: 1px solid #ccc;
         border-radius: 5px;
         padding: 10px;
         margin-bottom: 20px;
         background-color: #fff;
         box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
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
    margin-top: 10px; \\
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
.back-button {
         display: block;
         margin: 20px auto;
         text-align: center;
         font-size:12px;
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


<?php include 'config.php'; ?>
<div class="container">

<section class="medicines">

   <h1 class="heading">Latest Medicines</h1>

   <div class="box-container">

      <?php
      
      $select_medicines = mysqli_query($conn, "SELECT * FROM `medicines`");
      if(mysqli_num_rows($select_medicines) > 0){
         while($fetch_medicine = mysqli_fetch_assoc($select_medicines)){
      ?>

      <div class="box">
         <form action="" method="post">
            <img src="<?php echo 'uploaded_img/'.$fetch_medicine['image']; ?>" alt="Medicine Image">

            <h3><?php echo $fetch_medicine['name']; ?></h3>
         
            <?php if ($fetch_medicine['available_quantity'] > 0): ?>
               <p>Available Quantity: <?php echo $fetch_medicine['available_quantity']; ?></p>
            <?php else: ?>
               <p class="no-stock">No Stock Available</p>
            <?php endif; ?>
            
            <p>Manufacture Date: <?php echo $fetch_medicine['mfg_date']; ?></p>
            <p>Expiry Date: <?php echo $fetch_medicine['exp_date']; ?></p>
            <p>Company Name: <?php echo $fetch_medicine['company_name']; ?></p>
            <div class="price">Price: &#8377;<?php echo $fetch_medicine['price']; ?>/-</div>
         </form>
      </div>

      <?php
         }
      } else {
         echo "<div class='empty'>No medicines available</div>";
      }
      ?>

   </div>
</section>
 <div class="back-button">
            <a href="new adminhomepg.html">Back</a>
        </div>

</div>
</body>
</html>
