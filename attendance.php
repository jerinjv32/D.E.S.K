<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
        
        .my_table{
            border-collapse: collapse;
            font-size: 0.9em;
            margin: 25px 0;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 5px 5px rgba(0,0,0,0.15);
        }
        .my_table thead tr{
            background-color: rgb(33, 33, 33);
            color: #ffffff;
            font-weight: bold;
        }
        .my_table th, .my_table td{
            padding: 15px 15px;
            min-width: 214px;
            border-bottom: solid #dddddd;
        }
        .my_table tbody tr{
            text-align: center;
            background-color:rgb(236, 236, 236);
        }
        .my_table tbody tr:nth-child(even){
            background-color: white;
        }
        #upload_btn{
            background-color: rgb(33,33,33);
            color: white;border-style: none;
            border-radius: 3px;
            font-size: medium;
        }
        #upload_btn:hover{
            background-color: rgb(0, 170, 255);
            transition: background-color .25s ease-in-out;
            color: black;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Course Management</h3>
    </div>
    <main>
        <label for="course_text" style="font-size: 14px;padding-right:10px;">Course:</label>
        <input type="text" name="course_name" id="course_text" required>
        <label for="semester_text" style="font-size: 14px;padding: 2px 2px 0 14px;">Semester:</label>
        <input type="number" name="semester" id="semester_text" required><br><br>
        <label for="date_chose" style="font-size: 14px;padding-right: 27px;padding-top:2px">Date:</label>
        <input type="date" name="date" id="date_chose" required><br><br>
        <input type="submit" id="upload_btn" value="+ upload"><br>
        <hr style="margin: 10px 10px 0 auto;">
        <table class="my_table"style="margin-top:50px;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subject Name</th>
                    <th>Semester</th>
                    <th>Attendance %</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Geetha Ravikumar</td>
                    <td>Compiler Design</td>
                    <td>6</td>
                    <td>90%</td>
                </tr>
                <tr>
                    <td>Nimisha Sabu</td>
                    <td>Compiler Design</td>
                    <td>6</td>
                    <td>86%</td>
                </tr>
                <tr>
                    <td>Naveen Krishnajith</td>
                    <td>Compiler Design</td>
                    <td>6</td>
                    <td>78%</td>
                </tr>
            </tbody>
        </table>
        
    </main>
</body>
</html>