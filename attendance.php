<?php
    session_start();
    include('db.php');
    $database->pdo->beginTransaction();
    try {
        $courses  = $database->select("course","*");
        if (isset($_GET['show_result'])) {
        }
        $database->pdo->commit();
    } catch (PDOException $e) {
        file_put_contents("debugg.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
        echo "Something Went Wrong Try again later";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost:5500/styles/table.css">
    <link rel="stylesheet" href="http://localhost:5500/styles/buttons.css">
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
    </style>
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Course Management</h3>
    </div>
    <main>
        <form method="GET">
            <label for="course_text" style="font-size: 14px;padding-right:10px;">Course:</label>
            <select name="course_name" required>
                <option>Choose--></option>
                <?php
                foreach ($courses as $cname) {
                    echo "<option>".$cname['cname']."</option>";
                }
                ?>
            </select>
    
            <label for="semester_text" style="font-size: 14px;padding: 2px 2px 0 14px;">Semester:</label>
            <input type="number" name="sem" oninput="notBelowOne(this);" required><br><br>
        
            <input type="submit" name="show_result" class="func_btn" value="Show Results"><br><br>
            
        </form>
        <input type="submit" class="func_btn" value="+ upload"><br>

        <hr style="margin: 10px 10px 0 auto;">
        <table class="my_table"style="margin-top:50px;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Semester</th>
                    <th>Sub1</th>
                    <th>Sub2</th>
                    <th>Sub3</th>
                    <th>Sub4</th>
                    <th>Sub5</th>
                    <th>Sub6</th>
                    <th>Sub7</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </main>
    <script src="includes/not_below_1.js"></script>
</body>
</html>