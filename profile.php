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
            border-radius: 5px; 
            overflow: auto;
        }
        .profile_container{
            display: grid;
            border: 2px solid;
            border-radius: 5px;
            grid-template-areas: 
                "panel1 panel2 panel2"
                "panel3 panel3 panel3"
                "panel4 panel4 panel4";
                row-gap: 10px;
            margin: 0 0 20px 0;
            font-size: small;
            column-gap: 0px;
            overflow-x: hidden;
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
                    <div>Name:</div><br>
                    <div>Date of birth:</div><br>
                    <div>Gender:</div><br>
                    <div>College Id:</div><br>
                </div>
            </div>
            <!--Address and contact details-->
            <div class="address_cont" style="grid-area: panel3;">
                <h3>Address and Contact Details</h3>
                <hr style="margin: 0 auto 0 0;">
                <div style="padding: 10px 0 10px 20px;">
                    <div>Email:</div><br>
                    <div>Phone number:</div><br>
                    <div>Address:</div>
                </div>
            </div>
            <!--Other-->
            <div class="other" style="grid-area: panel4;">
                <h3>Other Details</h3>
                <hr style="margin: 0 auto 0 0;">
                <div style="padding: 10px 0 10px 20px;">
                    <div>Blood Group:</div><br>
                    <div>Mother Tongue:</div><br>
                    <div>Resident:</div>
                </div>
            </div>
        </div>
    </main>
    <footer style="background-color:rgb(33,33,33);width:100%;height:53px;margin:40px 0 0 0;"></footer>
</body>
</html>