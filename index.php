<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leave Management | Choose Login</title>

    <?php include 'link.php'; ?>
</head>

<body style="background: #f5f5f5;">

<div class="container d-flex justify-content-center align-items-center" 
    style="height: 100vh;">

    <div class="card shadow-lg p-5"
         style="border-radius: 15px; width: 420px;">

        <h3 class="text-center mb-4" style="font-weight: 600;">
            Leave Management System
        </h3>

        <p class="text-center mb-4" style="font-size: 15px; color: #666;">
            Select your login type
        </p>

        <!-- HOD Login -->
        <a href="hod_login.php" 
           class="btn btn-dark w-100 mb-3"
           style="padding: 12px; font-size: 18px;">
            HOD Login
        </a>

        <!-- Student Login -->
        <a href="student_login.php" 
           class="btn btn-primary w-100"
           style="padding: 12px; font-size: 18px;">
            Student Login
        </a>

    </div>
</div>

</body>
</html>
