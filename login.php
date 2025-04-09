<?php
require "conn.php";

function login($username, $password){
    $conn = connection();
    $sql = "SELECT username,password FROM users WHERE username = '$username' ";
    

    if($result = $conn->query($sql)){
        if($result->num_rows == 1){
            $user = $result ->fetch_assoc();
           

            if(password_verify($password, $user["password"])){

                session_start();

                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['first_name'] . ' '. $user['last_name'];

                
                header('location: index.php');
                exit;
            }else{
                echo '<div class="alert alert-danger">Incorrect password.</div>';  
            }
            }else{
                echo '<div class="alert alert-danger"> Username not found </div>';
        }
    }else{
        die("Error retrieving the user: . $conn -> error ");
}
}



if(isset($_POST["btn_login"]))
{ 
    $username =$_POST['username'];
    $password =$_POST['password'];

    login( $username, $password);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Log in</title>
</head>
<style>
    body{
      overflow-y: hidden; /* Removes vertical scroll */
            margin: 0;
            padding: 0;
    }
    </style>
<body>
<body class="bg-black">
    <div style="height: 150vh;">
        <div class="row h-50 m-5">
            <div class="card text-bg-dark mb-3" style="max-width: 50%; height: 500px; margin: auto; padding: 10;">
                
            
                <h1 class="card-title text-center mb-0" style="position: absolute; top: 20px; left: 250px; font-weight: bold;">Gym</h1>
                <div class="card header text-primary" style="position: absolute; left: 340px; width: 100px; margin-top: 20px; background-color: orange;">  
                <h1 class="card-title text-center mb-0 " style="font-weight: bold; color: black;">Hub</h1>
                </div>
                <h3 style="position: absolute; font-size: 20px; top: 65px; left: 220px;">Gym Management System</h3>

                <div class="card-body" style="margin-top: 90px;">
                <hr>
                    <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label large fw-bold" style="margin-top: 40px">Username</label>
                        <input type="text" name="username" id="username" maxlength="15" required  class="form-control fw-bold">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label large fw-bold">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-2" required>
                    </div>
                    <button type="submit" name="btn_login" class="btn btn-dark w-100" 
                    style="height: 60px; font-size: 20px; font-weight: bold; color: orange;
                    border: 2px solid black; margin-top: 20px">Log-in</button>
                    <a href="http://localhost/GymSystem/register.php">
                    <h3 class="Register Btn" style="position: relative; font-size: 15px; color: white; left: 257px; top: 10px;">Register Here</h3>
                    </a>
                    </form>
                </div>
            </div>            
        </div>     
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>