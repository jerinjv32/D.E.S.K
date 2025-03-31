<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: poppins;
        }
        body{
            background-image: url("/background/139441191_3daeaaf0-bf35-47ec-9b33-293cdcf519b2.svg");
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            height: 100vh;
        }
        .container {
            display: flex;
            background-color: #ffffff;
            width: 350px;
            height: 400px;
            border-radius: 10px;
            border: #232323;
            padding: 0px;
            flex-direction: column;
            box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.33);
            -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.33);
            -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.33);
        }
        </style>
        <link rel="stylesheet" href="/styles/update_password.css">
        <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script src="includes/alert.js"></script>
</head>
<body>
    <main>
        <form method="post" action="/includes/change_password.php"  class="container" autocomplete="off">
            <div class="header">
                <h1>New Password</h1>
            </div>
            <label for="otp_box">Enter the OTP</label>
            <input type="text" name="otp_box" id="otp_box" placeholder="Enter OTP" required>

            <label for="new_pass">New Password</label>
            <input type="password" name="new_password" id="new_password" placeholder="New Password" required>

            <label for="confirm_pass">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>

            <input type="submit" value="Change" class="change_btn" name="change_btn">
        </form>
        <a href="/login.php" id="go_back">
            <p id="text">Go Back to Login Page</p>
        </a>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                let search = new URLSearchParams(window.location.search);
                let check = Number(search.get('check'));
                switch (check) {
                    case 100:
                        showAlert('Done','Password Changed','success');
                        break;
                        case 101:
                            showAlert('Invalid OTP','','error');
                            break;
                            case 102:
                                showAlert('Try again','Passwords are not matching','error');
                                break;
                            }
                        });
                        </script>
    </main>
</body>
</html>