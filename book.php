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

$errors = [];
$successMessage = "";

// Handle Form Submission when POST request is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $car_id = trim($_POST['carselect']); 
    $rentaldate = $_POST['rentaldate'];
    $returndate = $_POST['returndate'];
    
    // Explicitly set default status to 'Pending' so it is never blank in the database
    $status = 'Pending'; 

    // Server-side Validation
    if (empty($fullname)) { $errors['fullname'] = 'Full Name is required.'; }
    if (empty($email)) { $errors['email'] = 'Email is required.'; }
    if (empty($car_id)) { $errors['carselect'] = 'Please specify a vehicle.'; }
    if (empty($rentaldate)) { $errors['rentaldate'] = 'Rental date is required.'; }
    if (empty($returndate)) { $errors['returndate'] = 'Return date is required.'; }

    // If no errors, insert into database with the 'Pending' status
    if (empty($errors)) {
        $sql = "INSERT INTO bookings (fullname, email, car_id, start_date, end_date, status) 
                VALUES ('$fullname', '$email', '$car_id', '$rentaldate', '$returndate', '$status')";

        if ($conn->query($sql) === TRUE) {
            $successMessage = "Booking submitted successfully!";
        } else {
            echo "<script>alert('Database Error: " . $conn->error . "');</script>";
        }
    }
}

// Fetch available cars for the dropdown list
$carsResult = $conn->query("SELECT id, model FROM cars");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental - Book a Car</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
            display: block;
        }
        .success {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }
        form div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #1c5980;
        }
    </style>
</head>
<body>
    <header>
        <h1>Car Rental</h1>
    </header>
    <nav>
        <a href="index.php">Home</a>
        <a href="list.php">Our List</a>
        <a href="book.php" class="active">Book a Car</a>
        <a href="admin.php">Admin</a>
    </nav>
     
<main>
    <h2>Book a Car</h2>
    <p>Fill out the form below to book a car. Please ensure all fields are completed accurately.</p>

    <?php if (!empty($successMessage)): ?>
        <p class="success"><?php echo $successMessage; ?></p>
    <?php endif; ?>

    <form action="book.php" method="post" id="bookingForm">
        <div>
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>
            <?php if (!empty($errors['fullname'])): ?>
                <span class="error"><?php echo $errors['fullname']; ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <?php if (!empty($errors['email'])): ?>
                <span class="error"><?php echo $errors['email']; ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="carselect">Select Vehicle:</label>
            <select id="carselect" name="carselect" required>
                <option value="">-- Choose an Available Car --</option>
                <?php 
                if ($carsResult && $carsResult->num_rows > 0) {
                    while($car = $carsResult->fetch_assoc()) {
                        echo '<option value="' . $car['id'] . '">' . htmlspecialchars($car['model']) . '</option>';
                    }
                }
                ?>
            </select>
            <?php if (!empty($errors['carselect'])): ?>
                <span class="error"><?php echo $errors['carselect']; ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="rentaldate">Rental Date:</label>
            <input type="date" id="rentaldate" name="rentaldate" required>
            <?php if (!empty($errors['rentaldate'])): ?>
                <span class="error"><?php echo $errors['rentaldate']; ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="returndate">Return Date:</label>
            <input type="date" id="returndate" name="returndate" required>
            <?php if (!empty($errors['returndate'])): ?>
                <span class="error"><?php echo $errors['returndate']; ?></span>
            <?php endif; ?>
        </div>
        <button type="submit">Submit Booking</button>
    </form>
</main>

    <footer>
        &copy; 2026 Web Development 1 - Car Rental. All rights reserved.
    </footer>
</body>
</html>