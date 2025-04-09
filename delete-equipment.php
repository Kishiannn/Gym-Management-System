<?php
require 'conn.php';
session_start();

$conn = connection();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Get the ID from the URL

    // Prepare and execute the DELETE query
    $stmt = $conn->prepare("DELETE FROM equipment WHERE ID = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect back to equipment page after successful deletion
        header("Location: equipment.php");
        exit();
    } else {
        echo "Error deleting equipment: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>