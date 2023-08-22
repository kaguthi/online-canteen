<?php
session_start();
include "../config/database.php";
// check to see if the user is logged in
if(isset($_SESSION['uname'])){
    // fetch the product id
    $product_id = $_POST['id'];
    $userid = $_SESSION['userid'];
    // check if a product exists
    $product_exists = "SELECT * FROM cart WHERE prod_id = '$product_id'";
    $product_exists_run = mysqli_query($connect, $product_exists);
    if(mysqli_num_rows($product_exists_run) > 0){
        echo "exists";
    }else{
        // insert the data to the database
        $insert_data = "INSERT INTO cart (prod_id, user_id) VALUES ('$product_id', '$userid')";
        $insert_data_run = mysqli_query($connect, $insert_data);
        if($insert_data_run){
            echo 201;
        }else{
            echo 500;
        }
    }
}
else{
    echo 401;
}

?>