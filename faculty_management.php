<?php 
session_start();
include('db.php');
$students = [];
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $course = htmlspecialchars($_GET['course_name'] ?? '',ENT_QUOTES,'UTF-8');
}
try{
    $faculties = $database->select("faculty",["fname","college_id","cname"],["cname"=>$course]);
    if (empty($faculties) && isset($_POST['get_results'])) {
        $error_msg = "Result not found";
    } else {
        $error_msg = "";
    }
} catch(Exception $e) {
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
        .my_table{
            border-collapse: collapse;
            font-size: 0.9em;
            margin: 25px 0;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 5px 5px rgba(0,0,0,0.15);
        }
        .my_table thead tr{
            background-color: rgb(33, 33, 33);
            color: #ffffff;
            font-weight: bold;
        }
        .my_table th, .my_table td{
            padding: 15px 15px;
            min-width: 214px;
            border-bottom: solid #dddddd;
        }
        .my_table tbody tr{
            text-align: center;
            background-color:rgb(236, 236, 236);
        }
        .my_table tbody tr:nth-child(even){
            background-color: white;
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
    </style>
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Faculty Management</h3>
    </div>
    <main>
        <form method="get">
            <label for="course_text" style="font-size: 14px;padding-right:10px;">Course Name:</label>
            <input type="text" name="course_name" id="course_text" required><br><br>
            <input type="submit" value="Get Results" id="get_results" name="get_results">
            <hr style="margin: 10px 10px 0 auto;">
        </form>
        <br><button type="button" value="add_sub" id="add_sub_btn" onclick="redirect('add_new_faculty.php')">+ Add new faculty</button>
        <div><?php echo $error_msg; ?></div>
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
                        echo "<tr>";
                        echo "<td>".$faculty['college_id']."</td>";
                        echo "<td>".$faculty['fname']."</td>";
                        echo "<td>".$faculty['cname']."</td>";
                        echo "<td>";
                        echo "<form method='post'>";
                        echo "<button type='submit' name='edit' id='edit_btn'>Edit</button>";
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