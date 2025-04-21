<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Order Tracking Details</title>
    <style>
        body {
            background: url('sample.jpeg') no-repeat center center fixed;
            background-size: cover;
            margin-top: 30px;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #fff;
            text-align: center;
            margin-top: 50px;
            font-size: 36px;
            font-weight: bold;
            text-transform: uppercase;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
        }

        input[type="text"] {
            padding: 12px;
            border: 2px solid #007bff;
            width: 250px;
            border-radius: 20px;
            outline: none;
            transition: border-color 0.3s ease;
            font-size: 16px;
            color: #333;
        }

        input[type="text"]:focus {
            border-color: #0056b3;
        }

        input[type="submit"], .clear-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            transition: background-color 0.3s ease;
            font-size: 16px;
            margin-left: 10px;
            text-transform: uppercase;
        }

        input[type="submit"]:hover, .clear-button:hover {
            background-color: #0056b3;
        }

        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            background: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            height:30px;
        }

        th {
            background-color: #007bff;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        td {
            background-color: #f9f9f9;
            color: #333;
            font-size: 14px;
        }

        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        tr:hover td {
            background-color: #ddd;
        }

        .back-button, .clear-button {
            text-align: center;
            margin-top: 25px;
        }

        .back-button a, .clear-button {
            padding: 10px 20px;
            background-color: white;
            color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 16px;
            text-transform: uppercase;
        }

        .back-button a:hover, .clear-button:hover {
            background-color: #007bff;
            color: white;
        }
        
        .no-results {
            color: white;
            text-align: center;
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }

        footer {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            text-align: center;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            font-size: 14px;
            color: #333;
        }

        footer i {
            margin: 0 10px;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <h2>Orders Information</h2>
    <form method="post" action="" id="searchForm" onsubmit="return validateForm()">
        <input type="text" name="number" id="numberInput" placeholder="Enter phone number" required>
        <button type="submit" name="search" class="clear-button"><i class="fas fa-search"></i> Search</button>
        <button type="button" class="clear-button" onclick="clearResults()">Clear</button>
    </form>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    function searchCustomer($number, $conn) {
        $sql = "SELECT * FROM `order` WHERE number = '$number' OR alnumber='$number' and Status = 'delivered'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Order ID</th><th>Customer Name</th><th>Medicine Details</th><th>Total Price</th><th>Status</th><th>Mobile Number</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["total_medicines"] . "</td>";
                echo "<td>" . $row["total_price"] . "</td>";
                echo "<td>" . $row["Status"] . "</td>";
                echo "<td>" . $row["number"] . "</td>";
                echo "</tr>";
}   echo "</table>";
        } else {
            echo "<p class='no-results'>No results found</p>";
        }
    }

    if(isset($_POST['search'])) {
        $number = $_POST['number'];
        searchCustomer($number, $conn);
    }

    $conn->close(); 
    ?>
    <div class="back-button">
        <a href="customer_home.html">Back</a>
    </div>
   
<footer>
    <a href="https://www.facebook.com/mediplusindialimited/about" class="footer-icons"><i class="fab fa-facebook"style="color: #0752d5;"></i></a>
    <a href="https://www.instagram.com/medpluspharmacyng?igsh=MTJzM3gzbTlsaG5vbQ==" class="footer-icons"><i class="fab fa-instagram"style="color: #e50ba0;"></i></a>
    <a href="https://twitter.com/MedPlusIndia" class="footer-icons"><i class="fab fa-twitter"style="color: #061dcb;"></i></a>
</footer>

<script>
    function clearResults() {
        document.getElementById("searchForm").reset();
    
        var table = document.querySelector("table");
        if (table) {
            table.remove();
        }
    }

    function validateForm() {
        var numberInput = document.getElementById("numberInput");
        var number = numberInput.value.trim();

        // Check if the number has exactly 10 digits
        if (number.length !== 10 || isNaN(number)) {
            alert("Please enter a valid 10-digit phone number.");
            numberInput.focus();
            return false;
        }

        return true;
    }
</script>
</body>
</html>
