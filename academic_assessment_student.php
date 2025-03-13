<?php 
session_start();
include('db.php');
$collegeId = $_SESSION['college_id'];
try {
    $courses = $database->select('course','*');
} catch (PDOException $e) {
    file_put_contents("debugg.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    die("<h1>Something Went Wrong Try again later</h1>");
}
$results = [];
try {
    $results = $database->select('results','*',['college_id'=>$collegeId]);
} catch (PDOException $e) {
    file_put_contents("debugg.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    die("<h1>Something Went Wrong Try again later</h1>");
}
$labels = array_column($results, 'subject_id');
$mark = array_column($results, 'mark');

$json_data = json_encode(['labels'=>$labels,'data'=>$mark]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Assessment</title>
    <style>
        *{
            font-family: poppins;
            margin:0px;
        }
        .nav_bar{
            height: 53px;
            width: 100%;
            background-color: rgb(33, 33, 33);
        }
        .nav_content1{
            display: block;
            padding-left: 225px;
            padding-top: 12px;
            font-size: larger;
            color: white;
        }
        main{
            height: 100px;
            border: 1px black solid;  
            margin: 20px 20px 20px 228px;
            border-radius: 5px;
            padding:20px 10px 0 20px;
            box-shadow: 0 5px 5px rgba(0,0,0,0.25);
            min-height: 700px;
            max-height: 100%;
            overflow: auto;
        }
        #show_results_box{
            border: none;
            background-color: rgb(33, 33, 33);
            color: white;
            border-radius: 3px;
            font-size: 1em;
        }
        #show_results_box:hover{
            cursor: pointer;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Academic Assessment</h3>
    </div>
    <main>
            <canvas id="myChart" style="width: 100px;"></canvas>
            
            <script src="/includes/not_below_1.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const chartData = <?php echo $json_data; ?>;
                console.log('chart data:', chartData);
                
                const labels = chartData.labels;
                const data = chartData.data;
                const ctx = document.getElementById('myChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Student Marks',
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });                
            </script>
        </main>
    </body>
</html>