<?php 
include('..\db.php');
if (isset($_POST['hid_college_id'])){
    $faculty_id = htmlspecialchars($_POST['hid_college_id'],ENT_QUOTES,'UTF-8');
}
try {
    $database->delete("faculty",['college_id'=>$faculty_id]);
    header('Location: ../faculty_management.php?check=100');
    exit();
} catch(PDOException $e) {
    file_put_contents("error_log.txt",date("Y-m-d H-i-s")."-".$e->getMessage(). PHP_EOL, FILE_APPEND);
    die("Something went wrong, Try again later");
}