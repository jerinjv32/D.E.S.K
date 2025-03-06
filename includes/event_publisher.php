<?php

include ('../db.php');

$fields = ['event_name','event_type','event_notify','event_date','event_details'];
$query = [];

foreach ($fields as $field) {
    if (isset($_POST[$field])){
        $query[$field] = htmlspecialchars($_POST[$field] ?? '',ENT_QUOTES,'UTF-8');    
    }
}
$database->pdo->beginTransaction();
try {
    $database->insert("events",$query);
    if ($_POST['event_notify'] == "All") {
        $database->insert("notification",['date'=>$query['event_date'],'content'=>$query['event_details']]);
    }
    $database->pdo->commit();
    header('Location: ../events.php');
} catch (PDOException $e) {
    file_put_contents("error_log.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    echo "Something went wrong. Try again later";
}