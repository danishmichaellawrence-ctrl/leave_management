<?php
session_start();
require 'db.php';
require '../mail_config.php';

$leave_id = $_POST['leave_id'];
$status = $_POST['status'];  // Approved / Rejected
$hod_remark = $_POST['hod_remark'];

// Update leave status
$update = $conn->prepare("UPDATE leaves SET status = ?, hod_remark = ? WHERE id = ?");
$update->bind_param("ssi", $status, $hod_remark, $leave_id);
$update->execute();

// Get student details for email
$query = $conn->prepare("
    SELECT leaves.*, student.email, student.name 
    FROM leaves 
    JOIN student ON leaves.student_id = student.id 
    WHERE leaves.id = ?
");
$query->bind_param("i", $leave_id);
$query->execute();
$result = $query->get_result();
$leave = $result->fetch_assoc();

$student_email = $leave['email'];
$student_name = $leave['name'];

// Send email to student from centralized email
$subject = "Your Leave Request has been $status";
$message = "
Hello $student_name,

Your leave request has been **$status** by your HOD.

HOD Remark: $hod_remark

From: {$leave['from_date']}
To: {$leave['to_date']}
Reason: {$leave['reason']}

Thank you.
";

$email_result = sendMail($student_email, $subject, $message);
if($email_result === true){
    $alert_msg = 'Leave Updated Successfully & Email Sent!';
} else {
    $alert_msg = 'Leave Updated Successfully, but Email Failed: ' . $email_result;
}

echo "<script>alert('$alert_msg'); window.location='../dashboard/hod_dashboard.php';</script>";
exit;
?>
