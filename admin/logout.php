<?php
session_start();

if(isset($_SESSION['name'])){
    unset($_SESSION['name']);
    unset($_SESSION['id']);
    $_SESSION['message'] = "You're logged out!!!";
}
header("Location: login.php");
?>