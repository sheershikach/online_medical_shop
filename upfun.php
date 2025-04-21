<?php

@include 'config.php';
if(isset($_POST['update_medicine'])){
   $update_m_id = $_POST['update_m_id'];
   $update_m_name = $_POST['update_m_name'];
   $update_m_price = $_POST['update_m_price'];
   $update_m_quantity = $_POST['update_m_available_quantity'];
   $update_m_mfg_date = $_POST['update_m_mfg_date'];
   $update_m_exp_date = $_POST['update_m_exp_date'];
   $update_m_company_name = $_POST['update_m_company_name'];
        $update_query = mysqli_query($conn, "UPDATE `medicines` SET name = '$update_m_name', price = '$update_m_price', available_quantity = '$update_m_quantity', mfg_date = '$update_m_mfg_date', exp_date = '$update_m_exp_date', company_name = '$update_m_company_name' WHERE id = '$update_m_id'");
     

        if($update_query){
            echo "<script>alert('Medicine updated successfully');window.location.href='upfun.php';</script>";
            
        } else {
            echo "<script>alert('Medicine could not be updated');</script>";
        }   
}
?>
<html>
<head>
   <title>Admin Panel</title>

   <!-- Font Awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link  -->
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
    right: 8%;
  
}


      .table-container {
         border-radius: 20px; 
         overflow: hidden; 
      }

      table {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 10px;
         background-color:white;
         border-radius: 20px; 
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

      .edit-form-container {
         display: none;
         flex-direction: column;
         background-color: #fff;
         padding: 15px;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .edit-form-container form {
         border: 2px solid #333; /* Adding dark border to the form */
         padding: 20px;
         border-radius: 30px;
          
      }

      .edit-form-container .box {
         margin-bottom: 10px;
         padding: 8px;
         width: calc(100% - 16px);
         border: 1px solid #ccc;
         border-radius: 3px;
         font-size: 16px;
      }

      .edit-form-container .btn {
         padding: 10px 20px;
         background-color: #007bff;
         color: #fff;
         border: none;
         border-radius: 3px;
         cursor: pointer;
         transition: background-color 0.3s ease;
      }


      .edit-form-container .btn:hover {
         background-color: #0056b3;
      }

 .edit-form-container .option-btn {
         padding: 10px 20px;
         background-color: orange;
         color: #fff;
         border: none;
         border-radius: 3px;
         cursor: pointer;
         transition: background-color 0.3s ease;
      }


      .edit-form-container .option-btn:hover {
         background-color: #000;
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
         font-size:13px;
         font-weight:bold;
         transition: background-color 0.3s ease;
      }

      .back-button a:hover {
         background-color: #555;
      }

   
form p {
   margin-bottom: 8px;
   font-size: 15px;
   color: #333;
}

form label {
   display: block;
   font-weight: bold;
}


.error-msg {
   color: red;
   font-size: 14px;
   margin-top: 5px;
}


.scrollable-form {
   max-height: 700px; 
   overflow-y: auto;
}

 
  


   </style>

 <script>
    function validateForm() {

        var companyName = document.forms["updateMedicineForm"]["update_m_company_name"].value;
        var isValid = true;

        

        if (!/^[a-zA-Z\s]+$/.test(companyName)) {
            document.getElementById("companyNameError").innerHTML = "Company name should contain only alphabetic characters.";
            isValid = false;
        } else {
            document.getElementById("companyNameError").innerHTML = ""; // Clear error message
        }

        return isValid;
    }
</script>

</head>
<body>

<div class="container">
   <section class="display-medicine-table">

      <table>
         <thead>
            <tr>
               <th>Medicine Image</th>
               <th>Medicine Id</th>
               <th>Medicine Name</th>
               <th>Medicine Price</th>
               <th>Available Quantity</th>
               <th>Medicine Manufacture Date</th>
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
                  <td><?php echo $row['mfg_date']; ?></td>
                  <td><?php echo $row['exp_date']; ?></td>
                  <td><?php echo $row['company_name']; ?></td>
                  <td>
                     <a href="upfun.php?edit=<?php echo $row['id']; ?>" class="delete-btn"> <i class="fas fa-edit"></i> Update </a>
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
   </section>
   <section class="edit-form-container">

      <?php

      if(isset($_GET['edit'])){
         $edit_id = $_GET['edit'];
         $edit_query = mysqli_query($conn, "SELECT * FROM `medicines` WHERE id = $edit_id");
         if(mysqli_num_rows($edit_query) > 0){
            while($fetch_edit = mysqli_fetch_assoc($edit_query)){
      ?>

       <form name="updateMedicineForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" class="scrollable-form">
   <input type="hidden" name="update_m_id" value="<?php echo $fetch_edit['id']; ?>">
   <p><label for="update_m_name">Medicine Name:</label></p>
   <input type="text" id="update_m_name" class="box" required name="update_m_name" value="<?php echo $fetch_edit['name']; ?>">
   <span id="nameError" class="error-msg"></span>
   
   <p><label for="update_m_price">Price:</label></p>
   <input type="number" id="update_m_price" min="1" class="box" required name="update_m_price" value="<?php echo $fetch_edit['price']; ?>">
   
   <p><label for="update_m_available_quantity">Available Quantity:</label></p>
   <input type="number" id="update_m_available_quantity" min="1" class="box" required name="update_m_available_quantity" value="<?php echo $fetch_edit['available_quantity']; ?>">
   
   <p><label for="update_m_mfg_date">Manufacture Date:</label></p>
   <input type="date" id="update_m_mfg_date" class="box" required name="update_m_mfg_date" value="<?php echo $fetch_edit['mfg_date']; ?>">
   
   <p><label for="update_m_exp_date">Expiry Date:</label></p>
   <input type="date" id="update_m_exp_date" class="box" required name="update_m_exp_date" value="<?php echo $fetch_edit['exp_date']; ?>">
   
   <p><label for="update_m_company_name">Company Name:</label></p>
   <input type="text" id="update_m_company_name" class="box" required name="update_m_company_name" value="<?php echo $fetch_edit['company_name']; ?>" >
   <span id="companyNameError" class="error-msg"></span>
   
   
   
   <input type="submit" value="Update the Medicine" name="update_medicine" class="btn">
   <a href="upfun.php"  class="option-btn">Cancel</a>
   <br><br><br>
</form>


      <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
      ?>
  </section>
   <div class="back-button">
      <a href="new adminhomepg.html">Back</a>
   </div>
</div>

</body>
</html>
