<?php 
include('../db.php');
if (isset($_POST['add_sub'])) {
    $cid = $_POST['course_name'];
    $sub_name = htmlspecialchars($_POST['new_sub'] ?? '',ENT_QUOTES,'UTF-8');
    $sub_id = htmlspecialchars($_POST['new_sub_code'] ?? '',ENT_QUOTES,'UTF-8');
    $sem = filter_var($_POST['sub_sem'] ?? '',FILTER_VALIDATE_INT);

}
try {
    $database->insert("subjects",['subject_id'=>$sub_id,'subject_name'=>$sub_name,'semester'=>$sem,'course_id'=>$cid]);
    header('Location: ../course_management.php');
    exit();
} catch(PDOException $e) {
    file_put_contents("error_log.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    echo "Something went wrong,Try again later";
}