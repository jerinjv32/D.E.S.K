<?php 
    session_start();
    include('db.php');
    include('sidebar.php');
    $student_id = $_GET['id'];
    $fields = [];
    try{
        $fields = $database->get("student","*",['college_id'=>$student_id]);

    } catch(PDOException $e) {
        file_put_contents("debugg.txt",date("Y-m-d H-i-s")."-".$e->getMessage().PHP_EOL,FILE_APPEND);
        echo("Something wrong, Try again Later");
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
</head>
<body>
    <nav>
        <h3 class="nav_content1"><span onclick="redirect('student_management.php')">Student Management </span> / Edit Student Details</h3>
    </nav>
    <main>
        <form method="post" action="includes/upload_students_edit.php" autocomplete="off">
            <div class="profile_container">
                <!--Profile photo-->
                <div class="profile_pic_col" style="grid-area: panel1; width: 200px;">
                    <img src="/images/user-profile-front-side.jpg" id="profile_pic">
                </div>
                <!--first part-->
                <div class="main_details" style="grid-area: panel2;">
                    <div style="margin:20px 530px 0 10px;justify-items:left;padding-left:50px;">
                        <label for="name_box">Name:</label><br> 
                        <input type="text" name="name" id="name_box" value="<?php echo $fields['sname']; ?>" required> <br><br>
                        <div>Date of birth:</div>
                        <input type="date" name="dob" value="<?php echo $fields['sdob'];?>" required><br><br>
                        <div>Gender:</div>
                        <select name="gender" value="<?php echo $fields['gender'];?>" required>
                            <option> male</option>
                            <option> female</option>
                            <option> other</option>
                        </select><br><br>
                        <div>College Id:</div>
                        <input type="text" name="collegeid" value="<?php echo $fields['college_id'];?>" required><br><br>
                        <div>Admission No:</div>
                        <input type="text" name="admno" value="<?php echo $fields['adno'];?>" required>
                    </div>
                </div>
                <!--Course details-->
                <div class="address_cont" style="grid-area: panel3;">
                    <h3>Course Details</h3>
                    <hr style="margin: 0 auto 0 0;">
                    <div style="padding: 10px 0 10px 20px;">
                        <div>Course name:</div>
                        <input type="text" name="coursename" value="<?php echo $fields['cname'];?>" required><br><br>
                        <div>Year of join:</div>
                        <input type="text" name="yearjoin" value="<?php echo $fields['yoj'];?>" required> <br><br>
                        <div>Current Semester:</div>
                        <input type="text" name="sem" value="<?php echo $fields['semester'];?>" required>
                    </div>
                </div>
                <!--Address and contact details-->
                <div class="address_cont" style="grid-area: panel4;">
                    <h3>Address and Contact Details</h3>
                    <hr style="margin: 0 auto 0 0;">
                    <div style="padding: 10px 0 10px 20px;">
                        <div>Email:</div>
                        <input type="text" name="mail" value="<?php echo $fields['email'];?>" required><br><br>
                        <div>Phone number:</div>
                        <input type="text" name="mobno" maxlength="10" value="<?php echo $fields['mobno'];?>" required><br><br>
                        <div>Address:</div>
                        <input type="text" name="address" style="width:400px;padding-bottom:200px;" value="<?php echo $fields['address'];?>" required>
                    </div>
                </div>
                <!--Other-->
                <div class="other" style="grid-area: panel5;">
                    <h3>Other Details</h3>
                    <hr style="margin: 0 auto 0 0;">
                    <div style="padding: 10px 0 10px 20px;">
                        <div>Blood Group:</div>
                        <input type="text" name="bloodgroup" value="<?php echo $fields['blood_group'];?>""><br><br>
                        <div>Mother Tongue:</div>
                        <input type="text" name="lang" value="<?php echo $fields['mother_tongue'];?>"><br><br>
                        <div>Resident:</div>
                        <select name="resident" value="<?php echo $fields['resident'];?>" required> 
                            <option>dayscholar</option>
                            <option>hostel</option>
                        </select><br><br><br>
                        <input type="submit" name="edit_stud" class="func_btn" value="Submit">
                    </div>
                </div>
            </div>
        </form>
    </main>
</body>
</html>