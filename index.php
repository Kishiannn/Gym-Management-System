<?php 
session_start();
require "conn.php";

// Count Checked-in Members
function countCheckedInMembers() {
    $conn = connection();
    $result = $conn->query("SELECT COUNT(*) as total FROM memberAttendance WHERE isCheckedIn = 1");
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Count Checked-in Trainers
function countCheckedInTrainers() {
    $conn = connection();
    $result = $conn->query("SELECT COUNT(*) as total FROM employeeAttendance WHERE isCheckedIn = 1");
    $row = $result->fetch_assoc();
    return $row['total'];
}
function countRegisteredMembers() {
    $conn = connection();
    $result = $conn->query("SELECT COUNT(*) as total FROM memberAttendance");
    $row = $result->fetch_assoc();
    return $row['total'];
}

function calculateTotalEarnings() {
    $conn = connection();
    $result = $conn->query("SELECT SUM(payment) as total FROM memberAttendance");
    $row = $result->fetch_assoc();
    return $row['total'];
}
function countDamagedEquipment() {
    $conn = connection();
    $sql = "SELECT COUNT(*) as damaged_count FROM equipment WHERE isCheckedIn = 1"; // 1 means damaged
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['damaged_count'];
}


$activeMembersCount = countCheckedInMembers();
$checkedInTrainerCount = countCheckedInTrainers();
$registeredMemberCount = countRegisteredMembers();
$totalEarnings = calculateTotalEarnings();
$damagedCount = countDamagedEquipment();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="body-color" style="background-color: black;">
    <div class="profile-container" style="border: 5px; background-color: orange; position: absolute; width: 70vw; height: 100px; top: 20px; left: 360px;">
        <ul class="homepage-name ms-auto">
        <h1 class="text-dark" style="position: absolute; left: 60px; top: 20px">Welcome,</h1>
        <a href="profile.php" class="nav-link" style="position: absolute; font-size: 30px; left: 250px; top: 25px;">
            <?= htmlspecialchars($_SESSION['username']) ?>
        </a>
    </div>


    
    <div class="active-container" 
    style="
    position: absolute;
    padding-left: 10px;
    top: 130px;
    left: 360px;
    width: 270px;
    height: 120px;
    border: 5px solid orange;">
        <h1 style="font-size: 20px">Active Member</h1>
        <p style="font-size: 30px; font-weight: bold;">
            <?= $activeMembersCount ?>
        </p>
    </div>



    <div class="active-container" 
    style="position: absolute;
    padding-left: 10px;
    top: 130px;
    left: 640px;
    width: 270px;
    height: 120px;
    border: 5px solid orange;">
        <h1 style="font-size: 20px">Registered Member</h1>
        <p style="font-size: 30px; font-weight: bold;">
            <?= $registeredMemberCount ?>
        </p>
    </div>
    
    <div class="active-container" style="position: absolute; padding-left: 10px; top: 130px; left: 920px; width: 450px; height: 120px; border: 5px solid orange;">
        <h1 style="font-size: 20px">Available Gym Trainer</h1>
        <p style="font-size: 30px; font-weight: bold;">
            <?= $checkedInTrainerCount ?>
        </p>
    </div>


    <div class="active-container" style="position: absolute; padding-left: 10px; top: 260px; left: 360px; width: 350px; height: 120px; border: 5px solid orange;">
            <h1 style="font-size: 20px; color: rgba(0, 255, 34, 1)">Total Earning</h1>
            <p style="font-size: 30px; font-weight: bold;">
                <?= number_format($totalEarnings, 2) ?> <!-- Format to two decimal places -->
            </p>
    </div>
    <div class="active-container" style="position: absolute; padding-left: 10px; top: 260px; left: 720px; width: 350px; height: 120px; border: 5px solid orange;">
        <h1 style="font-size: 20px; color: rgba(254, 0, 0, 0.79);">Damage Equipment</h1>
            <p class="card-text" style="font-size: 30px; font-weight: bold;">
            <?= $damagedCount ?>
            </p>
    </div>


<?php include 'customer_navbar.php'?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<div>
</body>
</html>