<?php
session_start();
include "../config/database.php";
	//When user is logged in then we will count number of item in cart by using user session id
if (isset($_POST["count_item"])) {
    //When user is logged in then we will count number of item in cart by using user session id
    if (isset($_SESSION["userid"])) {
        $sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[userid]";
    }else{
        echo 0;
    }
    
    $query = mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($query);
    echo $row["count_item"];
    exit();
}
?>