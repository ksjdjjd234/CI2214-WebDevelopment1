<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: admin.php?error=2");
    exit();
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch bookings with JOINs
$sql = "SELECT b.id, u.name AS customer, c.model AS car, b.start_date, b.end_date, b.status
        FROM bookings b
        JOIN users u ON b.user_id = u.id
        JOIN cars c ON b.car_id = c.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html?
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
    <style>
        .login-box {
            background-color: #F8F9F9;
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 400px;
            margin: 20px auto;
            border-radius: 6px;
        }
        .login-box div {
            margin-bottom: 15px;
        }
        .login-box label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .login-box input{
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .login-box button {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }
        .login-box button:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>
    <header>
        <h1>Car Rental Admin Dashboard</h1>
    </header>

    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="manage_cars.php">Manage Cars</a>
        <a href="manage_bookings.php">Manage Bookings</a>
        <a href="manage_users.php">Manage Users</a>
    </nav>


    <h2 style="text-align:center;">Bookings List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Car</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['customer']."</td>
                        <td>".$row['car']."</td>
                        <td>".$row['start_date']."</td>
                        <td>".$row['end_date']."</td>
                        <td>".$row['status']."</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No bookings found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
