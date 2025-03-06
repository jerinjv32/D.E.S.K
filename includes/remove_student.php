<?php 
include('..\db.php');
if (isset($_POST['hid_college_id'])){
    $student_id = $_POST['hid_college_id'];
}
try {
    $database->delete("student",['college_id'=>$student_id]);
} catch(PDOException $e) {
    file_put_contents("error_log.txt",date("Y-m-d H-i-s")."-".$e->getMessage(). PHP_EOL, FILE_APPEND);
    echo "Something went wrong, Try again later";
}
header('Location: ../student_management.php');
exit();