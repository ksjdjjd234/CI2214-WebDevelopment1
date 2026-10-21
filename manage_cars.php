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

$successMessage = "";
$errorMessage = "";

// Handle Delete Car Action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $car_id = intval($_GET['id']);
    
    // Optional: Delete any bookings associated with this car first to avoid foreign key errors
    $conn->query("DELETE FROM bookings WHERE car_id = $car_id");
    
    // Now delete the car itself
    if ($conn->query("DELETE FROM cars WHERE id = $car_id") === TRUE) {
        header("Location: manage_cars.php?msg=deleted");
        exit();
    } else {
        $errorMessage = "Error deleting car: " . $conn->error;
    }
}

// Handle Add Car Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_car'])) {
    $model = trim($_POST['model']);
    $plate = trim($_POST['plate']);
    $year = intval($_POST['year']);
    
    // Handle Image Upload using 'image' column name
    $imagePath = "default-car.jpg"; // Default fallback value
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . time() . "_" . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array(strtolower($fileType), $allowTypes)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                $imagePath = $targetFilePath;
            } else {
                $errorMessage = "Sorry, there was an error uploading your file.";
            }
        } else {
            $errorMessage = "Only JPG, JPEG, PNG, & GIF files are allowed.";
        }
    }

    if (empty($errorMessage)) {
        $stmt = $conn->prepare("INSERT INTO cars (model, plate, year, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $model, $plate, $year, $imagePath);
        if ($stmt->execute()) {
            $successMessage = "Car added successfully!";
        } else {
            $errorMessage = "Database Error: " . $conn->error;
        }
        $stmt->close();
    }
}

// Fetch cars and dynamically check availability based on bookings
$sql = "SELECT c.*, 
        CASE 
            WHEN EXISTS (
                SELECT 1 FROM bookings b 
                WHERE b.car_id = c.id AND LOWER(TRIM(b.status)) = 'approved'
            ) THEN 'Unavailable (Rented)'
            ELSE 'Available'
        END AS availability
        FROM cars c";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars</title>
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
        .form-container {
            width: 50%;
            margin: 20px auto;
            background: #fdfdfd;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container div {
            margin-bottom: 12px;
        }
        .form-container label {
            display: block;
            font-weight: bold;
            margin-bottom: 4px;
        }
        .form-container input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .btn-submit {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-weight: bold;
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
        .success { color: green; font-weight: bold; text-align: center; }
        .error { color: red; font-weight: bold; text-align: center; }
        img.car-thumb { width: 80px; height: auto; border-radius: 4px; }
    </style>
</head>
<body>
    <header>
        <h1>Car Rental Admin Dashboard</h1>
    </header>

    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="manage_cars.php" class="active">Manage Cars</a>
        <a href="manage_bookings.php">Manage Bookings</a>
        <a href="manage_users.php">Manage Users</a>
    </nav>

    <h2 style="text-align:center;">Add a New Car</h2>
    
    <?php if(!empty($successMessage)) echo "<p class='success'>$successMessage</p>"; ?>
    <?php if(!empty($errorMessage)) echo "<p class='error'>$errorMessage</p>"; ?>
    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'deleted') echo "<p class='success'>Car deleted successfully!</p>"; ?>

    <div class="form-container">
        <form action="manage_cars.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="model">Car Model:</label>
                <input type="text" id="model" name="model" required>
            </div>
            <div>
                <label for="plate">License Plate:</label>
                <input type="text" id="plate" name="plate" required>
            </div>
            <div>
                <label for="year">Year:</label>
                <input type="number" id="year" name="year" required>
            </div>
            <div>
                <label for="image">Car Picture:</label>
                <input type="file" id="image" name="image" required>
            </div>
            <button type="submit" name="add_car" class="btn-submit">Add Car</button>
        </form>
    </div>

    <h2 style="text-align:center;">Existing Cars Catalog & Availability</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Picture</th>
            <th>Model</th>
            <th>Plate</th>
            <th>Year</th>
            <th>Status / Availability</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $statusColor = ($row['availability'] == 'Available') ? 'color: green; font-weight: bold;' : 'color: red; font-weight: bold;';
                $imgSrc = !empty($row['image']) ? $row['image'] : 'default-car.jpg';
                $imgTag = "<img src='".$imgSrc."' class='car-thumb'>";
                
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$imgTag."</td>
                        <td>".htmlspecialchars($row['model'])."</td>
                        <td>".htmlspecialchars($row['plate'])."</td>
                        <td>".$row['year']."</td>
                        <td style='".$statusColor."'>".$row['availability']."</td>
                        <td>
                            <a href='manage_cars.php?action=delete&id=".$row['id']."' class='btn-delete' onclick='return confirm(\"Are you sure you want to delete this car and its related bookings?\");'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No cars found</td></tr>";
        }

        
        ?>
    </table>
</body>
</html>