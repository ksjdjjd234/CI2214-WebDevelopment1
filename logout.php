<?php
session_start();
session_destroy(); // remove all session data
header("Location: admin.php"); // go back to login page
exit();
?>
