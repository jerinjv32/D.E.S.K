<?php
    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: login.php");
        exit();
    }
    session_write_close();
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
    <div class="nav_bar">
        <h3 class="nav_content1">Dashboard</h3>
    </div>
    <main>
        <form>
            <div class="panels">
                <div class="panel_col1"  >
                    <input type="image" src="http://localhost:5500/icons/coure_management.png" class="icons" alt="course_management">
                    <figcaption class="panel_title" id="title1">Course Management</figcaption>
                </div>
                <div class="panel_col2" >
                    <input type="image" src="http://localhost:5500/icons/staff_management.png" class="icons" alt="staff_management">
                    <figcaption class="panel_title" id="title2">Staff Management</figcaption>
                </div>
                <div class="panel_col3" >
                    <input type="image" src="http://localhost:5500/icons/student_management.png" class="icons" alt="student_management">
                    <figcaption class="panel_title" id="title3">Student Management</figcaption>
                </div>
                <div class="panel_col4">
                    <input type="image" src="http://localhost:5500/icons/attendance.png" class="icons" alt="attendance">
                    <figcaption class="panel_title" id="title4">Attendance</figcaption>
                </div>
                <div class="panel_col5" >
                    <input type="image" src="http://localhost:5500/icons/data_extractor.png" class="icons" name="data_extractor">
                    <figcaption class="panel_title" id="title5">Data Extractor</figcaption>
                </div>
                <div class="panel_col6" >
                    <input type="image" src="http://localhost:5500/icons/results.png" class="icons" alt="results">
                    <figcaption class="panel_title" id="title6">Results</figcaption>
                </div>
                <div class="panel_col7" >
                    <input type="image" src="http://localhost:5500/icons/academic.png" class="icons" alt="academic_assessment">
                    <figcaption class="panel_title" id="title7">Academic Assessment</figcaption>
                </div>
                <div class="panel_col8" >
                    <input type="image" src="http://localhost:5500/icons/remedial_class.png" class="icons" alt="remedial_class">
                    <figcaption class="panel_title" id="title8">Remedial Class</figcaption>
                </div>
                <div class="panel_col9">
                    <input type="image" src="http://localhost:5500/icons/event.png" class="icons" alt="events">
                    <figcaption class="panel_title" id="title9">Events</figcaption>
                </div>
            </div>
        </form>
    </main>
</body>
</html>


