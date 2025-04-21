<html>
<head>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<a link="stylesheet" href="style.css">
</head>
<body>



<header class="header">

   <div class="flex">

      <a href="#" class="logo">mediplus</a>

      <nav class="navbar">
       
          
         <a href="customer_home.html">Home</a>
         <a href="medicines.php">Medicines</a>
        
          </form>
       
      </nav>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

     

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>

</body>
</html>