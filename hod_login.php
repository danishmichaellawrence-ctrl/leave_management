<?php require 'backend/db.php';
require 'backend/vendor/autoload.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leave Management | Login</title>

    <?php include 'link.php'; ?>
    
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"> -->

</head>

<body class="bg-light">

<div class="container d-flex justify-content-center mt-5">
    <div class="card shadow-lg p-4 login-card">
        <h3 class="text-center mb-4">HOD Management System</h3>

        <form action="backend/hod_login_process.php" method="POST">

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Department</label>
                <select class="form-select" name="dept" id="" required>
                    <option value="" selected disabled>Select Your Department</option>
                    <option value="B.Sc Maths">B.Sc Maths</option>
                    <option value="BA English">B.Sc Physics</option>
                    <option value="BCA">B.Sc Chemisty</option>
                    <option value="B.com">BCA</option>
                    <option value="B.com">BBA</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Login</button>
        </form>
        <button class="btn back mt-2"><a href="index.php"><i class="bi bi-caret-left-fill"></i>Back</a></button>
    </div>
</div>

</body>
</html>
