<?php
$conn = mysqli_connect("localhost:3306", "root", "", "leave_system");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>
