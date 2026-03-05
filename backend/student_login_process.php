<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $reg = trim($_POST['id']);          // from form
    $dept = trim($_POST['dept_name']);  // from form
    $password = trim($_POST['password']);

    // Prepare SQL query
    $stmt = $conn->prepare("SELECT * FROM student WHERE name = ? AND reg = ? AND dept_name = ?");
    $stmt->bind_param("sss", $name, $reg, $dept);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check password
    if ($user && $password === $user['password']) {

        // Create session
        $_SESSION['student_id'] = $user['id'];
        $_SESSION['student_name'] = $user['name'];
        $_SESSION['department'] = $user['dept_name'];
        $_SESSION['year'] = $user['year'];
        $_SESSION['role'] = "student";

        // Redirect to dashboard
        header("Location: ../dashboard/student_dashboard.php");
        exit();

    } else {

        echo "<script>
                alert('Invalid Student Login');
                window.location='../student_login.php';
              </script>";
        exit();
    }

} else {
    header("Location: ../student_login.php");
    exit();
}
?>