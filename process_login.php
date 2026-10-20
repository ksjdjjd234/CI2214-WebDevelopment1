<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$user = $_POST['username'];
$pass = $_POST['password'];


$stmt = $conn->prepare("SELECT * FROM admins WHERE username=? AND password=MD5(?)");
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    session_start();
    $_SESSION['username'] = $user;
    header("Location: dashboard.php");
    exit();

} else {
    header("Location: admin.php?error=1");
    exit();
}
?>

