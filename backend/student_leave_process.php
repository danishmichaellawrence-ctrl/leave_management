<?php
session_start();
require 'db.php';
require '../mail_config.php';

if(!isset($_SESSION['student_id'])){
    header("Location: ../student_login.php");
    exit;
}

$student_id = $_SESSION['student_id'];
$department = $_SESSION['department'];
$year = $_SESSION['year'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$reason = trim($_POST['reason']);

$stmt = $conn->prepare("INSERT INTO leaves (student_id, department, year, from_date, to_date, reason) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isisss", $student_id, $department, $year, $from_date, $to_date, $reason);

if($stmt->execute()){
    // Get student details
    $student_query = $conn->prepare("SELECT name FROM student WHERE id = ?");
    $student_query->bind_param("i", $student_id);
    $student_query->execute();
    $student_data = $student_query->get_result()->fetch_assoc();
    
    // Get HOD email
    $hod_query = $conn->prepare("SELECT email FROM hod WHERE LOWER(dept_name) = LOWER(?)");
    $hod_query->bind_param("s", $department);
    $hod_query->execute();
    $hod_data = $hod_query->get_result()->fetch_assoc();
    
    if($hod_data){
        $hod_email = $hod_data['email'];
        $student_name = $student_data['name'];
        
        // Send email to HOD from centralized email
        $subject = "New Leave Request from $student_name";
        $message = "
        <h3>New Leave Application</h3>
        <p><b>Student:</b> $student_name</p>
        <p><b>Department:</b> $department</p>
        <p><b>Year:</b> $year</p>
        <p><b>From:</b> $from_date</p>
        <p><b>To:</b> $to_date</p>
        <p><b>Reason:</b> $reason</p>
        <p>Please review and take action.</p>
        ";
        
        $email_result = sendMail($hod_email, $subject, $message);
        if($email_result === true){
            $alert_msg = 'Leave Applied Successfully & Email Sent!';
        } else {
            $alert_msg = 'Leave Applied Successfully, but Email Failed: ' . $email_result;
        }
    } else {
        $alert_msg = 'Leave Applied Successfully, but HOD Email Not Found for department: ' . $department;
    }
    
    echo "<script>alert('$alert_msg'); window.location='../dashboard/student_leave.php';</script>";
} else {
    echo "<script>alert('Error Applying Leave'); window.location='../dashboard/student_leave.php';</script>";
}
?>
