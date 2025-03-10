<?php 
session_start();
include('db.php');
$students = [];
$cname = htmlspecialchars($_GET['course_name'] ?? '',ENT_QUOTES,'UTF-8');
$database->pdo->beginTransaction();
try{
    $courses = $database->select("course","cname");
    $faculties = $database->select("faculty",["fname","college_id","cname"],["cname"=>$cname]);
    $database->pdo->commit();
} catch(PDOException $e) {
    file_put_contents("debugg.txt",date("Y-m-d H-i-s")."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    echo "some error occured";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Management</title>
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
            min-height: 500px;
            max-height: 100%;
            overflow: auto;
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
        #add_sub_btn{
            border-style:none;
            background-color:rgb(33, 33, 33);
            border-radius:3px;
            color:white;
        }
        #add_sub_btn:hover{
            background-color: #007F66;
            cursor: pointer;
        }
        .my_table th, .my_table td{
            min-width: 16.5vw;
        }
    </style>
    <link rel="stylesheet" href="http://localhost:5500/styles/table.css">
    <link rel="stylesheet" href="http://localhost:5500/styles/buttons.css">
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Faculty Management</h3>
    </div>
    <main>
        <form method="get">
            <label for="course_text" style="font-size: 14px;padding-right:10px;">Course Name:</label>
            <select name="course_name" required>
                <option>-->Choose</option>
                <?php 
                foreach ($courses as $course) {
                    echo "<option>".$course."</option>";
                }
                ?>
            </select><br><br>
            <input type="submit" value="Get Results" name="get_results" class="func_btn">
            <hr style="margin: 10px 10px 0 auto;">
        </form>
        <br><input type="submit" class="add_btn" value="+ Add new faculty" onclick="redirect('add_new_faculty.php')">
        <table class="my_table"style="margin-top:30px;">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>edit</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($faculties as $faculty) {
                        echo "<tr onclick=\"redirect('profile_faculty_dyn.php?id=".$faculty['college_id']."');\">";
                        echo "<td>".$faculty['college_id']."</td>";
                        echo "<td>".$faculty['fname']."</td>";
                        echo "<td>".$faculty['cname']."</td>";
                        echo "<td>";
                        echo "<form method='post' action='includes/remove_faculty.php'>";
                        echo "<input type='button' value='Edit' class='func_btn' onclick=\"event.stopPropagation();redirect('edit_faculty.php?id=".$faculty['college_id']."');\">";
                        echo "<input type='hidden' name='hid_college_id' value=\"".$faculty['college_id']."\">";
                        echo "<input type='submit' value='Remove' name='remove_btn' class='remove_btn' style=\"margin-left: 10px;\" onclick=\"event.stopPropagation();\">";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>
    </main>
    <script src="/includes/redirect.js"></script>
</body>
</html>