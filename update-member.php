<?php
require 'conn.php';

if (isset($_POST['id']) && isset($_POST['status'])) {
    $conn = connection();
    $id = $_POST['id'];
    $status = $_POST['status']; // 1 = check in, 0 = check out

    $sql = "UPDATE memberAttendance SET isCheckedIn = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $status, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
?>