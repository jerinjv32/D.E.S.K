<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: poppins;
            margin:0px;
        }
        .nav_bar{
            height: 53px;
            width: 100%;
            background-color: rgb(33, 33, 33);
        }
        .nav_content1{
            display: block;
            padding-left: 225px;
            padding-top: 12px;
            font-size: larger;
            color: white;
        }
        main{
            border: 1px black solid;  
            margin: 20px 20px 20px 228px;
            border-radius: 5px;
            padding:20px 10px 0 20px;
            box-shadow: 0 5px 5px rgba(0,0,0,0.25);
            min-height: 400px;
            max-height: 100%;
            overflow: auto;
        }
        #search_btn{
            border: none;background-color:rgb(33, 33, 33);border-radius:3px;color:white;font-size:large;cursor:pointer;
            transition: transform 0.25s ease-in-out;
        }
        #search_btn:hover{  
            box-shadow: 0 0 rgba(0,0,0,0.25);
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Search</h3>
    </div>
    <main>
        <form>
            <div style="font-size: small;">
                <label for="name_box" style="padding-right: 51px;">Name:</label>
                <input type="text" name="name" id="name_box" placeholder="Enter name"><br><br>
                <label for="course_box" style="padding-right: 44px;">Course:</label>
                <input type="text" name="course" id="course_box" placeholder="Enter course"><br><br>
                <label for="semester_box" style="padding-right: 28px;">Semester:</label>
                <input type="number" name="semester" id="semester_box" placeholder="Choose Semester"><br><br>
                <label for="college_id_box" style="padding-right: 25px;">College id:</label>
                <input type="text" name="college_id" id="college_id_box" placeholder="Enter college id"><br><br>
                <label for="adm_box" style="padding-right: 1px;">Admission No:</label>
                <input type="number" name="admission_no" id="adm_box" placeholder="Enter admission No"><br><br>
                
                <input type="submit" value="Search" name="search_btn" id="search_btn">
            </div>
        </form>
    </main>
</body>
</html>