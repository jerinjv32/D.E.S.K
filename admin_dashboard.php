<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_panel_style.css">
    <title>DESK ADMIN PANEL</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Dashboard</h3>
    </div>
    <main>
        <div class="panels">
            <div class="panel_col1"  >
                <img src="http://localhost:5500/icons/coure_management.png" class="icons" id="panel_1">
                <figcaption class="panel_title" id="title1">Course Management</figcaption>
            </div>
            <div class="panel_col2" >
                <img src="http://localhost:5500/icons/staff_management.png" class="icons" id="panel_2">
                <figcaption class="panel_title" id="title2">Staff Management</figcaption>
            </div>
            
            <div class="panel_col3" >
                <img src="http://localhost:5500/icons/student_management.png" class="icons" id="panel_3">
                <figcaption class="panel_title" id="title3">Student Management</figcaption>
            </div>
            <div class="panel_col4">
                <img src="http://localhost:5500/icons/attendance.png" class="icons" id="panel_4">
                <figcaption class="panel_title" id="title4">Attendance</figcaption>
            </div>
            <div class="panel_col5" >
                <img src="http://localhost:5500/icons/data_extractor.png" class="icons" id="panel_5">
                <figcaption class="panel_title" id="title5">Data Extractor</figcaption>
            </div>
            <div class="panel_col6" >
                <img src="http://localhost:5500/icons/results.png" class="icons" id="panel_6">
                <figcaption class="panel_title" id="title6">Results</figcaption>
            </div>
            <div class="panel_col7" >
                <img src="http://localhost:5500/icons/academic.png" class="icons" id="panel_7">
                <figcaption class="panel_title" id="title7">Academic Assessment</figcaption>
            </div>
            <div class="panel_col8" >
                <img src="http://localhost:5500/icons/remedial_class.png" class="icons" id="panel_8">
                <figcaption class="panel_title" id="title8">Remedial Class</figcaption>
            </div>
            <div class="panel_col9">
                <img src="http://localhost:5500/icons/event.png" class="icons" id="panel_9">
                <figcaption class="panel_title" id="title9">Events</figcaption>
            </div>
        </div>
    </main>
</body>
</html>


