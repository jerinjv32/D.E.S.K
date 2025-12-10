<?php 
session_start();
include('db.php');
$subjects = [];
$remedial = [];
//get Subjects and course
try {
    $courses = $database->select("course","*");
    $sem = filter_var(htmlspecialchars($_GET['semester']??'',ENT_QUOTES,'UTF-8'),FILTER_VALIDATE_INT);
    $cid = htmlspecialchars($_GET['course_name']??'', ENT_QUOTES,'UTF-8');
} catch(PDOException $e) {
    file_put_contents("debugg.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    echo "Something went wrong,Try again later";
}
try {
    if(isset($_GET['show_result'])){
        $remedials = $database->select("student",["[>]remedial"=>["college_id"=>"college_id"]],
        ["student.sname","remedial.subject_id","student.cname","remedial.college_id","remedial.semester"],
        ["remedial.course_id"=>$cid]);
    };
}catch(PDOException $e) {
    file_put_contents("debugg.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    echo "Something went wrong,Try again later";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remedial</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/table.css">
    <link rel="stylesheet" href="/styles/buttons.css">
    <script src="/includes/fileUpload.js"></script>
    <style>
        *{
            margin: 0px;
            font-family: poppins;
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
        .my_table th, .my_table td{
            width: 14vw;
        }
    </style>
    
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Remedial Class</h3>
    </div>
    <main>
        <form method="get" action="remedial.php"> 
            <label for="course_text" style="font-size: 14px;padding-right:10px;">Course:</label>
            <select name="course_name" style="width: 175;height:25px;" required>
                <option value="" disabled selected>Choose-></option>
                <?php foreach ($courses as $cname): ?>
                    <option value=<?= $cname['course_id'] ?>><?= $cname['cname']; ?></option>;
                <?php endforeach ?>
            </select><br><br>
            <!-- <label for="semester_text" style="font-size: 14px;padding: 2px 2px 0 14px;">Semester:</label>
            <select name="sem" style="width: 175px;height:25px;" required>
                <option value="" disabled selected>choose-></option>
                <?php for($i=1;$i<=8;$i+=1): ?>
                    <option><?=$i?></option>
                <?php endfor ?>
            </select><br><br> -->
            <input type="submit" value="Show Result" name="show_result" class="func_btn">
        </form>
            <hr style="margin: 10px 10px 0 auto;">
            <?php if (isset($_GET['show_result'])): ?>
            <table class="my_table"style="margin-top:50px;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>College Id</th>
                        <th>Course Name</th>
                        <th>Semester</th>
                        <th>Subject Code</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($remedials)): ?>
                        <?php foreach($remedials as $remedial):?>
                        <tr>
                            <td><?= $remedial['sname'] ?></td>
                            <td><?= $remedial['college_id'] ?></td>
                            <td><?= $remedial['cname'] ?></td>
                            <td><?= $remedial['semester'] ?></td>
                            <td><?= $remedial['subject_id'] ?></td>
                        </tr>
                        <?php endforeach ?>
                </tbody>
                    <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;font-weight:bold;">No Results</td>
                    </tr>
                    <?php endif ?>
            </table>
            <?php endif; ?>
    </main>
</body>
</html>