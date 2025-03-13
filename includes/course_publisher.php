<?php
include('../db.php');
$cname = htmlspecialchars($_POST['cname'] ?? '',ENT_QUOTES,'UTF-8');
try{
    $check = $database->insert("course",["cname"=>$cname]);
    header('Location: ../add_course.php?check=1');
} catch(PDOException $e) {
    file_put_contents("error_log.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    echo "Something went wrong,Try again later";
} finally {
    exit;
}