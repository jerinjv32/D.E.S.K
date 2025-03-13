<?php
session_start();
include ('../db.php');
$fields = ['name'=>'fname','dob'=>'fdob','gender'=>'fgender','collegeid'=>'college_id',
            'coursename'=>'cname','yearjoin'=>'yoj','mail'=>'email','mobno'=>'fpno',
            'address'=>'address','bloodgroup'=>'blood_group','lang'=>'mother_tongue'];

$query = [];

foreach ($fields as $field => $columnName){
    if (!empty($_POST[$field])) {
        if (in_array($field,['mobno','yearjoin'])) {
            $query[$columnName] = filter_var($_POST[$field] ?? '',FILTER_VALIDATE_INT);
        }
        else {
            $query[$columnName] = htmlspecialchars($_POST[$field] ?? '',ENT_QUOTES,'UTF-8');
        }
    }
}
$password = htmlspecialchars($_POST['password'] ?? '',ENT_QUOTES,'UTF-8');
$hash = password_hash($password,PASSWORD_DEFAULT);
$role = htmlspecialchars($_POST['role'] ?? '',ENT_QUOTES,'UTF-8');
$role = strtolower($role);
$database->pdo->beginTransaction();
try {
    $database->insert("faculty",$query);
    $database->insert("users",['username'=>$query['college_id'],'password'=>$hash,'role'=>$role]);
    $database->pdo->commit();
} catch(PDOException $e) {
    file_put_contents("error_log_faculty.txt",date("Y-m-d H-i-s")."-".$e->getMessage(). PHP_EOL, FILE_APPEND);
    header('Location:../add_new_faculty.php');
    die();
}
header('Location:../add_new_faculty.php');
exit();
?>