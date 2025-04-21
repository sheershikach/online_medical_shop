<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : date("Y-m-d");
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : date("Y-m-d");

$start_end_sales_result = false; // Initialize the variable

if(isset($_POST['apply_filter'])) {
    $start_end_sales_sql = "SELECT * FROM `order` WHERE DATE(dob) BETWEEN '$start_date' AND '$end_date' AND Status = 'delivered'";
    $start_end_sales_result = $conn->query($start_end_sales_sql);
    if ($start_end_sales_result === false) {
        die("Error in start-end sales query: " . $conn->error);
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Medical Store Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('report.jpeg'); 
            background-size: cover;
            background-position: center;
        }
        h2 {
            text-align: center;
            color: #007bff;
            margin-top: 20px;
        }
        .report-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .sales-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .sales-table th, .sales-table td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        .sales-table th {
            background-color: #007bff;
            color: #fff;
            font-weight: normal;
            text-transform: uppercase;
        }
        .total-section {
            margin-top: 30px;
            text-align: center;
        }
        .date-input {
            text-align: center;
            margin-bottom: 10px;
        }
        .date-input input[type="date"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .date-input button {
            padding: 8px 20px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .reset-button {
            margin-left: 10px; 
        }
        .back-button {
            margin-top: 20px;
            text-align: center;
        }
        .back-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
       
        .filter-section {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .filter-section label {
            font-size: 18px;
            font-weight: bold;
        }
        .filter-section input[type="date"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .filter-section button {
            padding: 8px 20px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
        .no-sales-msg {
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            font-size:20px;
            font-weight:bold;
        }
    </style>

</head>
<body>
    <div class="report-container">
        <h2>Daily Sales Report</h2>
        <div class="total-section">
            <form id="filter-form" method="post" class="filter-section">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo $start_date; ?>">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo $end_date; ?>">
                <button type="submit" name="apply_filter">Apply Filter</button>
                <button type="button" class="clear-button" onclick="clearResults()">Clear Results</button>
                
            </form>
        </div>

        <div class="total-section">
            <?php if ($start_end_sales_result && $start_end_sales_result->num_rows > 0) { ?>
                <h2>Sales Between <?php echo $start_date; ?> and <?php echo $end_date; ?></h2>
                <table class="sales-table">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>Total Medicines</th>
                        <th>Order Date</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    while ($row = $start_end_sales_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['number']."</td>";
                        echo "<td>" . $row['total_medicines'] . "</td>";
                        echo "<td>" . $row['dob'] . "</td>";
                        echo "<td>" . $row['total_price']."</td>";
                        echo "<td>" . $row['Status'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            <?php } elseif ($start_end_sales_result && $start_end_sales_result->num_rows === 0) { ?>
                <div class="no-sales-msg">No sales found between <?php echo $start_date; ?> and <?php echo $end_date; ?></div>
            <?php } ?>
        </div>

        <div class="back-button">
            <a href="new adminhomepg.html">Back</a>
        </div>
    </div>
<script>
  function clearResults() {
        document.getElementById("filter-form").reset();
    
        var table = document.querySelector("table");
        if (table) {
            table.remove();
        }
    }
</script>
</body>

</html>
