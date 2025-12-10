<?php 
    $error = '';
    require_once 'includes/user_validation.php';
    if (isset($_POST['submit_btn'])) {
        $college_id = htmlspecialchars($_POST['college_id']??'',ENT_QUOTES,'UTF-8');
        $email_id = htmlspecialchars($_POST['email_id']??'',ENT_QUOTES,'UTF-8');
    
        $obj = new ValidateUser($college_id, $email_id);
        $error = $obj->checkUser();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: poppins;
            background-image: url("/background/139441191_3daeaaf0-bf35-47ec-9b33-293cdcf519b2.svg");
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            width: 350px;
            height: 63vh;
            border-radius: 10px;
            border: #232323;
            padding: 0px;
            display: flex;
            flex-direction: column;
            box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.33);
            -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.33);
            -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.33);
        }
        </style>
        <link rel="stylesheet" href="/styles/user_help.css">
</head>
<body>
    <main>
        <form class="container" method="post" autocomplete="off">
            <div class="header">
                <h1>Forgot Password ?</h1>
            </div>
            <label for="college_id">Enter Your College Id</label>
            <input type="text" name="college_id" id="college_id" required>
            <label for="email_id">Enter Your Email Id</label>
            <input type="text" name="email_id" id="email_id" required>
            <button type="submit" class="submit_btn" name="submit_btn">
                <span style="display: flex; align-items: center;">Submit</span>
            </button>
            <?php if (!empty($error)): ?>
                <p id="error" style="text-align: center;"><?= $error ?></p>
            <?php endif ?>
        </form>
            <a href="/login.php" id="go_back">
                <p id="text">Go Back to Login Page</p>
            </a>
        </main>
</body>
</html>