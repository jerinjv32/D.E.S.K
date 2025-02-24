<?php
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: login.php");
        exit();
    }
    include('sidebar.php');
    if(isset($_GET['course_management'])){
        header("Location:course_management.php");
        exit();
    }
    if(isset($_GET['staff_management'])){
        header("Location:faculty_management.php");
        exit();
    }
    if(isset($_GET['student_management'])){
        header("Location:student_management.php");
        exit();
    }
    if(isset($_GET['attendance'])){
        header("Location:attendance.php");
        exit();
    }
    if(isset($_GET['events'])){
        header('Location:events.php');
        exit();
    }
    if(isset($_GET['academic_assessment'])){
        header('Location:academic_assessment.php');
        exit();
    }
    session_write_close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DESK ADMIN PANEL</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost:5500/admin_panel_style.css">
</head>
<body>
    <div class="nav_bar">
        <h3 class="nav_content1">Dashboard</h3>
    </div>
    <main>
        <form action="admin_dashboard.php" method="GET">
            <div class="panels">
                <div class="panel_col1" style="grid-area:panel1;">
                    <button name="course_management">  
                        <img src="http://localhost:5500/icons/coure_management.png" class="icons" alt="course_management">
                    </button>
                    <figcaption class="panel_title" id="title1">Course Management</figcaption>
                </div>
                <div class="panel_col2" style="grid-area:panel2;">
                    <button name="staff_management">
                        <img src="http://localhost:5500/icons/staff_management.png" class="icons" alt="staff_management">
                    </button>
                    <figcaption class="panel_title" id="title2">Staff Management</figcaption>
                </div>
                <div class="panel_col3" style="grid-area:panel3;">
                    <button name="student_management">
                        <img src="http://localhost:5500/icons/student_management.png" class="icons" alt="student_management">
                    </button>
                    <figcaption class="panel_title" id="title3">Student Management</figcaption>
                </div>
                <div class="panel_col4" style="grid-area:panel4;">
                    <button name="attendance">
                        <img src="http://localhost:5500/icons/attendance.png" class="icons" alt="attendance">
                    </button>
                    <figcaption class="panel_title" id="title4">Attendance</figcaption>
                </div>
                <div class="panel_col5" style="grid-area:panel5;">
                    <button name="data_extractor">
                        <img src="http://localhost:5500/icons/data_extractor.png" class="icons" name="data_extractor">
                    </button>
                    <figcaption class="panel_title" id="title5">Data Extractor</figcaption>
                </div>
                <div class="panel_col6" style="grid-area:panel6;">
                    <button name="results">
                        <img src="http://localhost:5500/icons/results.png" class="icons" alt="results">
                    </button>
                    <figcaption class="panel_title" id="title6">Results</figcaption>
                </div>
                <div class="panel_col7" style="grid-area:panel7;">
                    <button name="academic_assessment">
                        <img src="http://localhost:5500/icons/academic.png" class="icons" alt="academic_assessment">
                    </button>
                    <figcaption class="panel_title" id="title7">Academic Assessment</figcaption>
                </div>
                <div class="panel_col8" >
                    <button name="remedial_class" style="grid-area:panel8;">
                        <img src="http://localhost:5500/icons/remedial_class.png" class="icons" alt="remedial_class">
                    </button>
                    <figcaption class="panel_title" id="title8">Remedial Class</figcaption>
                </div>
                <div class="panel_col9" style="grid-area:panel9;">
                    <button name="events">
                        <img src="http://localhost:5500/icons/event.png" class="icons" alt="events">
                    </button>
                    <figcaption class="panel_title" id="title9">Events</figcaption>
                </div>
            </div>
        </form>
    </main>
    <footer style="background-color:rgb(33,33,33);width:100%;height:53px;margin:40px 0 0 0;"></footer>
</body>
</html>