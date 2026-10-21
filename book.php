<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental - Book a Car</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Simple styling for error messages */
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
            display: block;
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
    <h2> Book a Car</h2>
    <p> Fill out the form below to book a car. Please ensure all fields are completed accurately.</p>

    <! refer to backend validation for the form submission>
    <form action="book.php" method="post">
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
            <input type="text" id="carselect" name="carselect" required>
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
        &copy 2026 Web Development 1 - Car Rental. All rights reserved. (I think)
    </footer>

    <!-- Javascript for Client-side Validation -->
     <script>
        function validateForm(event) {
            let isValid = true;
            //Cleanr previous error messages
            document.getElementById('nameError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('carError').textContent = '';
            document.getElementById('returndateError').textContent = '';

            // Validate Full Name
            let nameField = document.getElementById('fullname').value.trim();
            if (nameField === '') {
                document.getElementById('nameError').textContent = 'Full Name is required.';
                isValid = false;
            }
            // Validate Email
            let emailField = document.getElementById('email').value.trim();
            let emailPattern = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
            if (emailField === '') {
                document.getElementById('emailError').textContent = 'Email is required.';
                isValid = false;
            } else if (!emailPattern.test(emailField)) {
                document.getElementById('emailError').textContent = 'Please enter a valid email address.';
                isValid = false;
            }
            // Validate Car Selection
            let carField = document.getElementById('carselect').value.trim();
            if (carField === '') {
                document.getElementById('carError').textContent = 'Please select a vehicle.';
                isValid = false;
            }
            // Validate Rental Date
            let rentalField = document.getElementById('rentaldate').value;
            if (rentalField === '') {
                document.getElementById('rentaldateError').textContent = 'Rental date is required.';
                isValid = false;
            }
            // Validate Return Date
            let returnField = document.getElementById('returndate').value;
            if (returnField === '') {
                document.getElementById('returndateError').textContent = 'Return date is required.';
                isValid = false;
            }
            // If validation fails, prevent form submission
            if (!isValid) {
                event.preventDefault();
            }
        }
        function init() {
            let sampleForm = document.getElementById('bookingForm');
            sampleForm.onsubmit = validateForm;
        }

        // Call the init function when the window loads
        window.onload = init;
    </script>
</body>
</html> 
