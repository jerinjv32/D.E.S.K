<?php
include ('../db.php');
$fields = ['name'=>'fname','dob'=>'fdob','gender'=>'fgender','collegeid'=>'college_id',
            'coursename'=>'cname','yearjoin'=>'yoj','mail'=>'email','mobno'=>'fpno',
            'address'=>'address','bloodgroup'=>'blood_group','lang'=>'mother_tongue'];

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
try {
    if (!empty($query)) {
        $insertion = $database->insert("faculty",$query);
    } else {
        throw new Exception("The query was empty");
    }
    if ($insertion) {
        header('Location:../add_new_faculty.php.php');
        die();
    } else {
        throw new Exception("The insertion wasn't successfull");
    }
} catch(PDOException $e) {
    file_put_contents("error_log_faculty.txt",date("Y-m-d H-i-s")."-".$e->getMessage(). PHP_EOL, FILE_APPEND);
    header('Location:../add_new_faculty.php');
    die();
}

?>