<?php 
session_start(); 
include('db.php');
$notifications = [];
$role = $_SESSION['role'];
try{
    $notifications = $database->select("notification",["[>]events"=>["event_id"=>"event_id"]],
    ["notification.event_id","events.event_details","events.event_date","events.event_type"],
    ['OR'=>['notification.event_notify'=>'faculty','notification.event_notify'=>'all']]);
}catch(PDOException $e){
    file_put_contents("debugg.txt",date("Y-m-d H-i-s")."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    echo "Something Wrong, Try again later";
}
$notifications = $database->select("notification","*");
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
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($notifications as $notification): ?>
                        <tr>
                            <td><?= $notification['event_date']?></td>
                            <td><?= $notification['event_details']?></td>
                        </tr>
                    <?php endforeach ?>
            </tbody>
        </table>
    </main>
</body>
</html>