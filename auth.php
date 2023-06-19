<?php
session_start();
include "config/database.php";
include "functions/function.php";
include "mail.php";
// authenication of users
// register form
if(isset($_POST['sign-up-btn'])){
    // regex
    $name = "/^[a-zA-Z ]+$/";
	$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
    $number = "/^[0-9]+$/";

    // inputs from the users
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    // validate the inputs
    if(!preg_match($name, $firstname)){
        $_SESSION['message'] = $firstname. " is not valid";
        header("Location: signup.php");
        die();
    }
    if(!preg_match($name, $lastname)){
        $_SESSION['message'] = $lastname. " is not valid";
        header("Location: signup.php");
        die();
    }
    if(!preg_match($emailValidation, $email)){
        $_SESSION['message'] = $email. " is not valid";
        header("Location: signup.php");
        die();
    }
    if(!preg_match($number, $telephone)){
        $_SESSION['message'] = $telephone. " is not valid";
        header("Location: signup.php");
        die();
    }
    if($repassword !== $password){
        $_SESSION['message'] = "password don't match";
        header("Location: signup.php");
        die();
    }

    // check for email addresses
    $check_email = "SELECT user_id FROM users WHERE email = '$email' LIMIT 1";
    $check_query = mysqli_query($connect, $check_email);
    $count_email = mysqli_num_rows($check_query);
    if($count_email > 0){
        $_SESSION['message'] = "email address already exist";
        header("Location: signup.php");
        die();
    }else{
        // submit the data to the database
        $submit_query = "INSERT INTO users (user_id, firstname, lastname, email, telephone, password) VALUES (NULL, '$firstname', '$lastname', '$email', '$telephone', '$password')";
        $submit_query_run = mysqli_query($connect, $submit_query);
        if(!$submit_query_run){
            $_SESSION['message'] = "Something Went Wrong";
            header("Location: signup.php");
            die();
        }else{
            header("Location: login.php");
            die();
        }
    }

}
// login form
else if(isset($_POST['login-btn'])){
    // test the values
    function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);

    // check for the credentials
    $get_data = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $get_data_run = mysqli_query($connect, $get_data);
    if(mysqli_num_rows($get_data_run) === 1 ){
        $rows = mysqli_fetch_array($get_data_run);
        if ($rows['email'] === $email && $rows['password'] === $password){
            $_SESSION['userid'] = $rows['user_id'];
            $_SESSION['uname'] = $rows['firstname'];

            // otp generation
            $_SESSION['otp'] = rand(100000,999999);

            $otp = $_SESSION['otp'];
           
            // send the otp to the user
            $mail_status = sendOtp($_POST['email'], $otp);
            if ($mail_status == 1){
                header("Location: authentication.php");
                die();
            }else{
                $_SESSION['message'] = "something went wrong";
            header("Location: login.php");
            die();
            }
        }else{
            $_SESSION['message'] = "email or password invalid try again";
            header("Location: login.php");
            die();
        }
    }else{
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: login.php");
        die();
    }
}

?>
