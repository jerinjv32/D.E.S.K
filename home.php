<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
echo "Welcome " . $_SESSION['user']['name'] . "! You are logged in as a " . $_SESSION['user']['role'];
?>
