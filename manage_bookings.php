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

// Handle actions (Approve, Reject, Delete)
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action == 'approve') {
        $conn->query("UPDATE bookings SET status = 'Approved' WHERE id = $id");
    } elseif ($action == 'reject') {
        $conn->query("UPDATE bookings SET status = 'Rejected' WHERE id = $id");
    } elseif ($action == 'delete') {
        $conn->query("DELETE FROM bookings WHERE id = $id");
    }
    header("Location: manage_bookings.php");
    exit();
}

// Fetch bookings using fullname directly from bookings and joining with cars
$sql = "SELECT b.id, b.fullname AS customer, c.model AS car, b.start_date, b.end_date, b.status
        FROM bookings b
        JOIN cars c ON b.car_id = c.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 90%;
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
        .btn-approve { background-color: #27ae60; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px; font-size: 0.9em; }
        .btn-reject { background-color: #e67e22; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px; font-size: 0.9em; }
        .btn-delete { background-color: #c0392b; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px; font-size: 0.9em; }
        .btn-approve:hover, .btn-reject:hover, .btn-delete:hover { opacity: 0.8; }
    </style>
</head>
<body>
    <header>
        <h1>Car Rental Admin Dashboard</h1>
    </header>

    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="manage_cars.php">Manage Cars</a>
        <a href="manage_bookings.php" class="active">Manage Bookings</a>
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
            <th>Actions</th>
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $statusDisplay = !empty($row['status']) ? htmlspecialchars($row['status']) : 'Pending';
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".htmlspecialchars($row['customer'])."</td>
                        <td>".htmlspecialchars($row['car'])."</td>
                        <td>".$row['start_date']."</td>
                        <td>".$row['end_date']."</td>
                        <td><strong>".$statusDisplay."</strong></td>
                        <td>
                            <a href='manage_bookings.php?action=approve&id=".$row['id']."' class='btn-approve'>Approve</a>
                            <a href='manage_bookings.php?action=reject&id=".$row['id']."' class='btn-reject'>Reject</a>
                            <a href='manage_bookings.php?action=delete&id=".$row['id']."' class='btn-delete' onclick='return confirm(\"Are you sure you want to delete this booking?\");'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No bookings found</td></tr>";
        }
        ?>
    </table>
</body>
</html>