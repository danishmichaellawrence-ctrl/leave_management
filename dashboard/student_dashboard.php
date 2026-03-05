<?php
session_start();
// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'student') {
//     header("Location: ../index.php");
//     exit;
// }

include "../backend/db.php";

// Correct session variables
$student_id = $_SESSION['student_id'];
$student_name = $_SESSION['student_name'];

// Fetch leaves for this student
$leaves = mysqli_query($conn, "SELECT * FROM leaves WHERE student_id='$student_id' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>
<?php include '../link.php'; ?>
</head>

<body class="bg-light">
<div class="container mt-4">
    <h3>Welcome, <?php echo $student_name; ?></h3>
    <a class="btn btn-success mt-3" href="student_leave.php">Apply Leave</a>
    
    <h4 class="mt-4">My Leave Applications</h4>
    <button class="btn back mt-2"><a href="../hod_login.php"><i class="bi bi-caret-left"></i>Back</a></button>
    <table class="table table-bordered mt-2">
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Reason</th>
            <th>Status</th>
            <th>HOD Remark</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($leaves)) { ?>
            <tr>
                <td><?php echo $row['from_date']; ?></td>
                <td><?php echo $row['to_date']; ?></td>
                <td><?php echo $row['reason']; ?></td>
                <td>
                    <?php 
                        if ($row['status'] == "Pending") echo '<span class="badge bg-warning">Pending</span>';
                        elseif ($row['status'] == "Approved") echo '<span class="badge bg-success">Approved</span>';
                        else echo '<span class="badge bg-danger">Rejected</span>';
                    ?>
                </td>
                <td><?php echo $row['hod_remark'] ?: '-'; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
