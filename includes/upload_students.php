<?php
require '../vendor/autoload.php';
require '../db.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!empty($_FILES) && $_FILES['file']['error'] == 0 ) {
        $allowedFileTypes = ['xlsx','xls','odf'];

        $fileName = $_FILES['file']['tmp_name'];
        $fileType = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);

        if(!in_array($fileType, $allowedFileTypes)) {
            header('Location:../student_management.php?check=201');
            exit();
        }

        try {
            $reader = IOFactory::createReaderForFile($fileName);
            $spreadsheets = $reader->load($fileName, $reader::READ_DATA_ONLY | $reader::IGNORE_EMPTY_CELLS);

            $sheet = $spreadsheets->getActiveSheet();
            
            $data = $sheet->toArray();
            $headers = $data[0];
            $headers = array_map('strtolower',$headers);
            
            foreach (array_slice($data,1) as $row) {
                $sanitized_rows = array_map('htmlspecialchars',$row);
                $values[] = array_combine($headers, $sanitized_rows);
            }
        } catch (Exception $e) {
            file_put_contents("debugg.txt", date('Y-m-d H-i-s')."-". $e->getMessage(). PHP_EOL, FILE_APPEND);
            header('Location:../student_management.php?check=200');
            exit();
        }
        //Data entry to the database
        try {
            $database->pdo->beginTransaction();
            foreach ($values as $value) {
                $database->insert('student',['sname'=>$value['name'],'sdob'=>$value['dob'],'gender'=>$value['gender'],
                'college_id'=>$value['college_id'],'adno'=>$value['admission_no'],'cname'=>$value['course_name'],'yoj'=>$value['batch'],
                'semester'=>$value['semester'],'email'=>$value['mail'],'mobno'=>$value['mobile_no'],'address'=>$value['address'],
                'blood_group'=>$value['blood_group'],'mother_tongue'=>$value['mother_tongue'],'resident'=>$value['resident']]);

                $password = $value['college_id'].$value['admission_no'];
                $password = password_hash($password,PASSWORD_DEFAULT); 

                var_dump($value);
                $database->insert('users',['username'=>$value['college_id'],'password'=>$password,'role'=>'student']);
            }
            $database->pdo->commit();
            header('Location:../student_management.php?check=100');
            exit();
        } catch(PDOException $e) {
            $database->pdo->rollBack();
            file_put_contents("debugg.txt", date('Y-m-d H:i:s')."-". $e->getMessage(). PHP_EOL, FILE_APPEND);
            if ($e->getCode() == 23000) {
                header('Location:../student_management.php?check=23000');
                exit();
            } else {
                header('Location:../student_management.php?check=101');
                exit();
            }
        } 
    }
}