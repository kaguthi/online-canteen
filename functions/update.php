<?php
session_start();
include "../config/database.php";
if(isset($_POST['product'])){
    $pid = $_POST['product'];
    $userid = $_SESSION['userid'];
    
    // check if the product id exists
    $item_exists = "SELECT * FROM cart WHERE prod_id = '$pid' AND user_id = '$userid'";
    $item_exists_run = mysqli_query($connect, $item_exists);
    if(mysqli_num_rows($item_exists_run) > 0 ){
        $delete_query = "DELETE FROM cart WHERE prod_id = '$pid'";
        $delete_query_run = mysqli_query($connect, $delete_query);
        if($delete_query_run){
            echo 200;
        }else{
            echo "Something Went Wrong";
        }
    }else{
        echo "Something Went Wrong";
    }
}
// update the quantity in the database
else if(isset($_POST['qty'])){
    $prodId = $_POST['product_id'];
    $userid = $_SESSION['userid'];
    $qtyUpdate = $_POST['qty'];

    $item_exists = "SELECT * FROM cart WHERE prod_id = '$prodId' AND user_id = '$userid'";
    $item_exists_run = mysqli_query($connect, $item_exists);
    if(mysqli_num_rows($item_exists_run) > 0 ){
        $update_query = "UPDATE cart SET qty = '$qtyUpdate' WHERE prod_id = '$prodId' AND user_id = '$userid'";
        $update_query_run = mysqli_query($connect, $update_query);
        if($update_query_run){
            echo 200;
        }else{
            echo "Something Went Wrong";
        }
    }else{
        echo "Something Went Wrong";
    }
}
?>