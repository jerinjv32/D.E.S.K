<?php 
session_start();
include('db.php');
$subjects = [];
//get Subjects and course
try {
    $courses = $database->select("course","*");
    if(isset($_GET['display'])){
        $cid = htmlspecialchars($_GET['course_name']??'', ENT_QUOTES,'UTF-8');
        $subjects = $database->select("subjects","*",['course_id'=>$cid]);
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
        main{
            height: 100px;
            border: 1px black solid;  
            margin: 20px 20px 20px 228px;
            border-radius: 5px;
            padding:20px 10px 0 20px;
            box-shadow: 0 5px 5px rgba(0,0,0,0.25);
            min-height: 75vh;
            max-height: 100%;
            overflow: auto;
        }
    </style>
    <link rel="stylesheet" href="http://localhost:5500/styles/course_management.css">
    <link rel="stylesheet" href="http://localhost:5500/styles/table.css">
    <link rel="stylesheet" href="http://localhost:5500/styles/buttons.css">
    <script src="/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src='includes/alert.js'></script>
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Course Management</h3>
    </div>
    <main>
        <form method="get">
            <label for="course_text" style="font-size: 14px;padding-right:30px;">Course:</label>
            <select name="course_name" style="padding-right:5px;height:26px;width:175px;" required>
                <option>Choose--></option>
                <?php foreach($courses as $course): ?>
                    <option value='<?= $course['course_id'] ?>'> <?= $course['cname'] ?> </option>
                    <?php endforeach ?>
                </select>
                <br><br>
                <label for="semester_text" style="font-size: 14px;padding-right:14px;padding-top:2px">Semester:</label>
                <select type="number" name="semester" style="width:175px;">
                    <?php for ($i = 1; $i <= 8; $i+=1 ): ?>
                        <option value="<?= $i ?>"><?= $i ?></option> 
                        <?php endfor ?>
                    </select>
                    <div class="container">
                        <div class="flex_items" onclick="redirect('add_course.php')">
                            <img src="http://localhost:5500/icons/add_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="add_course" class="course-btn" id="cbtn1">
                            <figcaption class="icon_title" id="title1">Add Course</figcaption>
                        </div>
                        <div class="flex_items" onclick="redirect('remove_course.php');">
                            <img src="http://localhost:5500/icons/delete_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="delete_course" class="course-btn" id="cbtn3">
                            <figcaption class="icon_title" id="title1">Remove</figcaption>
                        </div>
                    </div>
            <input type="submit" id="display" name="display" value="Results" class="func_btn">
        </form>
 
        <form method="get">
            <hr style="margin: 10px 10px 0 auto;">
            <br><input type="submit" class="button_add" name="add_sub" value="+ Add new subjects"><br><br>
        </form>
        <?php if (isset($_GET['add_sub']) || isset($_POST['add_sub'])): ?> 
        <form action="includes/add_sub.php" method="post">
            <label style="padding-right: 12px;">Select Course: </label>
            <select name="course_name" style="padding-right:5px;height:26px;width:175px;">
                <option>Choose--></option>
                <?php foreach($courses as $course) {
                    echo '<option value="'.$course['course_id'].'">'.$course['cname'].'</option>';
                } 
                ?>
            </select>
            <!-- Adding subjects -->
            <label style="padding-right: 7px;">Subject Name:</label>
            <input type="text" autocomplete="off" name="new_sub" placeholder="Enter Subject Name" required>
            
            <label style="padding-right: 12px;">Subject Code: </label>
            <input type="text" autocomplete="off" name="new_sub_code" placeholder="Enter Subject Code" required><br><br>
            
            <label for="semester_text" style="padding-right:45px;padding-top:2px">Semester:</label>
            <select name="sub_sem" style="width:175px;" required>
            <?php for ($i = 1; $i <= 8; $i+=1 ): ?>
                 <option value="<?= $i ?>"><?= $i ?></option> 
            <?php endfor ?>
            </select><br><br>

            <input type="submit" name="add_sub" class="button_add" value="Add">
        </form>
        <?php endif ?>
        <?php if (isset($_GET['display'])): ?>
        <table>
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
                <?php if (!empty($subjects)): ?>
                    <?php foreach($subjects as $sub): ?>
                            <tr>
                                <td><?= $sub['subject_id'] ?></td>
                                <td><?= $sub['subject_name'] ?></td>
                                <td><?= $sub['semester'] ?></td>
                                <td>
                                    <form method='POST' action='includes/remove_subject.php'>
                                        <input type="hidden" value='<?= $sub['subject_id'] ?>' name="subject_id">
                                        <input type="hidden" value='<?= $sub['course_id'] ?>' name="course_id">
                                        <input type='submit' value="Remove" name='remove_btn' class='remove_btn'>
                                    </form>
                                </td>
                            </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center;font-weight:bold;">No Results</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
        <?php endif ?>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let search = new URLSearchParams(window.location.search);
            let code = Number(search.get('check'));
            switch(code) {
                case 100:
                    showAlert('Done','Subject Is Added','success');
                    break;
                case -100:
                    showAlert('Failed','Subject Code Already Exists','error');
                    break;
                case 101:
                    showAlert('Removed','Subject Is Removed','success');
                    break;
            }
        })
    </script>
    <script src="/includes/redirect.js"></script>
</body>
</html>