<?php 
include('../db.php');
if (isset($_POST['remove_course'])) {
   $cname = $_POST['course'];
}
try {
    $database->delete("course",["cname"=>$cname]);
    header('Location: ../remove_course.php?check=1');
    exit();
} catch(PDOException $e) {
    file_put_contents("debugg.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    die("Something went wrong,Try again later");
}