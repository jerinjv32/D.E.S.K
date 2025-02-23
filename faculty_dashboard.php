<?php
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'faculty') {
        header("Location: login.php");
        exit();
    }
    if(isset($_GET['my_profile'])){
        header("Location:profile.php");
        exit();
    }
    elseif(isset($_GET['attendance'])){
        header("Location:attendance.php");
        exit();
    }
    session_write_close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost:5500/staff_panel_style.css">
    <title>DESK STAFF PANEL</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Dashboard</h3>
    </div>
    <main>
        <form action="faculty_dashboard.php" method="GET">
            <div class="panels">
                <div class="panel_col1"  >
                    <button name="my_profile">
                        <img src="http://localhost:5500/icons/coure_management.png" class="icons" alt="my_profile">
                    </button>
                    <figcaption class="panel_title" alt="title1">My Profile</figcaption>
                </div>
                <div class="panel_col2" >
                    <button name="attendance">
                        <img src="http://localhost:5500/icons/attendance.png" class="icons" alt="attendance">
                    </button>
                        <figcaption class="panel_title" id="title4">Attendance</figcaption>
                </div>      
                <div class="panel_col3" >
                    <button name="results">
                        <img src="http://localhost:5500/icons/results.png" class="icons" alt="results">
                    </button>
                    <figcaption class="panel_title" id="title6">Results</figcaption>
                </div>
                <div class="panel_col4" >
                    <button name="academic_assessment">
                        <img src="http://localhost:5500/icons/academic.png" class="icons" alt="academic_assessment">
                    </button>
                    <figcaption class="panel_title" id="title7">Academic Assessment</figcaption>
                </div>
                <div class="panel_col5">
                    <button name="remedial class">
                        <img src="http://localhost:5500/icons/remedial_class.png" class="icons" alt="remedial class">
                    </button>
                    <figcaption class="panel_title" id="title8">Remedial Class</figcaption>
                </div>
                <div class="panel_col6">
                    <button name="data_extractor">
                        <img src="http://localhost:5500/icons/data_extractor.png" class="icons" alt="data_extractor">
                    </button>
                    <figcaption class="panel_title" id="title5">Data Extractor</figcaption>
                </div>
                <div class="panel_col7" >
                <button name="events">
                    <img src="http://localhost:5500/icons/event.png" class="icons" alt="events">
                </button>
                    <figcaption class="panel_title" id="title9">Events</figcaption>
                </div>
            </div>
        </form>
    </main>
</body>
</html>