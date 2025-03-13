<?php
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: login.php");
        exit();
    }
    include('sidebar.php');
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
    <nav>
        <h3 class="nav_content1">Dashboard</h3>
    </nav>
    <main>
        <div class="panels">
            <div class="panel_col1" style="grid-area:panel1;" onclick="redirect('course_management.php')">
                <img src="http://localhost:5500/icons/coure_management.png" class="icons" alt="course_management">
                <figcaption class="panel_title" id="title1">Course Management</figcaption>
            </div>
            <div class="panel_col2" style="grid-area:panel2;" onclick="redirect('faculty_management.php')">
                <img src="http://localhost:5500/icons/staff_management.png" class="icons" alt="staff_management">
                <figcaption class="panel_title" id="title2">Staff Management</figcaption>
            </div>
            <div class="panel_col3" style="grid-area:panel3;" onclick="redirect('student_management.php')">
                <img src="http://localhost:5500/icons/student_management.png" class="icons" alt="student_management">
                <figcaption class="panel_title" id="title3">Student Management</figcaption>
            </div>
            <div class="panel_col4" style="grid-area:panel4;" onclick="redirect('attendance.php')">
                <img src="http://localhost:5500/icons/attendance.png" class="icons" alt="attendance">
                <figcaption class="panel_title" id="title4">Attendance</figcaption>
            </div>
            <div class="panel_col5" style="grid-area:panel5;">
                <img src="http://localhost:5500/icons/results.png" class="icons" alt="results">
                <figcaption class="panel_title" id="title6">Results</figcaption>
            </div>
            <div class="panel_col7" style="grid-area:panel6;" onclick="redirect('academic_assessment.php')">
                <img src="http://localhost:5500/icons/academic.png" class="icons" alt="academic_assessment">
                <figcaption class="panel_title" id="title7">Academic Assessment</figcaption>
            </div>
            <div class="panel_col8" style="grid-area:panel7;" onclick="redirect('remedial.php')">
                <img src="http://localhost:5500/icons/remedial_class.png" class="icons" alt="remedial_class">
                <figcaption class="panel_title" id="title8">Remedial Class</figcaption>
            </div>
            <div class="panel_col9" style="grid-area:panel8;" onclick="redirect('events.php')">
                <img src="http://localhost:5500/icons/event.png" class="icons" alt="events">
                <figcaption class="panel_title" id="title9">Events</figcaption>
            </div>
        </div>
    </main>
    <script src="includes/redirect.js"></script>
</body>
</html>