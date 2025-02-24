<?php 
    session_start();
    include('sidebar.php');
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
</head>
<body>
    <div class="nav_bar">
        <h3 class="nav_content1">My Profile</h3>
    </div>
    <main>
        <div class="profile_container">
            <!--Profile photo-->
            <div class="profile_pic_col" style="grid-area: panel1; width: 200px;">
                <img src="http://localhost:5500/images/user-profile-front-side.jpg" id="profile_pic">
            </div>
            <!--first part-->
            <div class="main_details" style="grid-area: panel2;">
                <div style="margin:20px 530px 0 10px;justify-items:left;padding-left:50px;">
                    <label for="name_box">Name:</label>
                    <input type="text" name="namtest" id="name_box">
                    <div>Date of birth:</div>
                    <input type="date" name="dob" >
                    <div>Gender:</div><br>
                    <select>
                        <option> male</option>
                        <option> female</option>
                        <option> other</option>
                    </select> 
                    <div>College Id:</div><br>
                    <input type="text" name="collegeid" >
                    <div>Admission No:</div>
                    <input type="number" name="admno" >
                </div>
            </div>
            <!--Course details-->
            <div class="address_cont" style="grid-area: panel3;">
                <h3>Course Details</h3>
                <hr style="margin: 0 auto 0 0;">
                <div style="padding: 10px 0 10px 20px;">
                    <div>Course name:</div>
                    <input type="text" name="coursename"><br>
                    <div>Year of join:</div><br>
                    <input typr="date" name="yearjoin"> 
                    <div>Current Semester:</div>
                    <input type="number" name="sem">
                </div>
            </div>
            <!--Address and contact details-->
            <div class="address_cont" style="grid-area: panel4;">
                <h3>Address and Contact Details</h3>
                <hr style="margin: 0 auto 0 0;">
                <div style="padding: 10px 0 10px 20px;">
                    <div>Email:</div>
                    <input type="email" name="mail">
                
                    <div>Phone number:</div>
                    <input type="number" name="mobno">
                    <div>Address:</div>
                    <input type="text" name="address" style="width:400px;padding-bottom:200px;">
                </div>
            </div>
            <!--Other-->
            <div class="other" style="grid-area: panel5;">
                <h3>Other Details</h3>
                <hr style="margin: 0 auto 0 0;">
                <div style="padding: 10px 0 10px 20px;">
                    <div>Blood Group:</div>
                    <input type="text" name="bloodgroup">
                    <div>Mother Tongue:</div>
                    <input type="text" name="lang">
                    <div>Resident:</div>
                    <select> 
                        <option>dayscholar</option>
                        <option>hostels</option>

                    </select><br><br>
                    <button name="addstu" style="border:none; background-color:rgb(33, 33, 33);color:white;border-radius: 3px;">add student</button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>