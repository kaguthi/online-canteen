<?php
session_start();
include "../config/database.php";
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$password = $_POST['password'];

// sending the data to the database
$user_details = mysqli_query($connect, "INSERT INTO users (user_id, firstname, lastname, email, telephone, password) VALUES (NULL, '$firstname', '$lastname', '$email', '$telephone', '$password')");
if(!$user_details)
{
    $_SESSION["error"] = "Something Went Wrong";
    header("Location: addUser.php");
    die();
}else{
    $_SESSION["success"] = "User Added Successfully";
    header("Location: user.php");
    die();
}
?>