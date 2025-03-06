<?php 
include('..\db.php');
if (isset($_POST['hid_college_id'])){
    $faculty_id = $_POST['hid_college_id'];
}
try {
    $database->delete("faculty",['college_id'=>$faculty_id]);
} catch(PDOException $e) {
    file_put_contents("error_log.txt",date("Y-m-d H-i-s")."-".$e->getMessage(). PHP_EOL, FILE_APPEND);
    echo "Something went wrong, Try again later";
}
header('Location: ../student_management.php');
exit();