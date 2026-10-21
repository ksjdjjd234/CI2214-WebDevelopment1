<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cars with real-time availability check based on approved bookings
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
    <title>Car Rental - Available Cars</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .car-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }
        .car-card {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 280px;
            padding: 15px;
            text-align: center;
            box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
        }
        .car-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 4px;
            background-color: #eee; /* Fallback background if image is loading */
        }
        .status-available { color: green; font-weight: bold; }
        .status-rented { color: red; font-weight: bold; }
        .btn-book {
            display: inline-block;
            margin-top: 10px;
            background-color: #2980b9;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 3px;
            font-weight: bold;
        }
        .btn-book:hover { background-color: #1c5980; }
        .btn-disabled {
            display: inline-block;
            margin-top: 10px;
            background-color: #95a5a6;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 3px;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>Car Rental - Our Fleet</h1>
    </header>
    
    <nav>
        <a href="index.php">Home</a>
        <a href="list.php" class="active">Our List</a>
        <a href="book.php">Book a Car</a>
        <a href="admin.php">Admin</a>
    </nav>
     
<main>
    <h2 style="text-align:center;">Explore Our Vehicles</h2>
    <div class="car-container">
        <?php
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Determine image path (handles default vs uploaded images correctly)
                $imagePath = !empty($row['image']) ? $row['image'] : 'default-car.jpg';
                
                // Determine availability status styling and button behavior
                $isAvailable = ($row['availability'] == 'Available');
                $statusClass = $isAvailable ? 'status-available' : 'status-rented';
                
                echo '<div class="car-card">';
                echo '<img src="' . htmlspecialchars($imagePath) . '" alt="Car Image">';
                echo '<h3>' . htmlspecialchars($row['model']) . '</h3>';
                echo '<p>Plate: ' . htmlspecialchars($row['plate']) . '</p>';
                echo '<p>Year: ' . $row['year'] . '</p>';
                echo '<p>Status: <span class="' . $statusClass . '">' . $row['availability'] . '</span></p>';
                
                if ($isAvailable) {
                    echo '<a href="book.php" class="btn-book">Book Now</a>';
                } else {
                    echo '<span class="btn-disabled">Rented Out</span>';
                }
                
                echo '</div>';
            }
        } else {
            echo "<p style='text-align:center;'>No cars available in the fleet right now.</p>";
        }
        ?>
    </div>
</main>

    <footer>
        &copy; 2026 Web Development 1 - Car Rental. All rights reserved.
    </footer>
</body>
</html>
