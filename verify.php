<?php
session_start();
if(isset($_POST['verify-btn'])){
    if($_POST['otp-code'] == $_SESSION['otp']){
        header("Location: index.php");
        die();
    }
    else{
        echo "
            <script>
                alert('invalid otp code, please try again');
                window.replace = 'authenticate.php';
            </script>
        ";
    }
}

?>