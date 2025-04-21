<?php

@include 'config.php';

if(isset($_POST['add_medicine'])){
   $m_id =  $_POST['m_id'];
   $m_name = $_POST['m_name'];
   $m_price = $_POST['m_price'];
   $m_available_quantity = $_POST['m_available_quantity'];
   $m_mfg_date = $_POST['m_mfg_date'];
   $m_exp_date = $_POST['m_exp_date'];
   $m_company_name = $_POST['m_company_name'];
   $m_image = $_FILES['m_image']['name'];
   $m_image_tmp_name = $_FILES['m_image']['tmp_name'];
   $m_image_folder = 'uploaded_img/'.$m_image;



 
    $check_query = mysqli_query($conn, "SELECT * FROM `medicines` WHERE name = '$m_name'");
    if(mysqli_num_rows($check_query) > 0){

        echo "<script>alert('Medicine with this name already exists.');</script>";
    } else {
   
    
        if(move_uploaded_file($m_image_tmp_name, $m_image_folder)){
            $insert_query = mysqli_query($conn, "INSERT INTO `medicines` (id, name, price, available_quantity, mfg_date, exp_date, company_name, image) VALUES ('$m_id', '$m_name', '$m_price', '$m_available_quantity', '$m_mfg_date', '$m_exp_date', '$m_company_name','$m_image')");

   if($insert_query){
                echo "<script>alert('New medicine added successfully');</script>";
            } else {
                echo "<script>alert('Failed to add the new medicine');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload the image');</script>";
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
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      body {
         background: url('update.jpeg');
         margin: 0;
         padding: 0;
      }

      .box[type="date"] {
         height: 40px;
         padding: 10px;
         font-size: 16px;
         border-radius: 5px;
         border: 1px solid #ccc;
      }

      label[for="m_mfg_date"],
      label[for="m_exp_date"] {
         font-size: 16px;
         margin-bottom: 5px;
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
         font-size:13px;
         font-weight:bold;
         transition: background-color 0.3s ease;
      }

      .back-button a:hover {
         background-color: #555;
      }

      .error-msg {
         color: red;
         font-size: 14px;
      }
   </style>

<script>
    function validateForm() {
       
        var companyName = document.forms["addMedicineForm"]["m_company_name"].value;
        var isValid = true;
        if (!/^[a-zA-Z\s]+$/.test(companyName)) {
            document.getElementById("companyNameError").innerHTML = "Company name should contain only alphabetic characters.";
            isValid = false;
        } else {
            document.getElementById("companyNameError").innerHTML = ""; 
        }

        return isValid;
    }
</script>

</head>
<body>

<div class="container">
   <section>
      <form name="addMedicineForm" action="" method="post" class="add-medicine-form" enctype="multipart/form-data" onsubmit="return validateForm()">
         <h3>add a new medicine</h3>
         <input type="number" name="m_id" min="1" placeholder="enter medicine id" class="box" required>
         <input type="text" name="m_name" placeholder="enter the medicine name" class="box" required>
         <span id="nameError" class="error-msg"></span>
         <input type="number" name="m_price" min="1" placeholder="enter the medicine price" class="box" required>
         <input type="number" name="m_available_quantity" min="1" placeholder="Enter the medicine quantity" class="box" required>
         <p><label for="m_mfg_date">Manufacture Date:</label></p> <!-- Added label -->
         <input type="date" name="m_mfg_date" class="box" required>
         <p><label for="m_exp_date">Expiry Date:</label></p> <!-- Added label -->
         <input type="date" name="m_exp_date" placeholder="Enter the medicine expiry date" class="box" required>
         <input type="text" name="m_company_name" placeholder="Enter the medicine company name" class="box" required>
         <span id="companyNameError" class="error-msg"></span>
         <input type="file" name="m_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
         <input type="submit" value="add the medicine" name="add_medicine" class="btn">
      </form>
   </section>

   <div class="back-button">
      <a href="new adminhomepg.html">Back</a>
   </div>
</div>

</body>
</html>
