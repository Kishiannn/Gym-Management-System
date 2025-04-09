<?php 
    require 'conn.php';
    session_start();

    function getAllmemberAttendance(){
        $conn = connection();
        $sql = "SELECT memberAttendance.ID AS id,
                       memberAttendance.NAME AS name,
                       memberAttendance.SERVICE AS service,
                       memberAttendance.PLAN AS plan,
                       memberAttendance.PAYMENT AS payment,
                       memberAttendance.isCheckedIn
                FROM memberAttendance";

        if ($result = $conn->query($sql)) {
            return $result;
        } else {
            die("Error retrieving Member Attendance: " . $conn->error);
        }
    }

    // Handle check-in or check-out action
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && isset($_POST['gymMember_id'])) {
        $action = $_POST['action'];
        $trainer_id = intval($_POST['gymMember_id']); // sanitize input
        $conn = connection();

        // Determine action
        $status = ($action === 'check_in') ? 1 : 0;
        $sql = "UPDATE memberAttendance SET isCheckedIn = ? WHERE ID = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $status, $trainer_id);
        $stmt->execute();

        // Optional: redirect to avoid resubmission on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>
<body class="body-color" style="background-color: black;">
<main class="container" style="position: absolute; left: 350px; top: 50px; width: 1000px;">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-light" style="position: absolute; color: orange;">Member Management</h2>
        </div>
        <div class="col text-end">
            <a href="add-member.php" class="btn btn-success">
                <i class="fa-solid fa-plus-circle"></i> Add New Member
            </a>
        </div>
    </div>
    <table class="table table-hover align-middle" style="border: 2px solid orange;">
        <thead class="small table-success">
            <tr>
                <th style="background-color: orange; width: 250px; border-right: 2px solid black;">NAME</th>
                <th style="background-color: orange; border-right: 2px solid black;">SERVICE DETAILED</th>
                <th style="background-color: orange; border-right: 2px solid black;">PLANS</th>
                <th style="background-color: orange; border-right: 2px solid black;">PAYMENTS</th>
                <th style="background-color: orange; border-right: 2px solid black;">ATTENDANCE</th>
                <th style="background-color: orange; width: 95px;">DELETE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $all_memberAttendance = getAllmemberAttendance();
            while ($memberAttendance = $all_memberAttendance->fetch_assoc()) {
                $isCheckedIn = $memberAttendance['isCheckedIn'];
                $statusLabel = $isCheckedIn ? 'Check Out' : 'Check In';
                $statusAction = $isCheckedIn ? 'check_out' : 'check_in';
                $buttonClass = $isCheckedIn ? 'btn-danger' : 'btn-success';
            ?>
            <tr>
                <td><?= htmlspecialchars($memberAttendance['name']) ?></td>
                <td><?= htmlspecialchars($memberAttendance['service']) ?></td>
                <td><?= htmlspecialchars($memberAttendance['plan']) ?></td>
                <td><?= htmlspecialchars($memberAttendance['payment']) ?></td>
                <td>
                    <form method="POST" style="margin: 0;">
                        <input type="hidden" name="gymMember_id" value="<?= $memberAttendance['id'] ?>">
                        <button type="submit" name="action" value="<?= $statusAction ?>" class="btn <?= $buttonClass ?>">
                            <?= $statusLabel ?>
                        </button>
                    </form>
                </td>
                <td>
                    <a href="delete-memberAttendance.php?id=<?= $memberAttendance['id'] ?>" 
                       class="btn btn-outline-danger btn-sm" 
                       onclick="return confirm('Are you sure you want to delete this Gym Member?');">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</main>
<?php include 'customer_navbar.php'?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>