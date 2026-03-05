<?php
session_start();
if(!isset($_SESSION['student_id'])){
    header("Location: ../student_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apply Leave</title>
    <?php include '../link.php'; ?>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center mt-5">
    <div class="card shadow-lg p-4 login-card">
        <h3 class="text-center mb-4">Apply Leave</h3>

        <form action="../backend/student_leave_process.php" method="POST">
            <div class="mb-3">
                <label>From Date</label>
                <input type="date" name="from_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>To Date</label>
                <input type="date" name="to_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Reason</label>
                <textarea name="reason" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Apply</button>
        </form>
        <button class="btn back mt-2"><a href="student_dashboard.php"><i class="bi bi-caret-left"></i>Back</a></button>
    </div>
</div>

</body>
</html>
