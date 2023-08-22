<?php
session_start();
include "../config/database.php";
// add category
if(isset($_POST['add-category-btn'])){

    // regex
    $name = "/^[a-zA-Z ]+$/";

    $target_dir = "categoryImage/";

    $category_name = $_POST['category-name'];
    $target_file = $_FILES['category-image']['name'];

    $image_file = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // validate the name
    if (!preg_match($name, $category_name)){
        $_SESSION['error'] = $category_name." is not valid";
        header("Location: addCategory.php");
        die();
    }
    // validate the image
    if($image_file != "jpg" && $image_file != "png" && $image_file != "jpeg"){
        $_SESSION['error'] = "Sorry, only PNG, JPG and JPEG allowed";
        header("Location: addCategory.php");
        die();
    }
    if(file_exists(($target_dir."/".$target_file))){
        $_SESSION['error'] = "File already exists";
        header("Location: addCategory.php");
        die();
    }

    $sql_query = "INSERT INTO category (category_id, category_name, category_image) VALUES (NULL, '$category_name', '$target_file')";
    $sql_query_run = mysqli_query($connect, $sql_query);
    if($sql_query_run){
        move_uploaded_file($_FILES['category-image']['tmp_name'], $target_dir."/".$target_file);
        $_SESSION['msg'] = "Details uploaded successfully";
        header("Location: addCategory.php");
        die();
    }else{
        $_SESSION['error'] = "Something went wrong";
        header("Location: addCategory.php");
        die();
    }
}
// add found
else if(isset($_POST['add-food-btn'])){
    // directory to store the image
    $target_dir = "foodImage/";

    $food_name = $_POST['food-name'];
    $food_price = $_POST['food-price'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // regex
    $name = "/^[a-zA-Z]+$/";

    // validate the input
    if(!preg_match($name, $food_name)){
        $_SESSION['error'] = $food_name." is not valid";
        header("Location: addFood.php");
        die();
    }

    $target_file = $_FILES['food-image']['name'];
    $image_file = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // validate the image
    if(file_exists($target_dir."/".$target_file)){
        $_SESSION['error'] = "image already exists";
        header("Location: addFood.php");
        die();
    }
    if($image_file != "jpg" && $image_file != "png" && $image_file != "jpeg"){
        $_SESSION['error'] = "Sorry, only PNG, JPG and JPEG are allowed";
        header("Location: addFood.php");
        die();
    }

    // submit the data to the database
    $sql_query = "INSERT INTO food (food_id, food_name, food_image, food_price, category, description) VALUES (NULL, '$food_name', '$target_file', '$food_price', '$category', '$description')";
    $sql_query_run = mysqli_query($connect, $sql_query);
    if($sql_query_run){
        move_uploaded_file($_FILES['food-image']['tmp_name'], $target_dir."/".$target_file);
        $_SESSION['msg'] = "Deatils uploaded Successfully";
        header("Location: addFood.php");
        die();
    }else{
        $_SESSION['error'] = "Something went wrong";
        header("Location: addFood.php");
        die();
    }
}
// edit category
else if(isset($_POST['update-category-btn'])){
    $category_id = $_POST['category-id'];
    $category_name = $_POST['category-name'];

    // regex
    $name = "/^[a-zA-Z]+$/";

    $target_dir = "categoryImage/";
    $new_image = $_FILES['category-image']['name'];
    $old_image = $_POST['old-image'];
    $image_file = strtolower(pathinfo($new_image, PATHINFO_EXTENSION));

    if($new_image != ""){
        $update_filename = $new_image;
    }else{
        $update_filename = $old_image;
    }

    // validate the input
    if(!preg_match($name, $category_name)){
        $_SESSION['error'] = $category_name." is not valid";
        header("Location: editCategory.php?id=$category_id");
        die();
    }

    // submit the details
    $update_query = "UPDATE category SET category_name = '$category_name', category_image = '$update_filename' WHERE category_id = '$category_id'";
    $update_query_run = mysqli_query($connect, $update_query);
    if($update_query_run){
        if($_FILES['category-image']['name'] != ""){
            move_uploaded_file($_FILES['category-image']['tmp_name'], $target_dir."/".$new_image);
            if(file_exists($target_file."/".$old_image)){
                unlink($target_dir."/".$old_image);
            }
        }
        $_SESSION['msg'] = "Details updated successfully";
        header("Location: editCategory.php?id=$category_id");
        die();
    }else{
        $_SESSION['error'] = "Something went wrong";
        header("Location: editCategory.php?id=$category_id");
        die();
    }
}
// delete category
else if(isset($_POST['delete'])){
    $category_id = $_POST['id'];
    
    // fetch the data from the database
    $fetch_data = "SELECT * FROM category WHERE category_id = '$category_id'";
    $fetch_data_run = mysqli_query($connect, $fetch_data);
    $category_data = mysqli_fetch_array($fetch_data_run);

    $target_dir = "categoryImage/";
    $image = $category_data['category_image'];

    // delete query
    $delete_query = "DELETE FROM category WHERE category_id = '$category_id'";
    $delete_query_run = mysqli_query($connect, $delete_query);
    if($delete_query_run){
        if(file_exists($target_dir."/".$image)){
            unlink($target_dir."/".$image);
        }
        echo 200;
    }else{
        echo 500;
    }
}
// edit food
else if(isset($_POST['update-food-btn'])){
    $food_id = $_POST['food-id'];
    $food_name = $_POST['food-name'];
    $food_price = $_POST['food-price'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // image
    $new_image = $_FILES['food-image']['name'];
    $old_image = $_POST['old-image'];

    $target_dir = "foodImage/";

    if($new_image != ""){
        $update_filename = $new_image;
    }else{
        $update_filename = $old_image;
    }

    // regex
    $name = "/^[a-zA-Z]+$/";

    // validate the input
    if(!preg_match($name, $food_name)){
        $_SESSION['error'] = $food_name." is not valid";
        header("Location: editFood.php?id=$food_id");
        die();
    }

    // update query
    $update_query = "UPDATE food SET food_name = '$food_name', food_image = '$update_filename', food_price = '$food_price', category = '$category',description = '$description' WHERE food_id = '$food_id'";
    $update_query_run = mysqli_query($connect, $update_query);
    if($update_query_run){
        if($_FILES['food-image']['name'] != ""){
            move_uploaded_file($_FILES['food-image']['tmp_name'], $target_dir."/".$new_image);
            if(file_exists($target_dir."/".$old_image)){
                unlink($target_dir."/".$old_image);
            }
        }
        $_SESSION['msg'] = "Updated Successfully";
        header("Location: editFood.php?id=$food_id");
        die();
    }else{
        $_SESSION['error'] = "Something went wrong";
        header("Location: editFood.php?id=$food_id");
        die();
    }
}
// delete food
else if(isset($_POST['deleteFood'])){
    $fid = $_POST['id'];

    // fetch the image from the database
    $fetch_data = "SELECT * FROM food WHERE food_id = '$fid'";
    $fetch_data_run = mysqli_query($connect, $fetch_data);

    $food_data = mysqli_fetch_array($fetch_data_run);

    $image = $food_data['food_image'];

    $target_dir = "foodImage/";

    // delete query
    $delete_query = "DELETE FROM food WHERE food_id = '$fid'";
    $delete_query_run = mysqli_query($connect, $delete_query);
    if($delete_query_run){
        if(file_exists($target_dir."/".$image)){
            unlink($target_dir."/".$image);
        }
        echo 200;
    }else{
        echo 500;
    }
}
?>