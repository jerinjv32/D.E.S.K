<?php
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
try {
    $database->update("faculty",$query,['college_id'=>$_POST['collegeid']]);
} catch(PDOException $e) {
    file_put_contents("error_log.txt",date("Y-m-d H-i-s")."-".$e->getMessage(). PHP_EOL, FILE_APPEND);
    echo "Something went wrong, Try again later";
}
header('Location: ../faculty_management.php');
exit();