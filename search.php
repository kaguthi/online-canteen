<?php 
include "config/database.php";
include "functions/function.php";
$text = $_POST["text"];
$output = '';
$search_query = "SELECT * FROM food WHERE food_name LIKE '%$text%'";
$search_query_run = mysqli_query($connect, $search_query);
if(mysqli_num_rows($search_query_run) < 1){
    $output .= "<h3 class='text-center my-3'>No results for ".$text."</h3>";
}
while($rows= mysqli_fetch_array($search_query_run)){
    $output .= search($rows['food_image'], $rows['food_price'], $rows['food_name']);
}
?>