<?php
include ('../db.php');
$fields = ['name'=>'sname','dob'=>'sdob','gender'=>'gender','collegeid'=>'college_id','admno'=>'adno',
            'coursename'=>'cname','yearjoin'=>'yoj','sem'=>'semester','mail'=>'email','mobno'=>'mobno',
            'address'=>'address','bloodgroup'=>'blood_group','lang'=>'mother_tongue','resident'=>'resident'];

$query = [];

foreach ($fields as $field => $columnName){
    if (!empty($_POST[$field])) {
        if (in_array($field,['admno','sem','mobno','yearjoin'])) {
            $query[$columnName] = filter_var($_POST[$field] ?? '',FILTER_VALIDATE_INT);
        }
        else {
            $query[$columnName] = htmlspecialchars($_POST[$field] ?? '',ENT_QUOTES,'UTF-8');
        }
    }
}
$password = htmlspecialchars($_POST['password'] ?? '',ENT_QUOTES,'UTF-8');
$hash = password_hash($password,PASSWORD_DEFAULT);
$role = "student";
$database->pdo->beginTransaction();
try {
    $database->insert("student",$query);
    $database->insert("users",['username'=>$query['college_id'],'password'=>$hash,'role'=>$role]);
    $database->pdo->commit();
    header('Location:../add_new_students.php?check=100');
    die();
} catch(PDOException $e) {
    file_put_contents("error_log.txt",date("Y-m-d H-i-s")."-".$e->getMessage(). PHP_EOL, FILE_APPEND);
    if ($e->getCode() == 23000){
        header('Location:../add_new_students.php?check=23000');
        die();    
    } else {
        header('Location:../add_new_students.php?check=-100');
        die();
    }
}
header('Location:../add_new_students.php');

?>