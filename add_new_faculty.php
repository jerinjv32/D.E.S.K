<?php 
    include('db.php');
    include('sidebar.php');
    try {
        $cnames = $database->select("course","cname");
    } catch(PDOException $e) {
        file_put_contents("error_log_faculty.txt",date("Y-m-d H-i-s")."-".$e->getMessage(). PHP_EOL, FILE_APPEND);
        die("Some Error Occured");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        *{
            margin: 0;
            font-family: poppins;
        }
        main{
            margin: 20px 20px 20px 228px;
            overflow: auto;
        }
        .profile_container{
            display: grid;
            border: 2px solid;
            border-radius: 5px;
            grid-template-areas: 
                "panel1 panel2 panel2"
                "panel3 panel3 panel3"
                "panel4 panel4 panel4"
                "panel5 panel5 panel5";
                row-gap: 10px;
            margin: 0 0 20px 0;
            font-size: small;
            column-gap: 0px;
            overflow-x: hidden;
            box-shadow: 0 0 5px rgba(0,0,0,0.25 );
        }
        #profile_pic{
            height: 206px;
            width: auto;
            border: 1px solid black;
            padding: 3px;
            margin: 20px;
        }
        h3{
            padding-left: 20px;
        }
        button:hover{
            transform: scale(1.05);
        }
    </style>
    <link rel="stylesheet" href="/styles/navbar_with_return.css">
    <link rel="stylesheet" href="/styles/buttons.css">
    <script src="/includes/redirect.js"></script>
    <script src="/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src='includes/alert.js'></script>
</head>
<body>
    <nav>
        <h3 class="nav_content1"><span onclick="redirect('faculty_management.php')">Faculty Management </span> / Add Faculty</h3>
    </nav>
    <main>
        <form method="post" action="includes/faculty_entry.php" autocomplete="off">
            <div class="profile_container">
                <!--Profile photo-->
                <div class="profile_pic_col" style="grid-area: panel1; width: 200px;">
                    <img src="http://localhost:5500/images/user-profile-front-side.jpg" id="profile_pic">
                </div>
                <!--first part-->
                <div class="main_details" style="grid-area: panel2;">
                    <div style="margin:20px 530px 0 10px;justify-items:left;padding-left:50px;">
                        <label for="name_box">Name:</label><br>
                        <input type="text" name="name" id="name_box" required><br><br>
                        <div>Date of birth:</div>
                        <input type="date" name="dob" required><br><br>
                        <div>Gender:</div>
                        <select name="gender" required>
                            <option> male</option>
                            <option> female</option>
                            <option> other</option>
                        </select><br><br>
                        <div>College Id:</div>
                        <input type="text" name="collegeid" required><br><br>
                        <div>Password:</div>
                        <input type="text" name="password" required><br><br>
                        <div>Role:</div>
                        <select name="role">
                            <option>Admin</option>
                            <option>Faculty</option>
                        </select>
                    </div>
                </div>
                <!--Institution details-->
                <div class="address_cont" style="grid-area: panel3;">
                    <h3>Institution Details</h3>
                    <hr style="margin: 0 auto 0 0;">
                    <div style="padding: 10px 0 10px 20px;">
                        <div>Course name:</div>
                        <select name="course_name" required>
                            <option value="" disabled selected>Choose Course-></option>
                            <?php foreach($cnames as $course): ?>
                                <option><?= $course ?></option>
                            <?php endforeach ?>
                        </select>
                        <br><br>
                        <div>Year of join:</div>
                        <input typr="text" name="yearjoin" required> 
                    </div>
                </div>
                <!--Address and contact details-->
                <div class="address_cont" style="grid-area: panel4;">
                    <h3>Address and Contact Details</h3>
                    <hr style="margin: 0 auto 0 0;">
                    <div style="padding: 10px 0 10px 20px;">
                        <div>Email:</div>
                        <input type="text" name="mail" required><br><br>
                        <div>Phone number:</div>
                        <input type="text" name="mobno" required><br><br>
                        <div>Address:</div>
                        <textarea name="address" style="resize: none;overflow:auto;" rows="7" cols="50"  required></textarea>
                    </div>
                </div>
                <!--Other-->
                <div class="other" style="grid-area: panel5;">
                    <h3>Other Details</h3>
                    <hr style="margin: 0 auto 0 0;">
                    <div style="padding: 10px 0 10px 20px;">
                        <div>Blood Group:</div>
                        <input type="text" name="bloodgroup"><br><br>
                        <div>Mother Tongue:</div>
                        <input type="text" name="lang"><br><br>
                        <input type="submit" name="addfac" class="add_btn" value="Add to Faculties">
                    </div>
                </div>
            </div>
        </form>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let search = new URLSearchParams(window.location.search);
            let code = Number(search.get('check'));
            switch(code) {
                case 100:
                    showAlert('Done','Faculty Is Added','success');
                    break;
                case 23000:
                    showAlert('Failed','Data Already Exists','error');
                    break;
                case -100:
                    showAlert('Failed','','error');
                    break;
            }
        })
    </script>
</body>
</html>