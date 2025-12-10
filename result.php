<?php
    session_start();
    include('db.php');
    $database->pdo->beginTransaction();
    $datas = [];
    $row = [];
    $subjects = [];
    $courseId = htmlspecialchars($_GET['course_name']??'',ENT_QUOTES,'UTF-8');
    $semester = htmlspecialchars($_GET['sem']??'',ENT_QUOTES,'UTF-8');
    $examId = htmlspecialchars($_GET['exam_id']??'',ENT_QUOTES,'UTF-8');

     
    try {
        $courses  = $database->select("course","*");
        $exams = $database->select('events','event_id',['event_type'=>'Exam']);
        if (isset($_GET['show_result'])) {
            $datas = $database->select('results','*', ['course_id'=>$courseId,'semester'=>$semester]);
        }
        foreach ($datas as $data) {
            $subjects[] = $data['subject_id'];
            $row[$data['name']][$data['subject_id']] = $data['mark'];
        }
        $subjects = array_unique($subjects);
        $database->pdo->commit();
    } catch (PDOException $e) {
        file_put_contents("debugg.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
        die("<h1>Something Went Wrong Try again later</h1>");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/table.css">
    <link rel="stylesheet" href="/styles/buttons.css">
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
        .my_table td,.my_table th{
            min-width: 5vw;
        }
        .add_btn {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100px;
        }
    </style>
    <script src="includes/redirect.js"></script>
    <script src="includes/fileUpload.js"></script>
    <script src='node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
    <script src='includes/alert.js'></script>
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Results</h3>
    </div>
    <main>
        <form method="GET">
            <label for="course_text" style="font-size: 14px;padding-right:10px;">Course:</label>
            <select name="course_name" style="width: 175;height:25px;" required>
                <option value="" disabled selected>Choose-></option>
                <?php foreach ($courses as $cname): ?>
                    <option value=<?= $cname['course_id'] ?>><?= $cname['cname']; ?></option>;
                <?php endforeach ?>
            </select>
            <label for="semester_text" style="font-size: 14px;padding: 2px 2px 0 14px;">Semester:</label>
            <select name="sem" style="width: 175px;height:25px;" required>
                <option value="" disabled selected>choose-></option>
                <?php for($i=1;$i<=8;$i+=1): ?>
                    <option><?=$i?></option>
                <?php endfor ?>
            </select>
            
            <label for="exam_id" style="font-size: 14px;padding: 2px 2px 0 14px;">Exam Id:</label>
            <select id="exam_id" name="exam_id" style="height: 25px;width: 175px;" required>
                    <option value="" disabled selected>Choose-></option>
                    <?php foreach($exams as $exam): ?>
                        <option><?= $exam ?></option>
                    <?php endforeach ?>
            </select><br><br>

            <input type="submit" name="show_result" class="func_btn" value="Show Results"><br><br>
            
        </form>
        <form method="post" action="includes/result_publisher.php" id="upload_form" enctype="multipart/form-data">
            <button type="button" class="add_btn" value="Publish" onclick="fileUpload();">
                <img src="/icons/upload_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg">Upload</button>
            <input type="file" id="file_upload" name="file" style="display: none;">
        </form>

        <hr style="margin: 10px 10px 0 auto;">
        <?php if (!empty($row) && !empty($subjects)): ?>
        <table class="my_table"style="margin-top:50px;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Semester</th>
                    <?php foreach ($subjects as $sub): ?>
                        <th><?= $sub ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($row as $name=>$subjectData): ?>
                    <tr>
                        <td><?= $name; ?></td>
                        <td><?= $semester; ?></td>
                        <?php foreach ($subjects as $subject): ?>
                            <td><?= $subjectData[$subject] ?? 'N/a'; ?></td>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
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