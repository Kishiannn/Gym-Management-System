<?php
require 'conn.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = connection();

    $stmt = $conn->prepare("DELETE FROM employeeAttendance WHERE ID = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: employeeAttendance.php"); // Go back after deletion
        exit();
    } else {
        echo "Error deleting employee: " . $conn->error;
    }
} else {
    echo "Invalid request: No ID provided.";
}
?>