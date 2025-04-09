<?php
require 'conn.php';
session_start();

$conn = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $handle = $_POST['handle'];

    if (!empty($name) && !empty($handle)) {
        $stmt = $conn->prepare("INSERT INTO employeeAttendance (NAME, HANDLE) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $handle);

        if ($stmt->execute()) {
            header("Location: employeeAttendance.php");
            exit();
        } else {
            $error = "Failed to add employee: " . $conn->error;
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<main class="container" style="max-width: 600px; margin-top: 100px;">
    <h2 class="text-center text-warning mb-4">Add New Employee</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Employee Name</label>
            <input type="text" class="form-control" id="name" name="name" required placeholder="Enter employee name">
        </div>
        <div class="mb-3">
            <label for="handle" class="form-label">Handle</label>
            <input type="text" class="form-control" id="handle" name="handle" required placeholder="Enter handle">
        </div>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-check-circle"></i> Add</button>
        <a href="employeeAttendance.php" class="btn btn-secondary">Cancel</a>
    </form>
</main>
</body>
</html>