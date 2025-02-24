<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
        .container{
            position: relative;
            display: flex;
            bottom: 67px;
            gap: 4em;
            margin: 2px auto 0 300px;
        }
        .course-btn{
            transform: scale(1.5);
            padding: 12px;
            background-color: rgb(33, 33, 33);
            border-radius: 3px;
            transform: translate(5px,10px);
        }
        .btn-text {
            display: block;
            font-size: 15px;
            font-weight: bold;
            color: #333;
         transform: translate(5px,10px);
        }
        #cbtn1:hover{
            background-color: #009879;
        }
        #cbtn2:hover{
            background-color: #0073e6;
        }
        #cbtn3:hover{
            background-color: #e6002e;
        }
        #cbtn1:active,#cbtn2:active,#cbtn3:active{
            background-color: rgb(33, 33, 33);
            opacity: 75%;
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
            min-width: 180px;
            border-bottom: solid #dddddd;
        }
        .my_table tbody tr{
            text-align: center;
            background-color:rgb(236, 236, 236);
        }
        .my_table tbody tr:nth-child(even){
            background-color: white;
        }
        #remove_btn{
            border-style:none;
            background-color:rgb(33, 33, 33);
            border-radius:3px;
            color:white;
        }
        #mark_entry{
            width: 30px;
            background-color: #ffffff;
            border-color: #333;
            border-radius: ;
        }
        #remove_btn:hover{
            background-color:#e6002e;
            cursor: pointer;
        }
        #add_sub_btn{
            border-style:none;
            background-color:rgb(33, 33, 33);
            border-radius:3px;
            color:white;
        }
        #add_sub_btn:hover{
            background-color: #007F66;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Result</h3>
    </div>
    <main>
        <form>
            <label for="course_text" style="font-size: 14px;padding-right:30px;">Select Course:</label>
            <input type="text" name="course_name" id="course_text"><br><br>
            <label for="semester_text" style="font-size: 14px;padding-right:14px;padding-top:2px">Select Semester:</label>
            <input type="number" name="semester" id="semester_text"><br><br>
            <label for="course_text" style="font-size: 14px;padding-right:40px;">Exam Name:</label>
            <input type="text" name="course_name" id="course_text">
            <div class="container">
               
               
               
            </div>
            <hr style="margin: 10px 10px 0 auto;">
        </form>
      
        <table class="my_table"style="margin-top:30px;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>FLAT</th>
                    <th>CN</th>
                    <th>MPMC</th>
                    <th>SS</th>
                    <th>Total</th>
                    <th>edit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Student1</th>
                    <td><input type="text" id="mark_entry"></td>
                    <td><input type="text" id="mark_entry"></td>
                    <td><input type="text" id="mark_entry"></td>
                    <td><input type="text" id="mark_entry"></td>
                    <td><input type="text" id="mark_entry"></td>
                    <td>
                        <form>
                            <button type="submit" value="Remove" id="remove_btn">Save</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <th>Student2</th>
                    <td><input type="text" id="mark_entry"></td>
                    <td><input type="text" id="mark_entry"></td>
                    <td><input type="text" id="mark_entry"></td>
                    <td><input type="text" id="mark_entry"></td>
                    <td><input type="text" id="mark_entry"></td>
                    <td>
                        <form>
                            <button type="submit" value="Remove" id="remove_btn">Save</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <th>Student3</th>
                    <td><input type="text" id="mark_entry"></td>
                    <td><input type="text" id="mark_entry"></td>
                    <td><input type="text" id="mark_entry"></td>
                    <td><input type="text" id="mark_entry"></td>
                    <td><input type="text" id="mark_entry"></td>
                    <td>
                        <form>
                            <button type="submit" value="Remove" id="remove_btn">Save</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <form>
            <br><button type="submit" value="add_sub" id="add_sub_btn">Publish</button>
        </form>
    </main>
</body>
</html>