<?php 
    session_start();
    if (!empty($_GET['check'])) {
        $check = $_GET['check'];
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
    <link rel="stylesheet" href="http://localhost:5500/styles/navbar_with_return.css">
    <link rel="stylesheet" href="http://localhost:5500/styles/buttons.css">
</head>
<body>
    <?php include('sidebar.php') ?>
    <nav>
        <h3 class="nav_content1"><span onclick="redirect('course_management.php')">Course Management </span> / Add course</h3>
    </nav>
    <main>
        <article>
            <form action="includes/course_publisher.php" method="post">
                <label>Course Name:</label>
                <input type="text" name="cname" required>
                <br><br>
                <input type="submit" value="Add Course" name="add_course" class="add_btn_medium">
            </form>
        </article>
    </main>
    <script src="/includes/redirect.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
        let check = <?php echo $check; ?>;
        if (check == 1) {
            swal.fire ({
                title: 'Completed',
                text: 'Upload Was successfull',
                icon: 'success'
            });
        }
    </script>
</body>
</html>