<?php
include('../db.php');
$sub_name  = $_POST['hid_sub_id'];
try {
    $database->delete('subjects',['subject_id'=>$sub_name]);
} catch (PDOException $e) {
    file_put_contents("error_log.txt".date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    echo "Something Went Wrong Try again later";
}
header("Location:../course_management.php");