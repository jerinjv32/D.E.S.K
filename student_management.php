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
    </style>
    <link rel="stylesheet" href="http://localhost:5500/styles/buttons.css">
    <link rel="stylesheet" href="http://localhost:5500/styles/table.css">
    <link rel="stylesheet" href="http://localhost:5500/styles/student_management.css">
    <script src="includes/redirect.js"></script>
    <script src="includes/fileUpload.js"></script>
    <script src='node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
    <script src='includes/alert.js'></script>
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Student Management</h3>
    </div>
    <main>
        <form method="GET">
            <label for="course_text" style="font-size: 14px;padding-right:30px;">Course:</label>
            <select name="course_name" id="course_text" style="width:175px;" required>
                <option>Choose--></option>
                <?php
                foreach ($cnames as $cname) {
                    echo "<option>".$cname."</option>";
                }
                ?>
            </select><br><br>
            <label for="semester_text" style="font-size: 14px;padding-right:14px;padding-top:2px">Semester:</label>
            <select name="semester" style="width:175px;">
                <?php for ($i=1; $i <= 8; $i+=1): ?>
                <option><?= $i ?></option>
                <?php endfor ?>
            </select>
            <br><br><input type="submit" value="Search" name="search_btn" class="func_btn">
            <hr style="margin: 10px 10px 0 auto;">
        </form><br>
        <div class='flex-container'>
            <form action="add_new_students.php" method="GET" class='flex-items'>
                <br><button type="submit" name="add_stud" value="add_sub" class="add_btn">+ Add new student</button>
            </form>
            <form method="POST" action="includes/upload_students.php" enctype="multipart/form-data" id="upload_form">
                <button type="button" name="upload_file" class="add_btn" title="Upload SpreadSheet" style="display:flex;justify-content: center;align-items:center;" onclick="fileUpload();">
                    <img src="icons\upload_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg">Upload</button>
                <input type="file" name="file" id="file_upload" title="Upload Spreadsheet" required>
                <button type="submit" id="submit_btn" style="display: none;">button</button>
            </form>
        </div>
        <?php if(isset($_GET['search_btn'])): ?>
        <table class="my_table"style="margin-top:30px;">
            <thead>
                <tr>
                    <th>College Id</th>
                    <th>Course</th>
                    <th>Name</th>
                    <th>Semester</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($students)): ?>
                    <?php foreach($students as $student): ?>
                        <tr onclick="redirect('profile_students_dyn.php?id=<?=$student['college_id']?>');" >
                            <td><?=$student['college_id']?></td>
                            <td><?=$student['cname']?></td>
                            <td><?=$student['sname']?></td>
                            <td><?=$student['semester']?></td>
                            <td>
                                <form method='post' action='includes/remove_student.php' id="remove_form">
                                    <input type='button' value='Edit' class='edit_btn' onclick="event.stopPropagation();redirect(`edit_students.php?id=<?= $student['college_id']?>`);">
                                    <input type='hidden' name='hid_college_id' value="<?=$student['college_id']?>">
                                    <input type='submit' value='Remove' name='remove_btn' class='remove_btn' style="margin-left: 2px;" onclick="event.stopPropagation();">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center; font-weight:bold;">No Results</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
        <?php endif ?>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let search = new URLSearchParams(window.location.search);
            let check = Number(search.get('check'));
            switch (check) {
                case 100:
                    showAlert('Done','Uploaded Successfully','success');
                    break;
                case 101:
                    showAlert('Failed','Upload Failed','error');
                    break;
                case 200:
                    showAlert('Loading Failed','Couldn\'t Load the file','error');
                    break;
                case 201:
                    showAlert('Wrong File Type','File Type is Not supported','error');
                    break;
                case 23000:
                    showAlert('Failed','Student Data Already Exists','error');
                    break;
                case 300:
                    showAlert('Done','Removed Successfully','success');
                    break;
            }
        });
    </script>
    
</body>
</html>