<?php

include ('../db.php');

$fields = ['event_name','event_type','event_id','event_notify','event_date','event_details'];
$query = [];

foreach ($fields as $field) {
    if (isset($_POST[$field])){
        $query[$field] = htmlspecialchars($_POST[$field] ?? '',ENT_QUOTES,'UTF-8');    
    }
}
$database->pdo->beginTransaction();
try {
    $database->insert("events",$query);
    $database->insert("notification",['event_id'=>$query['event_id'],'event_notify'=>$query['event_notify']]);
    $database->pdo->commit();
    header('Location: ../events.php?check=100');
    exit();
} catch (PDOException $e) {
    file_put_contents("error_log.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    header('Location: ../events.php?check=101');
    exit();
}