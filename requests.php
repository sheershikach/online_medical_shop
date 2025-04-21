<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('requests.jpeg'); 
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            background-color: rgba(255, 255, 255, 0.9); 
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            color: #007bff;
            padding: 10px;
            margin: 0;
            font-size: 28px;
            text-align: center;
            border-bottom: 2px solid #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-size: 18px;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .no-data {
            padding: 20px;
            text-align: center;
            font-weight:bold;
            font-size:18px;
            color:#007bff;
        }

        .home-btn {
            display: block;
            width: 120px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin: 20px auto 0;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .home-btn:hover {
            background-color: #0056b3;
        }

                td.message {
            max-width: 400px; 
            word-wrap: break-word; 
        }
    </style>
</head>
<body>

<div class="container">
    <?php
   
        $con = mysqli_connect("localhost", "root", "", "shop_db");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM request";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Submitted Data</h2>";
            echo "<table>";
            echo "<tr><th>Name</th><th>Email</th><th>Phone Number</th><th>Message</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['number'] . "</td>";
                echo "<td class='message'>" . $row['message'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='no-data'><p>No data found.</p></div>";
        }
        // Close the connection
        mysqli_close($con);
    ?>
    <a href='new adminhomepg.html' class='home-btn'>Home</a>
</div>

</body>
</html>
