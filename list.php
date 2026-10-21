<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental - Our List</title>
    <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
</head>
<body>
    <header>
        <h1>Car Rental</h1>
    </header>
    <nav>
        <a href="index.php">Home</a>
        <a href="list.php" class="active">Our List</a>
        <a href="book.php">Book a Car</a>
        <a href="admin.php">Admin</a>
    </nav>
    <main>
        <h2>Our Car List</h2>
       <p> Here are our available cars at the moment. Feel free to browse and select the one that suits your needs!
       </p>
       <?php
// Example loop inside list.php
$result = $conn->query("SELECT * FROM cars");
while ($row = $result->fetch_assoc()) {
    echo '<div class="car-card" style="background:white; padding:20px; margin-bottom:20px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.05);">';
    
    // Display the image
    if (!empty($row['image'])) {
        echo '<img src="images/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['model']) . '" style="width:100%; height:220px; object-fit:cover; border-radius:6px; margin-bottom:15px;">';
    }
    
    // Display car details matching your exact columns
    echo '<h3>' . htmlspecialchars($row['model']) . '</h3>';
    echo '<p><strong>Plate:</strong> ' . htmlspecialchars($row['plate']) . '</p>';
    echo '<p><strong>Year:</strong> ' . htmlspecialchars($row['year']) . '</p>';
    echo '<p><strong>Status:</strong> <span class="badge">' . htmlspecialchars($row['status']) . '</span></p>';
    echo '<a href="book.php?id=' . $row['id'] . '" style="display:inline-block; background:#2980b9; color:white; padding:8px 16px; border-radius:4px; text-decoration:none; margin-top:10px;">Book Now</a>';
    
    echo '</div>';
}


?>
  // This part is to wrap the image in a fixed container for proper display
<?php
if (!empty($row['image'])) {
    // 1. Fixed-height container box that controls the card layout shape
    echo '<div style="width: 100%; height: 200px; overflow: hidden; border-radius: 6px; margin-bottom: 15px;">';
    
    // 2. Image fills the box completely without distorting proportions
    echo '<img src="images/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['model']) . '" style="width: 100%; height: 100%; object-fit: cover;">';
    
    echo '</div>';
}
?>

      
    </main>
    <footer>
        &copy 2026 Web Development 1 - Car Rental. All rights reserved. (I think)
    </footer>
    </body>
    </html>
