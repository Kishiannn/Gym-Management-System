<?php 
require "conn.php";

function createUser ($firstname, $lastname, $username, $password){
    $conn = connection();
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (`first_name`, `last_name`, `username`, `password`) VALUES ('$firstname', '$lastname', '$username', '$password')";
//CHECK CONNECTION 
    if ($conn->query($sql)){
        header("location: login.php");
}else {
    die("Error Signing up:". $conn->error);
}

}
if(isset($_POST['btn_signup']) ){
    //form data capture
    $firstname =$_POST['first_name'];
    $lastname =$_POST['last_name'];
    $username =$_POST['username'];
    $password =$_POST['password'];
    $confirmpassword =$_POST['confirm_password'];
    //check password correction
    if ($password == $confirmpassword){
        //if correct, then create user function
        createUser($firstname, $lastname, $username, $password); // ignore error
    } else {
        echo'<p class="alert alert-danger">Password and Confirm Password do not match.</p>';

    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sign up</title>
</head>
<style>
    body{
      overflow-y: hidden; /* Removes vertical scroll */
            margin: 0;
            padding: 0;
    }
    </style>
<body class="bg-black">
    <div style="height: 180vh;">
        <div class="row h-50 m-0">
            <div class="card text-bg-dark mb-3" style="max-width: 50%; height: 650px; margin: auto; padding: 10;">
                 <div class="card header text-success" style="margin-top: 30px">  
                <h1 class=" h2 mb-0" style="display: flex; justify-content: center; background-color: orange; color: black; font-weight: bold; padding: 10px"> Create your Account </h1>
                </div>
                <div class="card-body">
                    <hr>
                    <form action="" method="post" style="margin-top: 20px">
                        <div class="mb-3"><label for="first-name" class="form-label large fw-bold">First Name</label>
                        <input type="text" name="first_name" id="first-name" maxlength="30" required autofocus class="form-control fw-bold" style="width: 22vw">

                    </div>
                        <div class="mb-3"><label for="last-name" class="form-label large fw-bold" style="position: absolute; top: 145px; left: 25vw;">Last Name</label>
                        <input type="text" name="last_name" id="last-name" maxlength="30" required  class="form-control fw-bold" style="position: absolute; width: 23vw; top: 175px; left: 25vw;">

                    </div>
                        <div class="mb-3"><label for="username" class="form-label large fw-bold">Username</label>
                        <input type="text" name="username" id="username" maxlength="15" required  class="form-control fw-bold">

                    </div>
                        <div class="mb-3"><label for="password" class="form-label large fw-bold">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-2" required>

                    </div>
                        <div class="mb-5"><label for="confirm-password" class="form-label large fw-bold">Confirm Password</label><input type="password" name="confirm_password" id="confirm-password" class="form-control mb-2" required>
                    </div>
                    <button type="submit" name="btn_signup" class="btn btn-dark w-100" 
                    style="height: 60px; font-size: 20px; font-weight: bold; color: orange;
                    border: 2px solid black;">Submit</button>
                    <a href="http://localhost/GymSystem/login.php">
                    <h3 class="Register Btn" style="position: relative; font-size: 15px; color: white; left: 265px; top: 20px;">Back to Login Page</h3>
                    </a>
                    </form>
                </div>
            </div>            
        </div>     
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
