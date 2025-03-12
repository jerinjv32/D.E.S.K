<?php 
session_start();
include('db.php');
if(isset($_GET['add_stud'])){
    header('Location:add_new_student.php');
    exit();
}
$students = [];
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $course = htmlspecialchars($_GET['course_name'] ?? '',ENT_QUOTES,'UTF-8');
    $semester = filter_var($_GET['semester'] ??'',FILTER_VALIDATE_INT);
    
}
try{
    $cnames = $database->select("course","cname");
    $students = $database->select("student",["sname","college_id","cname","semester"],["cname"=>$course,"semester"=>$semester]);
    if (empty($students) && isset($_POST['get_results'])) {
        $error_msg = "Result not found";
    } else {
        $error_msg = "";
    }
    } catch(Exception $e) {
    file_put_contents("debugg.txt",date("Y-m-d H-i-s")."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    echo "some error";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: Poppins;
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
            min-height: 500px;
            max-height: 100%;
            overflow: auto;
        }
        #add_stud_btn{
            border-style:none;
            background-color:rgb(33, 33, 33);
            border-radius:3px;
            color:white;
            transition: background-color 0.25s linear;
        }
        #add_stud_btn:hover{
            background-color: #2E8B57;
            cursor: pointer;
        }
        .my_table th,.my_table td{
            min-width: 12.8vw;
        }
    </style>
    <link rel="stylesheet" href="http://localhost:5500/styles/buttons.css">
    <link rel="stylesheet" href="http://localhost:5500/styles/table.css">
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Student Management</h3>
    </div>
    <main>
        <form method="GET">
            <label for="course_text" style="font-size: 14px;padding-right:30px;">Course:</label>
            <select name="course_name" id="course_text"  required>
                <option>Choose--></option>
                <?php
                foreach ($cnames as $cname) {
                    echo "<option>".$cname."</option>";
                }
                ?>
            </select><br><br>
            <label for="semester_text" style="font-size: 14px;padding-right:14px;padding-top:2px">Semester:</label>
            <input type="number" name="semester" id="semester_text" oninput="notBelowOne(this)" required>
            <br><br><input type="submit" value="Search" class="func_btn">
            <hr style="margin: 10px 10px 0 auto;">
        </form>
        <form action="add_new_students.php" method="GET">
            <br><button type="submit" name="add_stud" value="add_sub" id="add_stud_btn">+ Add new student</button>
        </form>
        <table class="my_table"style="margin-top:30px;">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Semester</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                    <?php 
                    foreach($students as $student) {
                        echo "<tr onclick=\"redirect('profile_students_dyn.php?id=".$student['college_id']."');\">";
                        echo "<td>".$student['college_id']."</td>";
                        echo "<td>".$student['sname']."</td>";
                        echo "<td>".$student['cname']."</td>";
                        echo "<td>".$student['semester']."</td>";
                        echo "<td>";
                        echo "<form method='post' action='includes/remove_student.php'>";
                        echo "<input type='button' value='Edit' class='func_btn' onclick=\"event.stopPropagation();redirect('edit_students.php?id=".$student['college_id']."');\">";
                        echo "<input type='hidden' name='hid_college_id' value=\"".$student['college_id']."\">";
                        echo "<input type='submit' value='Remove' name='remove_btn' class='remove_btn' style=\"margin-left: 10px;\" onclick=\"event.stopPropagation();\">";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>
    </main>
    <script src="includes/redirect.js"></script>
    <script src="includes/not_below_1.js"></script>
</body>
</html>