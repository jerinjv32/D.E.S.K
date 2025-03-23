<?php
include('../db.php');
$cname = htmlspecialchars($_POST['cname'] ?? '',ENT_QUOTES,'UTF-8');
$cname = strtolower($cname);
try{
    $result = $database->select('course','cname',['cname'=>$cname]);
    if (!empty($result)) {
        header('Location: ../add_course.php?check=-1');
        exit();    
    } else {
        $check = $database->insert("course",["cname"=>$cname]);
        header('Location: ../add_course.php?check=1');
        exit();
    }
} catch(PDOException $e) {
    file_put_contents("error_log.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    die("Something went wrong,Try again later");
}