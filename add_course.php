<?php 
    session_start();
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
    <?php include('sidebar.php') ?>
    <nav>
        <h3 class="nav_content1"><span onclick="redirect('course_management.php')">Course Management </span> / Add course</h3>
    </nav>
    <main>
        <article>
            <form action="includes/course_publisher.php" method="post" autocomplete="off">
                <label>Course Name:</label>
                <input type="text" name="cname" required>
                <br><br>
                <input type="submit" value="Add Course" name="add_course" class="add_btn_medium">
            </form>
        </article>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                let search = new URLSearchParams(window.location.search);
                let check = Number(search.get('check'));
                console.log('Value:',check);
                if (check === 1) {
                    showAlert('Done','Course Is Added','success');
                } else if (check === -1) {
                    showAlert('Failed','Course Already Exists','error');
                }
            })
        </script>
    </main>
    <script src="/includes/redirect.js"></script>
</body>
</html>