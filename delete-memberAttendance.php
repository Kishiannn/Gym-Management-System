<?php
require 'conn.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // sanitize the ID
    $conn = connection();

    $stmt = $conn->prepare("DELETE FROM memberAttendance WHERE ID = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: member.php"); // redirect after deletion
        exit();
    } else {
        echo "Failed to delete member: " . $conn->error;
    }
} else {
    echo "Invalid request. No ID provided.";
}
?>