<!DOCTYPE html?
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental - Admin Portal</title>
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
        <h1>Car Rental</h1>
    </header>

    <nav>
        <a href="index.php">Home</a>
        <a href="list.php">Our List</a>
        <a href="book.php">Book a Car</a>
        <a href="admin.php" class="active">Admin</a>
    </nav>
    <main>
        <h2>Admin Portal</h2>
        <p> Please log in to gain access</p>
        <!-- Backend authentication to be done here @Malrif-->
         <div class="login-box">
            <h3>Admin Login</h3>
            <form action="process_login.php" method="post">
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </main>
    <footer>
        &copy 2026 Web Development 1 - Car Rental. All rights reserved. (I think)
    </footer>
</body>
</html>
 