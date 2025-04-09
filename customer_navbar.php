<style>
    body{
      overflow-y: hidden; /* Removes vertical scroll */
            margin: 0;
            padding: 0;
    }
    </style>
<nav class="navbar" rel="stylesheet" style="bottom: 17px; width: 20%; height: 1000px; background-color:rgb(31, 36, 36)">
        <div class="container" style= "position: absolute; top: 3px;">
        <!--Brand -->
        <a href="" class="navbar-brand">
                <h1 class="card-title text-center mb-0"
                style="position: absolute;
                top: 25px;
                left: 40px; 
                font-weight: bold;">Gym</h1>

                <div class="card header text-primary" 
                style="position: absolute;
                 left: 130px; 
                 width: 100px; 
                 top: 15px; 
                 background-color: orange;">  
                <h1 class="card-title text-center mb-0 " 
                style="font-weight: bold; 
                color: black;">Hub</h1>


        </a>
        </div>
        <div class="container d-flex flex-column" style="position: absolute; top: 150px;">
        <!-- As a link -->
        <nav class="navbar">
            <div class="container-fluid" style="margin-bottom: 10px">
                <a href="http://localhost/GymSystem/index.php" style="text-decoration: none; color: orange;">Dashboard</a>
            </div>
        </nav>

        <nav class="navbar">
            <div class="container-fluid" style="margin-bottom: 10px">
                <a href="http://localhost/GymSystem/employeeAttendance.php" style="text-decoration: none; color: orange;">Employee Attendance</a>
            </div>
        </nav>

        <!-- As a heading -->
        <nav class="navbar">
            <div class="container-fluid" style="margin-bottom: 10px">
                <a href="http://localhost/GymSystem/member.php" style="text-decoration: none; color: orange;">Manage Member</a>
            </div>
        </nav>

         <!-- As a heading -->
         <nav class="navbar">
            <div class="container-fluid" style="margin-bottom: 10px">
                <a href="http://localhost/GymSystem/equipment.php" style="text-decoration: none; color: orange;">Equipment</a>
            </div>
        </nav>
        <form action="logout.php" method="post" id="logoutForm" style="display: none;">
        </form>
    <button type="submit" class="btn btn-danger fw-bold fs-6 py-4 w-100" onclick="document.getElementById('logoutForm').submit(); " 
    style="position: absolute; width: 50px; height: 90px; right: 12px; top: 470px; border-top: 5px solid black;">
        Log Out
    </button>
        </div>
    </nav>