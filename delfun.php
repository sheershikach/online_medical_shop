<?php

@include 'config.php';
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `medicines` WHERE id = $delete_id ") or die('query failed');
 $delete_query = mysqli_query($conn, "DELETE FROM `cart` WHERE id = $delete_id ") or die('query failed');

};
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Panel</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      body {
         background: url('update.jpeg');
         margin: 0;
         padding: 0;
      }

      .container {
         position: absolute;
         top: 6%;
         right: 5%;
      }

      .table-container {
         border-radius: 20px;
         overflow: hidden;
      }

      table {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 20px;
         background-color: #fff;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         overflow: hidden;
      }

      th, td {
         padding: 10px;
         text-align: left;
         border-bottom: 1px solid #ddd;
      }

      th {
         background-color: #f2f2f2;
         color: #333;
      }

      tr:hover {
         background-color: #f5f5f5;
      }

      .delete-btn {
         padding: 8px 15px;
         background-color: #ff4d4d;
         color: #fff;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s ease;
      }

      .delete-btn:hover {
         background-color: #ff3333;
      }

      .back-button {
         display: block;
         margin: 20px auto;
         text-align: center;
      }

      .back-button a {
         padding: 15px 30px;
         background-color: #333;
         color: white;
         text-decoration: none;
         border-radius: 10px;
         font-size: 13px;
         font-weight: bold;
         transition: background-color 0.3s ease;
      }

      .back-button a:hover {
         background-color: #555;
      }
   </style>
</head>
<body>

<div class="container">
   <section class="display-medicine-table">
      <div class="table-container">
         <table>
            <thead>
               <tr>
                  <th>Medicine Image</th>
                  <th>Medicine Id</th>
                  <th>Medicine Name</th>
                  <th>Medicine Price</th>
                  <th>Available Quantity</th>
                  
                  <th>Medicine Expiry Date</th>
                  <th>Company Name</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $select_medicines = mysqli_query($conn, "SELECT * FROM `medicines`");
                  if(mysqli_num_rows($select_medicines) > 0){
                     while($row = mysqli_fetch_assoc($select_medicines)){
               ?>
                     <tr>
                        <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td>&#8377;<?php echo $row['price']; ?>/-</td>
                        <td><?php echo $row['available_quantity']; ?></td>
                       
                        <td><?php echo $row['exp_date']; ?></td>
                        <td><?php echo $row['company_name']; ?></td>
                        <td>
                           <a href="delfun.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this medicine?');"> <i class="fas fa-trash"></i> Delete </a>
                        </td>
                     </tr>
               <?php
                     };    
                  } else {
                     echo "<tr><td colspan='9'>No medicine added</td></tr>";
                  };
               ?>
            </tbody>
         </table>
      </div>
   </section>
   <div class="back-button">
      <a href="new adminhomepg.html">Back</a>
   </div>
</div>

</body>
</html>
