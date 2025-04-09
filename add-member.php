<?php
require 'conn.php';
session_start();

$conn = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $service = $_POST['service'];
    $plan = $_POST['plan'];
    $payment = $_POST['payment'];

    if (!empty($name) && !empty($service) && !empty($plan) && !empty($payment)) {
        // Ensure $payment is an integer
        $payment = (int)$payment;

        $stmt = $conn->prepare("INSERT INTO memberAttendance (NAME, SERVICE, PLAN, PAYMENT) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $name, $service, $plan, $payment); // 3 strings, 1 integer

        if ($stmt->execute()) {
            header("Location: member.php");
            exit();
        } else {
            $error = "Failed to add New Member: " . $conn->error;
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
    <h2 class="text-center text-warning mb-4">Add New Member</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Member Name</label>
            <input type="text" class="form-control" id="name" name="name" required placeholder="Enter New Member Full Name">
        </div>
        <div class="mb-3">
            <label for="service" class="form-label">Service</label>
                <select class="form-select" id="service" name="service" required>
                    <option disabled selected>Select a service</option>
                    <option value="Gym Training">Gym Training</option>
                    <option value="Death Kwon Dos">Death Kwon Do</option>
                    <option value="Kung Flu">Kung Flu</option>
                    <option value="Brazilian Nin-Jutsu">Brazilian Nin-Jutsu</option>
                    <option value="KuRaTe">KuRaTe</option>
                    <option value="Boxing">Boxing</option>
                    <option value="Yoga">Yoga</option>
                    <!-- Add more services as needed -->
                </select>
        </div>
        <div class="mb-3">
            <label for="plan" class="form-label">Plans</label>
                <select class="form-select" id="plan" name="plan" required>
                    <option disabled selected>Select a plans</option>
                    <option value="1 Day Session">Sessions</option>
                    <option value="1 Week">1 Week</option>
                    <option value="1 Month">1 Month</option>
                    <option value="3 Months">3 Months</option>
                    <option value="1 Year">1 Year</option>
                </select>
        </div>
        <div class="mb-3">
            <label for="payment" class="form-label">Payment</label>
            <input type="number" class="form-control" id="payment" name="payment" required placeholder="Enter Payment">
        </div>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-check-circle"></i> Add</button>
        <a href="member.php" class="btn btn-secondary">Cancel</a>
    </form>
</main>
</body>
</html>