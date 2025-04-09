<?php
require 'conn.php';
session_start();

$conn = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $type = $_POST['type'];

    if (!empty($name) && !empty($type)) {
        $stmt = $conn->prepare("INSERT INTO equipment (NAME, TYPE) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $type);

        if ($stmt->execute()) {
            header("Location: equipment.php");
            exit();
        } else {
            $error = "Failed to add equipment: " . $conn->error;
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
    <title>Equipment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<main class="container" style="max-width: 600px; margin-top: 100px;">
    <h2 class="text-center text-warning mb-4">Add New Equipment</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Equipment Name</label>
            <input type="text" class="form-control" id="name" name="name" required placeholder="Enter equipment name">
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Equipment Type</label>
            <input type="text" class="form-control" id="type" name="type" required placeholder="Enter equipment type">
        </div>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-check-circle"></i> Add</button>
        <a href="equipment.php" class="btn btn-secondary">Cancel</a>
    </form>
</main>
</body>
</html>