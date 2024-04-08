<?php
session_start();
if(isset($_SESSION["userid"])){
    include "utils.php";
    include "config/database.php";
?>
<?php
}else{
    $_SESSION["message"] = "Login first";
    header("Location: login.php");
    die();
}
?>
