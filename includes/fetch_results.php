<?php
header('Content-type: application/json');
include('../db.php');
$results = [];
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $collegeId = $_POST['college_id'] ?? '';
        $sem = $_POST['semester'] ?? '';
        $results = $database->select('results','*',['college_id'=>$collegeId,'semester'=>$sem]);
    }
} catch (PDOException $e) {
    file_put_contents("debugg.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    die("<h1>Something Went Wrong Try again later</h1>");
}
$labels = array_column($results, 'subject_id');
$mark = array_column($results, 'mark');

$json_data = json_encode(['labels'=>$labels,'data'=>$mark]);
?>