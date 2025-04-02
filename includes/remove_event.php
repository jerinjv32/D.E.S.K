<?php
require_once __DIR__.'/../db.php';
if (isset($_POST['remove_noti'])) {
    $slno = htmlspecialchars($_POST['notification_number']??'',ENT_QUOTES,'UTF-8');
    try{
        $database->delete("notification",['event_id'=>$slno]);
        header('Location:../notification_admin.php?check=100');
        exit();
    }catch(PDOException $e){
        file_put_contents("debugg.txt",date("Y-m-d H-i-s")."-".$e->getMessage().PHP_EOL,FILE_APPEND);
        header('Location:../notification_admin.php?check=101');
        exit();
    }
}