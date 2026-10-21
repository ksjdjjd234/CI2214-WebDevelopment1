<?php
session_start();
// Protect the page: only logged-in admins can see it
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


$cars_result = $conn->query("SELECT COUNT(*) AS total_cars FROM cars");
$cars_count = $cars_result->fetch_assoc()['total_cars'];


$bookings_result = $conn->query("SELECT COUNT(*) AS total_bookings FROM bookings");
$bookings_count = $bookings_result->fetch_assoc()['total_bookings'];


$users_result = $conn->query("SELECT COUNT(*) AS total_users FROM users");
$users_count = $users_result->fetch_assoc()['total_users'];

?>
<!DOCTYPE html?
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental - Admin Portal</title>
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

    <main>
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>You are now logged in to the Car Rental Admin Portal.</p>

        <div class="card">
            <h3>Quick Stats</h3>
            <ul>
                <li>Total Cars: <?php echo $cars_count; ?></li>
                <li>Total Bookings: <?php echo $bookings_count; ?></li>
                <li>Total Users: <?php echo $users_count; ?></li>
            </ul>
        </div>

        <div class="card">
            <h3>Admin Tools</h3>
            <p>Use the navigation links above to manage cars, bookings, and users.</p>
        </div>

        <a href="logout.php" class="logout">Logout</a>
    </main>
</body>
</html>
