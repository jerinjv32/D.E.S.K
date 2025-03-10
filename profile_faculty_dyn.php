<?php 
    session_start();
    include('db.php');
    include('sidebar.php');
    $college_id = htmlspecialchars($_GET['id'] ?? null,ENT_QUOTES,'UTF-8');
    try{
            $details = $database->get("faculty","*",['college_id'=>$college_id]);
        } catch(PDOException $e) {
            file_put_contents("debugg.txt",date("Y-m-d H-i-s")."-".$e->getMessage().PHP_EOL,FILE_APPEND);
            echo "some error";
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
    </style>
    <link rel="stylesheet" href="http://localhost:5500/styles/navbar_with_return.css">
</head>
<body>
    <nav>
        <h3 class="nav_content1"><span onclick="redirect('faculty_management.php')">Faculty Management </span> / Faculty</h3>
    </nav>
    <main>
        <div class="profile_container">
            <!--Profile photo-->
            <div class="profile_pic_col" style="grid-area: panel1; width: 200px;">
                <img src="http://localhost:5500/images/user-profile-front-side.jpg" id="profile_pic">
            </div>
            <!--first part-->
            <div class="main_details" style="grid-area: panel2;">
                <div style="margin:20px 530px 0 10px;justify-items:left;padding-left:50px;">
                    <div>Name: <?php echo $details['fname']; ?></div><br>
                    <div>Date of birth: <?php echo $details['fdob']; ?></div><br>
                    <div>Gender: <?php echo $details['fgender']; ?></div><br>
                    <div>College Id: <?php echo $details['college_id']; ?></div><br>
                </div>
            </div>
            <!--Course details-->
            <div class="address_cont" style="grid-area: panel3;">
            <h3>Institution Details</h3>
                    <hr style="margin: 0 auto 0 0;">
                    <div style="padding: 10px 0 10px 20px;">
                        <div>Course name: <?php echo $details['cname']; ?></div><br>
                        <div>Year of join: <?php echo $details['yoj']; ?></div>
                    </div>
            </div>
            <!--Address and contact details-->
            <div class="address_cont" style="grid-area: panel4;">
                <h3>Address and Contact Details</h3>
                <hr style="margin: 0 auto 0 0;">
                <div style="padding: 10px 0 10px 20px;">
                    <div>Email: <?php echo $details['email']; ?></div><br>
                    <div>Phone number: <?php echo $details['fpno']; ?></div><br>
                    <div>Address: <?php echo $details['address']; ?></div>
                </div>
            </div>
            <!--Other-->
            <div class="other" style="grid-area: panel5;">
                <h3>Other Details</h3>
                <hr style="margin: 0 auto 0 0;">
                <div style="padding: 10px 0 10px 20px;">
                    <div>Blood Group: <?php echo $details['blood_group']??''; ?></div><br>
                    <div>Mother Tongue: <?php echo $details['mother_tongue']??''; ?></div><br>
                </div>
            </div>
        </div>
    </main>
    <script src="/includes/redirect.js"></script>
</body>
</html>