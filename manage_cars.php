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


$sql = "SELECT * FROM cars";
$result = $conn->query($sql);
?>

<!DOCTYPE html?
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars</title>
    <link rel="stylesheet" href="style.css">
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


    <!-- Example form to add a car -->
    <form method="post" action="add_car.php" style="width:400px; margin:auto;">
    <div>
        <label>Car Model:</label>
        <input type="text" name="model" required>
    </div>
    <div>
        <label>Car Plate:</label>
        <input type="text" name="plate" required>
    </div>
    <div>
        <label>Year:</label>
        <input type="number" name="year" required>
    </div>
    <div>
        <button type="submit">Add Car</button>
    </div>
</form>


    <!-- Display cars from DB -->
    <h2 style="text-align:center;">Car List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Model</th>
            <th>Plate</th>
            <th>Year</th>
            <th>Status</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['model']."</td>
                        <td>".$row['plate']."</td>
                        <td>".$row['year']."</td>
                        <td>".$row['status']."</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No cars found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
