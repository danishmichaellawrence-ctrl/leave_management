<?php
session_start();
require 'db.php';
require './mail_config.php';

// Student data from session
$student_id = $_SESSION['student_id'];
$student_name = $_SESSION['student_name'];
$department = $_SESSION['department'];
$year = $_SESSION['year'];

// Form data
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$reason = $_POST['reason'];

// Insert into database
$stmt = $conn->prepare("INSERT INTO leaves (student_id, department, year, from_date, to_date, reason)
                        VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isisss", $student_id, $department, $year, $from_date, $to_date, $reason);
$stmt->execute();

// GET HOD EMAIL
$hodQuery = $conn->prepare("SELECT email FROM hod WHERE dept_name = ?");
$hodQuery->bind_param("s", $department);
$hodQuery->execute();
$hodResult = $hodQuery->get_result();
$hod = $hodResult->fetch_assoc();
$hod_email = $hod['email'];

// MAIL CONTENT
$subject = "New Leave Request from $student_name";

$message = "
A new leave request has been submitted.

Student Name: $student_name
Department: $department
Year: $year

From Date: $from_date
To Date: $to_date
Reason: $reason

Please login to HOD Dashboard to approve or reject.
";

// SEND MAIL
sendMail($hod_email, $subject, $message);

// Redirect
echo "<script>alert('Leave Applied Successfully. HOD will review.'); window.location='dashboard/student_leave.php';</script>";
exit;
?>
