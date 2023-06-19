<?php
session_start();

if(isset($_SESSION['uname'])){
    unset($_SESSION['uname']);
    unset($_SESSION['userid']);
    $_SESSION['message'] = "You're logged out!!!";
}
header("Location: index.php");
?>