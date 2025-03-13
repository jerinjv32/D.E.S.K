<?php

include('db.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $college_id = htmlspecialchars($_POST['college_id']??'',ENT_QUOTES,'');
    $password = htmlspecialchars($_POST['password']??'',ENT_QUOTES,'UTF-8');
    $user = $database->get('users','*',['username' => $college_id]);

    if (!empty($user)) {
        if ($college_id === $user['username']){
            if (password_verify($password,$user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['college_id'] = $user['username'];
                $_SESSION['role'] = $user['role'];
    
                if ($user['role'] == 'student') {
                    header("Location: student_dashboard.php");
                } elseif ($user['role'] == 'faculty') {
                    header("Location: faculty_dashboard.php");
                } elseif ($user['role'] == 'admin') {
                    header("Location: admin_dashboard.php");
                }
                exit();
            } else {
                $error = "Invalid password!";
            }
        } else {
            $error = "Invalid college ID!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <style>
            body{
                font-family: poppins;
                background-image: url("http://localhost:5500/background/139441191_3daeaaf0-bf35-47ec-9b33-293cdcf519b2.svg");
                background-size: cover;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .container {
                background-color: #ca3131;
                width: 350px;
                height: 395px;
                border-radius: 10px;
                border: #232323;
                padding: 0;
                display: flex;
                flex-direction: column;
                box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.33);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.33);
                -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.33);
            }
            .header {
                background-color: #232323;
                height: 300px;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                display: flex;
                justify-content: center;
                align-items: center;
            } 
            h1 {
                color: #ffffff;
                font-size: 24px;
                margin: 0;
            }
            .box {
                background-color: #ffffff;
                padding: 10px;
                border-bottom-left-radius: 10px;
                border-bottom-right-radius: 10px;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            h2 {
                margin: 10px 0 5px 2px;
                font-size: 16px;
                color: #333;
            }
            input[type="text"],
            input[type="password"]{
                width: 300px;
                height: 35px;
                padding: 0 10px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 4px;
                background-color: #fff;
            }
            select {
                height: 35px;
            }
            button {
                width: 100%;
                height: 40px;
                background-color: #232323;
                color: #ffffff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                margin-top: 10px;
            }
            button:hover {
                opacity: 0.7;
            }
            button:active {
                opacity: 1;
            }
            p {
                color: red;
                font-size: 14px;
                text-align: center;
                margin-top: 10px;
            }
            .login_input{
                font-family: poppins;
            }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Sign In</h1>
        </div>
        
        <form action="login.php" method="POST">
            <div class="box">
                <h2 id=college_id>College ID</h2>
                <input type="text" id="college_id" name="college_id" placeholder="Enter College ID" class="login_input" required>
                
                <h2 id="passwordtext">Password</h2>
                <input type="password" id="password" name="password" placeholder="Enter password" class="login_input" required>
                
                
                <button type="submit" class="login_input">Log In</button>

                <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
            </div>
        </form>
    </div>
</body>
</html>
