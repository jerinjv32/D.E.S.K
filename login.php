<?php
// login.php

// Include the database connection
include('db.php');

// Start the session
session_start();

// Check if the form is submitted    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input
    $college_id = $_POST['college_id'];
    $password = $_POST['password'];
    $role = $_POST['module'];

    // SQL query to fetch user based on college_id and role (no password hashing)
    $sql = "SELECT * FROM users WHERE college_id = ? AND role = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $college_id, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, check the password (plain text)
        $user = $result->fetch_assoc();
        if ($password == $user['password']) {
            // Password matches, login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['college_id'] = $user['college_id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on the role
            if ($user['role'] == 'student') {
                header("Location: student_dashboard.php");
            } elseif ($user['role'] == 'faculty') {
                header("Location: faculty_dashboard.php");
            } elseif ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            }
            exit();
        } else {
            // Invalid password
            $error = "Invalid password!";
        }
    } else {
        // User not found
        $error = "Invalid college ID or role!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login1.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Sign In</h1>
        </div>
        
        <form action="login.php" method="POST">
            <div class="box">
                <h2 id=college_id>College ID</h2>
                <input type="text" id="college_id" name="college_id" placeholder="Enter College ID" required>
                
                <h2 id="passwordtext">Password</h2>
                <input type="password" id="password" name="password" placeholder="Enter password" required>
                
                <select name="module" id="module" required>
                    <option value="student">Student</option>
                    <option value="faculty">Faculty</option>
                    <option value="admin">Admin</option>
                </select>
                
                <button type="submit">Log In</button>

                <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
            </div>
        </form>
    </div>
</body>
</html>
