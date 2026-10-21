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

// Handle customer deletion by email
if (isset($_GET['delete_email'])) {
    $email = $conn->real_escape_string($_GET['delete_email']);
    // Delete all bookings associated with this customer email
    $conn->query("DELETE FROM bookings WHERE email = '$email'");
    header("Location: manage_users.php");
    exit();
}

// Fetch unique customers dynamically from bookings
$sql = "SELECT MIN(id) AS id, fullname AS name, email 
        FROM bookings 
        WHERE fullname != '' AND fullname IS NOT NULL 
        GROUP BY email, fullname";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #F8F9F9;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #2980b9;
            color: white;
        }
        .btn-delete { 
            background-color: #c0392b; 
            color: white; 
            padding: 5px 10px; 
            text-decoration: none; 
            border-radius: 3px; 
            font-size: 0.9em; 
        }
        .btn-delete:hover { opacity: 0.8; }
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
        <a href="manage_users.php" class="active">Manage Users</a>
    </nav>

    <h2 style="text-align:center;">Customers List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".htmlspecialchars($row['name'])."</td>
                        <td>".htmlspecialchars($row['email'])."</td>
                        <td>
                            <a href='manage_users.php?delete_email=".urlencode($row['email'])."' class='btn-delete' onclick='return confirm(\"Are you sure you want to delete this customer and all their bookings?\");'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No customers found</td></tr>";
        }
        ?>
    </table>
</body>
</html>