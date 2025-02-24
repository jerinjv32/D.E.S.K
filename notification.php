<?php session_start(); ?>
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
        .notification_content{
            border-collapse: collapse;
            font-size: 0.9em;
            margin: 25px 0;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 5px 5px rgba(0,0,0,0.15);
        }
        .notification_content thead tr{
            background-color: rgb(33, 33, 33);
            color:white;
            font-weight: bold;
        }
        .notification_content tbody tr{
            background-color:rgb(236, 236, 236);
            text-align: center;
        }
        .notification_content th,.notification_content td{
            padding: 15px 15px;
            border-bottom: solid #dddddd;
        }
        .notification_content tbody tr:nth-child(even){
            background-color: white;
        }
    </style>
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Notification</h3>
    </div>
    <main>
        <table class="notification_content">
            <thead>
                <tr>
                    <th style="width: 5vw;">Sl.no.</th>
                    <th style="width: 13vw;">Date</th>
                    <th style="width: 52vw;">Content</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>There is no notification</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </main>
    <footer style="background-color:rgb(33,33,33);width:100%;height:53px;margin:40px 0 0 0;"></footer>
</body>
</html>