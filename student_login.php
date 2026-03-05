<?php 
require 'backend/db.php';
require 'backend/vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login | Leave Management</title>

    <?php include 'link.php'; ?>
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    
    <div class="card shadow-lg p-4 login-card" style="width:400px;">
        
        <h3 class="text-center mb-4">Student Management System</h3>

        <form action="backend/student_login_process.php" method="POST">

            <div class="mb-3">
                <label class="form-label">Student Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Register Number</label>
                <input type="text" name="id" class="form-control" placeholder="Enter your register number" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Department</label>
                <select class="form-select" name="dept_name" required>
                    <option value="" disabled selected>Select Department</option>
                    <option value="B.Sc Maths">B.Sc Maths</option>
                    <option value="B.Sc Physics">B.Sc Physics</option>
                    <option value="B.Sc Chemistry">B.Sc Chemistry</option>
                    <option value="BCA">BCA</option>
                    <option value="BBA">BBA</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>

        </form>

        <a href="index.php" class="btn back mt-2">
            ← Back
        </a>

    </div>

</div>

</body>
</html>