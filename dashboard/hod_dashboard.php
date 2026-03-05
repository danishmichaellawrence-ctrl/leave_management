<?php
session_start();

// Access control
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'hod') {
    header("Location: ../hod_login.php");
    exit();
}

include "../backend/db.php";

$dept = $_SESSION['dept_name'];

// Fetch leaves only from HOD's department
$leaves = mysqli_query($conn, "
    SELECT l.*, s.name 
    FROM leaves l
    JOIN student s ON l.student_id = s.id
    WHERE s.dept_name = '$dept'
    ORDER BY l.id DESC
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>HOD Dashboard</title>
    <?php include '../link.php'; ?>
</head>

<body class="bg-light">
    <div class="container mt-4">
        <h3>Welcome, HOD <?php echo $_SESSION['hod_name']; ?></h3>

        <h4 class="mt-4">Leave Requests</h4>

        <button class="btn back mt-2"><a href="../hod_login.php"><i class="bi bi-caret-left"></i>Back</a></button>


        <table class="table table-bordered mt-2">
            <tr class="table-dark">
                <!-- <th>ID</th> -->
                <th>Student</th>
                <th>From</th>
                <th>To</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($leaves)) { ?>
                <tr>
                    <!-- <td><?php echo $row['id']; ?></td> -->
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['from_date']; ?></td>
                    <td><?php echo $row['to_date']; ?></td>
                    <td><?php echo $row['reason']; ?></td>
                    <td>
                        <?php
                        if ($row['status'] == "Pending") echo '<span class="badge bg-warning">Pending</span>';
                        else if ($row['status'] == "Approved") echo '<span class="badge bg-success">Approved</span>';
                        else echo '<span class="badge bg-danger">Rejected</span>';
                        ?>
                    </td>
                    <td>
                        <?php if ($row['status'] == "Pending") { ?>
                            <form method="POST" action="../backend/approve_process.php" class="d-flex gap-1">
                                <input type="hidden" name="leave_id" value="<?php echo $row['id']; ?>">
                                <input type="text" name="remark" class="form-control form-control-sm" placeholder="Remark" required>
                                <button type="submit" name="status" value="Approved" class="btn btn-success btn-sm">Approve</button>
                                <button type="submit" name="status" value="Rejected" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        <?php } else {
                            echo $row['hod_remark']; // Show remark if already processed
                        } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>