<?php
session_start();
require 'db.php';

$name = trim($_POST['name']);
$password = trim($_POST['password']);

$stmt = $conn->prepare("SELECT * FROM hod WHERE name = ?");
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && $password === $user['password']) {

    // Correct session variables
    $_SESSION['role'] = 'hod';
    $_SESSION['hod_id'] = $user['id'];
    $_SESSION['hod_name'] = $user['name'];
    $_SESSION['dept_name'] = $user['dept_name']; // correct column

    header("Location: ../dashboard/hod_dashboard.php");
    exit;

} else {
    echo "<script>alert('Invalid HOD Login'); window.location='../hod_login.php';</script>";
    exit;
}
?>
