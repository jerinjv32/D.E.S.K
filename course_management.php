<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management</title>
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
            min-height: 500px;
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
            padding: 9px;
            background-color: rgb(33, 33, 33);
            border-radius: 3px;
        }
        .btn-text {
            display: block;
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            justify-self: center;
            color: #333;
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
        #remove_btn{
            border-style:none;
            background-color:rgb(33, 33, 33);
            border-radius:3px;
            color:white;
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
        <h3 class="nav_content1">Course Management</h3>
    </div>
    <main>
        <form>
            <label for="course_text" style="font-size: 14px;padding-right:30px;">Course:</label>
            <input type="text" name="course_name" id="course_text"><br><br>
            <label for="semester_text" style="font-size: 14px;padding-right:14px;padding-top:2px">Semester:</label>
            <input type="number" name="semester" id="semester_text"">
            <div class="container">
                <div>
                    <input type="image" src="http://localhost:5500/icons/add_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="add_course" class="course-btn" id="cbtn1">
                    <div class="btn-text">Add Course</div>
                </div>
                <div>
                    <input type="image" src="http://localhost:5500/icons/edit_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="edit_course" class="course-btn" id="cbtn2">
                    <div class="btn-text">Edit Course</div>
                </div>
                <div>
                    <input type="image" src="http://localhost:5500/icons/delete_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="delete_course" class="course-btn" id="cbtn3">
                    <div class="btn-text">Delete Course</div>
                </div>
            </div>
            <hr style="margin: 20px 10px 0 auto;">
        </form>
        <table class="my_table"style="margin-top:50px;">
            <thead>
                <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Semester</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>CST302</td>
                    <td>Compiler Design</td>
                    <td>6</td>
                    <td>
                        <form>
                            <button type="submit" value="Remove" id="remove_btn">Remove</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>CST304</td>
                    <td>Computer Graphics</td>
                    <td>6</td>
                    <td>
                        <form>
                            <button type="submit" value="Remove" id="remove_btn">Remove</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>CST306</td>
                    <td>Algorithm Analysis</td>
                    <td>6</td>
                    <td>
                        <form>
                            <button type="submit" value="Remove" id="remove_btn">Remove</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <form>
            <button type="submit" value="add_sub" id="add_sub_btn">+ Add new subjects</button>
        </form>
    </main>
</body>
</html>