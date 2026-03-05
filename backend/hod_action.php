<?php
require '../mail_config.php';

// Fetch student email
$stmt = $conn->prepare("SELECT s.email, s.name, l.from_date, l.to_date, l.reason 
                        FROM leaves l 
                        JOIN student s ON l.student_id = s.id 
                        WHERE l.id = ?");
$stmt->bind_param("i", $leave_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

$studentEmail = $data['email'];
$studentName  = $data['name'];

// Prepare email content
$subject = "Your Leave Request Has Been $status";

$message = "
<h3>Leave Status Update</h3>
<p><b>Student:</b> $studentName</p>
<p><b>Status:</b> $status</p>
<p><b>Remark:</b> $remark</p>
<p><b>From:</b> {$data['from_date']}</p>
<p><b>To:</b> {$data['to_date']}</p>
<p><b>Reason:</b> {$data['reason']}</p>
";

sendMail($studentEmail, $subject, $message);
?>