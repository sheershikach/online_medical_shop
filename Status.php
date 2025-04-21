<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Store Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('Status.jpeg');
            background-size: cover;
            background-position: center;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: black; 
        }
        table {
            width: 95%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.8); 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        select {
            padding: 8px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            margin-right: 5px;
        }
        button {
            padding: 8px 15px;       
            border: none;
            border-radius: 4px;
            background-color:  #4CAF50; 
            color: white;
            cursor: pointer;
            margin-right: 5px;
        }
        button:hover {
            background-color: green; /* Updated color to green */
        }
        .action-container {
            display: flex; 
            align-items: center;         
        }
        .action-container > * {
            margin-right: 10px;        
        }
        .back-button {
            display: block;
            margin: 20px auto;
            text-align: center;
        }
        .back-button a {
            padding: 10px 20px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .back-button a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Medical Store Orders</h1>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Mobile Number</th>
            <th>Medicine Details</th>
            <th>Total Price</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Address</th> 
            <th>Action</th>
        </tr>
        <?php
        $db_connection = mysqli_connect("localhost", "root", "", "shop_db");
        
        if (!$db_connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $query = "SELECT * FROM `order`";
        $result = mysqli_query($db_connection, $query);
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['number'] . "</td>"; 
            echo "<td>" . $row['total_medicines'] . "</td>";
            echo "<td>" . $row['total_price'] . "</td>";
            echo "<td>" . $row['dob'] . "</td>";
            echo "<td>" . $row['Status'] . "</td>";
            echo "<td>" . $row['flat'] . "</td>"; 
            echo "<td class='action-container'>";
          
            echo "<form action='update_status.php' method='post'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<select name='new_status'>";
            echo "<option value='New Order'>New Order</option>";
            echo "<option value='Processing'>Processing</option>";
            echo "<option value='Delivered'>Delivered</option>";
            echo "</select>";
            echo "<pre>";
            echo "<button type='submit'>Update Status</button>";
            echo "</form>";
            
            echo "</td>";
            echo "</tr>";
        }
        
        mysqli_close($db_connection);
        ?>
    </table>
    <div class="back-button">
        <a href="new adminhomepg.html">Back</a>
    </div>
</body>
</html>
