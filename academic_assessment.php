<?php session_start() ?>
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
            min-height: 500px;
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
        <form>
            <div>
                <label for="course_box" style="padding-right: 10px;">Course:</label>
                <input type="text" name="course" id="course_box" placeholder="Enter Course" required>

                <label for="college_id_box" style="padding:0 10px 0 20px;">college id:</label>
                <input type="text" name="college_id" id="college_id_box" placeholder="Enter College Id" required><br><br>

                <label for="subject_box" style="padding:0 7px 0 0;">Subject:</label>
                <select name="subject" id="subject_box" style="width: 130px;height: 25px;" required>
                    <option>Subject 1</option>
                    <option>Subject 2</option>
                    <option>Subject 3</option>
                    <option>subject 4</option>
                    <option>Subject 5</option>
                </select>

                <label for="semester_box" style="padding: 0 11px 0 66px">Semester:</label>
                <input type="number" name="semester" id="semester_box" placeholder="Choose Semester" required><br><br>
                
                <input type="submit" value="Show Results" name="show_results" id="show_results_box">
            </div>
        </form>
    </main>
</body>
</html>