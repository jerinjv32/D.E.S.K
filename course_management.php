<?php 
session_start();
include('db.php');
$subjects = [];
try {
    $courses = $database->select("course","*");
    if(isset($_GET['display'])){
        $subjects = $database->select("subjects","*");
    }
} catch(PDOException $e) {
    file_put_contents("debugg.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    echo "Something went wrong,Try again later";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management</title>
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
            height: 100px;
            border: 1px black solid;  
            margin: 20px 20px 20px 228px;
            border-radius: 5px;
            padding:20px 10px 0 20px;
            box-shadow: 0 5px 5px rgba(0,0,0,0.25);
            min-height: 600px;
            max-height: 100%;
            overflow: auto;
        }
        .container{
            position: relative;
            display: flex;
            bottom: 67px;
            gap: 4em;
            margin: 2px auto 0 300px;
        }
        .course-btn{
            transition:transform 0.25s ease-in-out;
            transform: scale(1.5);
            padding: 9px;
            background-color: rgb(33, 33, 33);
            border-radius: 3px;
        }
        .course-btn:hover{
            transform: scale(1.55);
            box-shadow: 0 0 5px rgba(0,0,0,0.5);
            cursor: pointer;
        }
        .btn-text {
            display: block;
            font-size: 15px;
            font-weight: bold;
            color: #333;
            transform: translate(-15px,10px);
        }
        #cbtn1:hover{
            background-color: #009879;
        }
        #cbtn2:hover{
            transform: scale(1.6);
            box-shadow: 0 0 5px rgba(0,0,0,0.5);
            background-color: #0073e6;
        }
        #cbtn3:hover{
            background-color: #e6002e;
        }
        #remove_btn{
            border-style:none;
            background-color:rgb(33, 33, 33);
            border-radius:3px;
            color:white;
        }
        #remove_btn:hover{
            background-color:#e6002e;
            cursor: pointer;
        }
        .button_add{
            border-style:none;
            background-color:rgb(33, 33, 33);
            border-radius:3px;
            color:white;
            transition:transform 0.25s ease-in-out;
        }
        .button_add:hover{
            transform: scale(1.05);
            background-color: #007F66;
            cursor: pointer;
        }
        .icon_title{
            padding-top: 4px;
            font-size: 0.7em;
            text-align: center;
            font-weight: bold;
        }
        .flex_items {
            justify-items: center;
        }
        .my_table th,.my_table td{
            min-width: 16.5vw;
        }
    </style>
    <link rel="stylesheet" href="http://localhost:5500/styles/table.css">
    <link rel="stylesheet" href="http://localhost:5500/styles/buttons.css">
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Course Management</h3>
    </div>
    <main>
        <label for="course_text" style="font-size: 14px;padding-right:30px;">Course:</label>
        <select name="course_name" id="course_text" style="padding-right:5px;height:26px;">
            <option>Choose--></option>
            <?php foreach($courses as $course) {
                echo "<option>".$course['cname']."</option>";
            } 
            ?>
        </select>
        <br><br>
        <label for="semester_text" style="font-size: 14px;padding-right:14px;padding-top:2px">Semester:</label>
        <input type="number" name="semester" id="semester_text" oninput="notBelowOne(this);">
        <div class="container">
            <div class="flex_items" onclick="redirect('add_course.php')">
                <img src="http://localhost:5500/icons/add_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="add_course" class="course-btn" id="cbtn1">
                <figcaption class="icon_title" id="title1">Add Course</figcaption>
            </div>
            <div class="flex_items">
                <img src="http://localhost:5500/icons/edit_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="edit_course" class="course-btn" id="cbtn2">
                <figcaption class="icon_title" id="title1">Edit Course</figcaption>
            </div>
            <div class="flex_items" onclick="redirect('remove_course.php');">
                <img src="http://localhost:5500/icons/delete_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="delete_course" class="course-btn" id="cbtn3">
                <figcaption class="icon_title" id="title1">Remove</figcaption>
            </div>
        </div>
        <form method="get">
            <input type="submit" id="display" name="display" value="Results" class="func_btn_medium">
        </form>
        <hr style="margin: 10px 10px 0 auto;">
        <br><button type="button" value="add_sub" id="add_sub_btn" class="button_add">+ Add new subjects</button><br><br>
        
        <form action="includes/add_sub.php" method="post">
            <label style="padding-right: 12px;">Select Course: </label>
            <select name="course_name" style="padding-right:5px;height:26px;">
                <option>Choose--></option>
                <?php foreach($courses as $course) {
                    echo '<option value="'.$course['course_id'].'">'.$course['cname'].'</option>';
                } 
                ?>
            </select>
            
            <label style="padding-right: 7px;">Subject Name:</label>
            <input type="text" name="new_sub" placeholder="Enter Subject Name" required>
            
            
            <label style="padding-right: 12px;">Subject Code: </label>
            <input type="text" name="new_sub_code" placeholder="Enter Subject Code" required><br><br>
            
            <label for="semester_text" style="padding-right:45px;padding-top:2px">Semester:</label>
            <input type="number" name="sub_sem" oninput="notBelowOne(this);" required><br><br>

            <input type="submit" name="add_sub" class="button_add" value="Add">
        </form>
            
            <table class="my_table"style="margin-top:30px;">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Semester</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            <tbody>
                <?php 
                    foreach($subjects as $sub) {
                        echo "<tr>";
                        echo "<td>".$sub['subject_id']."</td>";
                        echo "<td>".$sub['subject_name']."</td>";
                        echo "<td>".$sub['semester']."</td>";
                        echo "<td>";
                        echo "<form method='post'>";
                        echo "<input type='submit' name='edit' value='Edit' class='func_btn'>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>
    </main>
    <script src="/includes/not_below_1.js"></script>
    <script src="/includes/redirect.js"></script>
</body>
</html>