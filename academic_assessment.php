<?php 
session_start();
include('db.php');
$examId = htmlspecialchars($_POST['exam_id']??'',ENT_QUOTES,'UTF-8');
try {
    $courses = $database->select('course','*');
    $exams = $database->select('events','event_id',['event_type'=>'Exam']);
} catch (PDOException $e) {
    file_put_contents("debugg.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
    die("<h1>Something Went Wrong Try again later</h1>");
}
$results = [];
try {
    if (isset($_POST['show_results'])) {
        $collegeId = htmlspecialchars($_POST['college_id'] ?? '',ENT_QUOTES,'UTF-8');
        $sem = htmlspecialchars($_POST['semester'] ?? '',ENT_QUOTES,'UTF-8');
        $results = $database->select('results','*',['college_id'=>$collegeId,'semester'=>$sem,'exam_id'=>$examId]);
    }
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
    <link rel="stylesheet" href="/styles/table.css">
    <link rel="stylesheet" href="/styles/buttons.css">
    <script src="/includes/fileUpload.js"></script>
    <script src="node_modules/chart.js/dist/chart.umd.js"></script>
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
        <form method='post'>
            <label for="course_box" style="padding-right: 19px;">Course:</label>
            <select name="course_name" id="course_box" style="width: 175px;height:25px;" required>
                <option value="" disabled selected>Choose-></option>
                <?php foreach ($courses as $cname): ?>
                    <option value="<?= $cname['course_id']; ?>"><?= $cname['cname']; ?></option>
                <?php endforeach ?>
            </select>
            <label for="college_id_box" style="padding:0 10px 0 20px;">College id:</label>
            <input type="type" name="college_id" id="college_id_box" placeholder="Enter College id" required><br><br>    
            
            <label for="semester_box">Semester:</label>
            <select name="semester" style="width: 175px;height:25px;" required>
                <option value="" disabled selected>choose-></option>
                <?php for($i=1;$i<=8;$i+=1): ?>
                    <option><?=$i?></option>
                <?php endfor ?>
            </select>
            <label for="exam_id" style="padding: 2px 27px 0 22px;">Exam Id:</label>
            <select id="exam_id" name="exam_id" style="height: 25px;width: 175px;" required>
                    <option value="" disabled selected>Choose-></option>
                    <?php foreach($exams as $exam): ?>
                        <option><?= $exam ?></option>
                    <?php endforeach ?>
            </select><br><br>

            <input type="submit" value="Show Results" name="show_results" class="func_btn">
            </form>
            <br>
            <canvas id="myChart" style="width: 100px;"></canvas>

            <script>
                const chartData = <?php echo $json_data; ?>;
                console.log('chart data:', chartData);
                
                const labels = chartData.labels;
                const data = chartData.data;
                const threshold = 50;
                const barColors = data.map(mark => (mark < threshold ? 'rgba(255, 99, 132, 0.5)' : 'rgba(75, 192, 192, 0.5)'));
                const borderColors = data.map(mark => (mark < threshold ? 'rgba(255, 99, 132, 1)' : 'rgba(75, 192, 192, 1)'));
                const ctx = document.getElementById('myChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: '<?php echo $collegeId ?>',
                            data: data,
                            backgroundColor: barColors, 
                            borderColor: borderColors, 
                            borderWidth: 1

                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Marks'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Subjects'
                                }
                            }
                        }
                    }
                });                
            </script>
        </main>
    </body>
</html>