<?php 
session_start();
include ('db.php');
try{
    $courses = $database->select('course','cname');
} catch (PDOException $e) {
    file_put_contents("debugg.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    echo "Something went wrong";
}
//Search
$query = [];
if (isset($_POST['search_btn'])) {
    $table_name = htmlspecialchars($_POST['table_name'] ?? '',ENT_QUOTES,'UTF-8');
    $college_id = htmlspecialchars($_POST['college_id'] ?? '',ENT_QUOTES,'UTF-8');
    $name = htmlspecialchars($_POST['name'] ?? '',ENT_QUOTES,'UTF-8');
    $course = htmlspecialchars($_POST['course'] ?? '',ENT_QUOTES,'UTF-8');
    $sem = filter_var($_POST['semester'] ?? '',FILTER_VALIDATE_INT);
    $adm_no = filter_var($_POST['admission_no'] ?? '',FILTER_VALIDATE_INT);
    $fiiltered_query = array_filter(['college_id'=>$college_id,
        '[~]sname'=>$name ?: null,
        'cname'=>$course ?: null,
        'semester'=>$sem ?: null,
        'adno'=>$adm_no ?: null
    ], fn($value)=> !is_null($value) && $value !== '');
    try {
        $query = $database->select("student",['college_id','sname','cname','semester','adno'],$fiiltered_query);
    } catch (PDOException $e) {
        file_put_contents("debugg.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
        echo "Something went wrong";
    }
}
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
    </style>
    <link rel="stylesheet" href="http://localhost:5500/styles/table.css">
    <link rel="stylesheet" href="http://localhost:5500/styles/buttons.css">
    <link rel="stylesheet" href="http://localhost:5500/styles/search.css">
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Search</h3>
    </div>
    <main>
        <form method="POST" action="search.php" autocomplete="off">
            <div style="font-size: small;">
                <label for="name_box" style="padding-right: 51px;">Name:</label>
                <input type="text" name="name" id="name_box" placeholder="Enter name"><br><br>
                <label for="course_box" style="padding-right: 45px;">Course:</label>
                <select name="course" id="course_box" style="width:175px;height:25px;" place>
                        <option value="" disabled selected>Choose-></option>
                        <?php foreach($courses as $course): ?>
                            <option><?= $course ?></option>
                        <?php endforeach ?>
                </select><br><br>
                <label for="semester_box" style="padding-right: 30px;">Semester:</label>
                <select name="semester" id="semester_box" style="width:175px;height:25px;">
                    <option value="" disabled selected>Choose-></option>
                    <?php for($i = 1;$i <= 8; $i+=1): ?>
                        <option><?= $i ?></option>
                    <?php endfor ?>
                </select><br><br>
                <label for="college_id_box" style="padding-right: 25px;">College id:</label>
                <input type="text" name="college_id" id="college_id_box" placeholder="Enter college id"><br><br>
                <label for="adm_box" style="padding-right: 1px;">Admission No:</label>
                <input type="text" name="admission_no" id="adm_box" placeholder="Enter admission No"><br><br>
                
                <input type="submit" value="search" name="search_btn" class='func_btn'>
            </div>
        </form>
        <?php if (isset($_POST['search_btn'])): ?>
            <table class="my_table"style="margin-top:30px;">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($query)): ?>
                        <?php foreach($query as $content): ?>
                            <tr>
                                <td><?=$content['college_id']?></td>
                                <td><?=$content['sname']?></td>
                                <td><?=$content['cname']?></td>
                                <td><?=$content['semester']?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="font-weight: bold;text-align:center;">No Results</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        <?php endif ?>
    </main>
    <script src="includes/redirect.js"></script>
</body>
</html>