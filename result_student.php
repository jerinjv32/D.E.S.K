<?php
    session_start();
    include('db.php');
    $database->pdo->beginTransaction();
    $datas = [];
    $row = [];
    $collegeId = $_SESSION['college_id'];
    try {
        $sem  = $database->get("student","semester",['college_id'=>$collegeId]) ?? '';
        $datas = $database->select('results','*', ['college_id'=>$collegeId]);
        foreach ($datas as $data) {
            $subjects[] = $data['subject_id'];
            $row[$data['name']][$data['subject_id']] = $data['mark'];
        }
        $subjects = array_unique($subjects);
        $database->pdo->commit();
    } catch (PDOException $e) {
        file_put_contents("debugg.txt",date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
        die("<h1>Something Went Wrong Try again later</h1>");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/table.css">
    <link rel="stylesheet" href="/styles/buttons.css">
    <style>
        *{
            margin: 0px;
            font-family: poppins;
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
            min-height: 500px;
            max-height: 100%;
            overflow: auto;
        }
        .my_table td,.my_table th{
            min-width: 5vw;
        }
    </style>
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Results</h3>
    </div>
    <main>
        <h4>Name:<?php echo "" ?></h4>
        <?php if (!empty($row) && !empty($subjects)): ?>
        <table class="my_table"style="margin-top:50px;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Semester</th>
                    <?php foreach ($subjects as $sub): ?>
                        <th><?= $sub ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($row as $name=>$subjectData): ?>
                    <tr>
                        <td><?= $name; ?></td>
                        <td><?= $sem ?></td>
                        <?php foreach ($subjects as $subject): ?>
                            <td><?= $subjectData[$subject] ?? 'N/a'; ?></td>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </main>
    <script src="includes/not_below_1.js"></script>
</body>
</html>