<?php
session_start();
include "utils.php";
if(isset($_POST['verify-btn'])){
    if($_POST['otp-code'] == $_SESSION['otp']){
        header("Location: index.php");
        die();
    }
    else{
        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'});
                window.replace = 'authenticate.php';
            </script>
        ";
    }
}

?>