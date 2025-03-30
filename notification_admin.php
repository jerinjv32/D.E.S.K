<?php 
session_start(); 
include('db.php');
$notifications = [];
try{
    $notifications = $database->select("notification","*");
}catch(PDOException $e){
    file_put_contents("debugg.txt",date("Y-m-d H-i-s")."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    die("Something Wrong, Try again later");
}
//remove notification
if (isset($_POST['remove_noti'])) {
    $slno = htmlspecialchars($_POST['notification_number']??'',ENT_QUOTES,'UTF-8');
    try{
        $database->delete("notification",['slno'=>$slno]);
        $check = 10;
    }catch(PDOException $e){
        file_put_contents("debugg.txt",date("Y-m-d H-i-s")."-".$e->getMessage().PHP_EOL,FILE_APPEND);
        die("Something Wrong, Try again later");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: poppins;
            margin:0px;
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
            height: 100px;
            border: 1px black solid;  
            margin: 20px 20px 20px 228px;
            border-radius: 5px;
            padding:20px 10px 0 20px;
            box-shadow: 0 5px 5px rgba(0,0,0,0.25);
            min-height: 500px;
            max-height: 100%;
            overflow: auto;
        }
        .my_table td, .my_table th {
            min-width: 10vw;
        }
    </style>
    <link rel="stylesheet" href="/styles/table.css">
    <link rel="stylesheet" href="/styles/buttons.css">
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="includes/alert.js"></script>
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Notification</h3>
    </div>
    <main>
        <table class="my_table">
            <thead>
                <tr>
                    <th style="width: 13vw;">Date</th>
                    <th style="width: 52vw;">Content</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody
            <?php if (!empty($notifications)): ?>
                <?php foreach($notifications as $notification): ?>
                    <tr>
                        <td><?=$notification['date']?></td>
                        <td><?=$notification['content']?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" value="<?= $notification['slno'] ?>" name='notification_number'>
                                <input type="submit" class="remove_btn" name='remove_noti' value='Remove'>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;font-weight:bold;">No Notification</td>
                </tr>
            <?php endif ?>
            </tbody>
        </table>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let check = <?php echo $check ?>;
            if (check == 10) {
                showAlert('Done','Notification Is Removed','success');
            }
        });
    </script>
</body>
</html>