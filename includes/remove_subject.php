<?php 
include('../db.php');
$subject_id = null; 
if (isset($_POST['remove_btn'])) {
    $subject_id = htmlspecialchars($_POST['subject_id']??'',ENT_QUOTES,'UTF-8');
    $course_id = htmlspecialchars($_POST['course_id']??'',ENT_QUOTES,'UTF-8');
    try {
        $database->delete('subjects',['subject_id'=>$subject_id,'course_id'=>$course_id]);
        header('Location:../course_management.php?check=101');
        exit();
    } catch(PDOException $e) {
        file_put_contents('error_log.txt',date('Y-m-d H-i-s').'-'.$e->getMessage().PHP_EOL,FILE_APPEND);
        die("<h2>Something Went Wrong<h2>");
    }
}
?>