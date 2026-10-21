<?php
// Turn on error reporting to see everything
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "sql207.infinityfree.com";
$username = "if0_43217470";
$password = "tfnn0jDG5HRdthA";
$dbname = "if0_43217470_carrental";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data was received
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    die("Error: No form data received. Make sure you submitted the form from admin.php.");
}

$user = $_POST['username'];
$pass = $_POST['password'];

$stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_password = $row['password'];

    // If already hashed
    if (password_verify($pass, $stored_password)) {

        session_start();
        $_SESSION['username'] = $user;

        header("Location: dashboard.php");
        exit();
    }

    // If still plain text
    elseif ($pass === $stored_password) {

        // Convert to hash automatically
        $newHash = password_hash($pass, PASSWORD_DEFAULT);

        $update = $conn->prepare(
            "UPDATE admins SET password = ? WHERE username = ?"
        );
        $update->bind_param("ss", $newHash, $user);
        $update->execute();

        session_start();
        $_SESSION['username'] = $user;

        header("Location: dashboard.php");
        exit();
    }

    else {
        echo "Invalid password.";
    }
} else {
    echo "User '$user' not found in the database admins table.";
}
?>
