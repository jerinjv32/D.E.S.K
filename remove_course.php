<?php 
    session_start();
    include('sidebar.php');
    include('db.php');
    try {
        $courses = $database->select("course","cname");
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
            min-height: 200px;
            max-height: 100%;
            overflow: auto;
        }
        </style>
        <link rel="stylesheet" href="/styles/navbar_with_return.css">
        <link rel="stylesheet" href="/styles/buttons.css">
        <script src="/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script src="/includes/alert.js"></script>
</head>
<body>
    <nav>
        <h3 class="nav_content1"><span onclick="redirect('course_management.php')">Course Management </span> / Remove Course</h3>
    </nav>
    <main>
        <article>
            <form action="includes/remove_course.php" method="post">
                <label>Select Course:</label>
                <select name="course" id="course_text" style="padding-right:5px;height:26px;min-width:200px;">
                    <option>Choose--></option>
                    <?php foreach($courses as $course) {
                        echo "<option>".$course."</option>";
                    } 
                    ?>
                </select>
                <br><br>
                <input type="submit" value="Remove Course" name="remove_course" class="remove_btn_medium">
            </form>
        </article>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let search = new URLSearchParams(window.location.search);
            let check = Number(search.get('check'));
            if (check === 1) {
                showAlert('Done','Course Is Removed','success');
            }
        })
    </script>
    <script src="/includes/redirect.js"></script>
</body>
</html>