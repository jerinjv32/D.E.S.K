<?php
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
        header("Location: login.php");
        exit();
    }
    if(isset($_GET['my_profile'])){
        header('Location:profile_students.php');
        exit();
    }
    if(isset($_GET['academic_assessment'])){
        header('Location:academic_assessment_student.php');
        exit();
    }
    if(isset($_GET['results'])){
        header('Location:result_student.php');
        exit();
    }
    if(isset($_GET['remedial_class'])){
        header('Location:remedial.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost:5500/student_panel_style.css">
    <title>DESK STUDENT PANEL</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include('sidebar.php') ?>
    <nav>
        <h3 class="nav_content1">Dashboard</h3>
    </nav>
    <main>
        <form action="student_dashboard.php" method="GET">
            <div class="panels">
                <div class="panel_col1"  >
                    <button name="my_profile">
                        <img src="http://localhost:5500/icons/coure_management.png" class="icons" alt="my_profile">
                        <figcaption class="panel_title" id="title1">My Profile</figcaption>
                    </button>
                </div>
                <div class="panel_col2" >
                    <button name="results">
                        <img src="http://localhost:5500/icons/results.png" class="icons" alt="results">
                        <figcaption class="panel_title" id="title6">Results</figcaption>
                    </button>
                </div>
                <div class="panel_col3">
                    <button name="academic_assessment">
                        <img src="http://localhost:5500/icons/academic.png" class="icons" alt="academic_assessment">
                        <figcaption class="panel_title" id="title7">Academic Assessment</figcaption>
                    </button>
                </div>
                <div class="panel_col4">
                    <button name="remedial_class">
                        <img src="http://localhost:5500/icons/remedial_class.png" class="icons" alt="remedial_class">
                        <figcaption class="panel_title" id="title8">Remedial Class</figcaption>
                    </button>
                </div>
            </div>
        </form>
    </main>
</body>
</html>