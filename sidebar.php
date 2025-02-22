<?php
    @session_start(); // Warning? What warning? 😎
    $role = $_SESSION['role'];
    if(isset($_POST["dash_icon"])){
        if($_SESSION['role'] === "admin"){
            header('Location:admin_dashboard.php');   
        }
        else if($_SESSION['role'] === "faculty"){
            header('Location:faculty_dashboard.php');   
        }    
        else if($_SESSION['role'] === "student"){
            header('Location:student_dashboard.php');   
        }  
    }
    if ($_SESSION['role'] !== "student"){
        $height_notifi = '363px';
        $height_logout = '418px';
    }
    else {
        $height_notifi = '307px'; 
        $height_logout = '363px';
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        .sidebar{
            position: fixed;
            background-color: rgb(23, 23, 23);   
            height: 100%;
            width: 208px;
        }
        .profile_pic{
            display: block;
            border-radius: 50%;
            height: 10em;
            margin-top: 2em;
            margin-left: 26px;
        }
        .item1{
            text-align: center;
            padding-top: 14px;
            color: white;
            font-weight: bold;
            font-size: large;
        }
        .content{
            font-weight: bold;
            color: white;
            font-size: 17px;
            border-style: none;
            padding-top: 23.5px;
            margin: 2px;
            padding-left: 70px;
            position: relative;
            background: none;
        }
        .content:hover{
            text-decoration: underline;
            cursor: pointer;
        }
        .sidebar_icons{
            height: 33px;
            width: auto;
        }
        #dashboard_icon{
            position: absolute;
            top: 254px;
            left: 30px;
        }
        #search_icon{
            position: absolute;
            top: 307px;
            left: 30px; 
        }
        #noti_icon{
            position: absolute;
            top: <?php echo $height_notifi ?>;
            left: 30px;
        }
        #logout_icon{
            position: absolute;
            top: <?php echo $height_logout ?>;
            left: 31px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
            <div class="item1"><?php echo strtoupper($role); ?></div>
            <img src="images/school-building-illustration_138676-2399.jpg" class="profile_pic">
            <form method="post" action="sidebar.php">
                <input type="submit" value="Dashboard" name="dash_icon" class="content" id="line1"><br>
                <?php if($_SESSION['role'] != "student"){ ?>
                    <input type="submit" value="Search" class="content" id="line2"><br>
                <?php } ?>
                <input type="submit" value="Notification" class="content" id="line3"><br>
                <input type="submit" value="Logout" name="logout_btn" class="content" id="line4">
            </form>
            <div class="sidebar_icons">
                <img src="http://localhost:5500/icons/apps_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" class="sidebar_icons" id="dashboard_icon">
                <?php if($role !== "student"){ ?>
                    <img src="http://localhost:5500/icons/search_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" class="sidebar_icons" id="search_icon">
                <?php } ?>
                <img src="http://localhost:5500/icons/notifications_active_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" class="sidebar_icons" id="noti_icon">
                <img src="http://localhost:5500/icons/logout_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" class="sidebar_icons" id="logout_icon">
            </div>
        </div>
</body>
</html>
<?php 
    if(isset($_POST['logout_btn'])){
        session_destroy();
        header("Location:login.php");
        exit();
    }
?>