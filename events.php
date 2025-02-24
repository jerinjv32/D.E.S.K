<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
</head>
<body>
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
            min-height: 430px;
            max-height: 100%;
            overflow: auto;
        }
        #event_publish_btn:hover{
            cursor: pointer;
            box-shadow: 0 0 5px rgba(0,0,0,0.25);
            transform: scale(1.05);
        }
    </style>
</body>
<?php include('sidebar.php') ?>
    <div class="nav_bar">
        <h3 class="nav_content1">Events</h3>
    </div>
    <main>
        <form>
            <div>
                <label for="event_name_box" style="padding-right:10px;">Event Name:</label>
                <input type="text" name="event_name" id="event_name_box" required>

                <label for="event_type_box" style="padding-right:10px;padding-left: 20px;">Event type:</label>
                <select name="event_type" id="event_type_box" style="width:150px;height:25px;" required>
                    <option value="exam">Exam</option>
                    <option value="arts">Arts</option>
                    <option calue="other">Other</option>            
                </select><br><br>
                
                <label for="event_id_box" style="padding-right:43px;">Event Id:</label>
                <input type="number" name="event_id" id="event_id_box" required>

                <label for="event_notify_box" style="padding-right:48px;padding-left: 20px;">Notify:</label>
                <select name="event_notify" id="event_notify_box" style="width:150px;height:25px;" required>
                    <option value="all">All</option>
                    <option value="course">Course</option>
                    <option calue="Staffs">Staffs</option>            
                </select><br><br>

                <label for="event_date_box" style="padding-right:20px;">Event Date:</label>
                <input type="date" name="event_date" id="event_date_box" required><br><br>

                <label for="event_details_box" style="padding-right:5px;">Event Details:</label>
                <input type="text" name="event_details" id="event_details_box" style="width: 40vw;padding-bottom: 180px;" required><br><br>

                <input type="submit" value="Publish" name="event_publish" id="event_publish_btn" style="border:none;background-color:rgb(33,33,33);color:white;font-size:large;border-radius:3px;">
            </div>
        </form>
    </main>
</html>