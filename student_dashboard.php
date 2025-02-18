<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="student_panel_style.css">
    <title>DESK STUDENT PANEL</title>
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
                <figcaption class="panel_title" id="title1">My Profile</figcaption>
            </div>
            <div class="panel_col2" >
                <img src="http://localhost:5500/icons/results.png" class="icons" id="panel_6">
                <figcaption class="panel_title" id="title6">Results</figcaption>
            </div>
            <div class="panel_col3" >
                <img src="http://localhost:5500/icons/academic.png" class="icons" id="panel_7">
                <figcaption class="panel_title" id="title7">Academic Assessment</figcaption>
            </div>
            <div class="panel_col4">
                <img src="http://localhost:5500/icons/remedial_class.png" class="icons" id="panel_8">
                <figcaption class="panel_title" id="title8">Remedial Class</figcaption>
            </div>
        </div>
    </main>
</body>
</html>