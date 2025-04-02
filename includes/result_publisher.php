<?php
require '../vendor/autoload.php';
require '../db.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $allowedFileTypes = ['xlsx','xls','odf'];

        $filename = $_FILES['file']['tmp_name'];
        $filetype = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);

        if (!in_array($filetype, $allowedFileTypes)) {
            die("<script>window.alert('Invalid File Format');</script>");
        }

        try {
            $reader = IOFactory::createReaderForFile($filename);
            $reader->setReadEmptyCells(false);
            $spreadsheets = $reader->load($filename);

            $sheet = $spreadsheets->getActiveSheet();
            
            $data = $sheet->toArray();
            $headers = $data[0];
            
            foreach (array_slice($data,1) as $row) {
                $sanitized_rows = array_map('htmlspecialchars',$row);
                $values[] = array_combine($headers, $sanitized_rows);
            }
        } catch (Exception $e) {
            file_put_contents("debugg.txt", date('Y-m-d H-i-s')."-". $e->getMessage(). PHP_EOL, FILE_APPEND);
            die("<h1>Something Went Wrong, Try Again Later</h1>");
        }
        try {
            foreach ($values as $value) {
                $database->insert('results',['name'=>$value['name'],'college_id'=>$value['college_id'], 
                            'semester'=>$value['semester'], 'subject_id'=>$value['subject_id'], 
                            'course_id'=>$value['course_id'], 'mark'=>$value['mark'], 'exam_id'=>$value['exam_id']]);
            }
            header('Location:../result.php?check=100');
            exit();
        } catch(PDOException $e) {
            file_put_contents("debugg.txt", date('Y-m-d H-i-s')."-". $e->getMessage(). PHP_EOL, FILE_APPEND);
            header('Location:../result.php?check=101');
            exit();
        }
    }
}