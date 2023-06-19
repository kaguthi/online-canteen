<?php 
// function to search of items in the database
function search($image, $price, $name){
    $response = '
    <div class="col-md-3 mb-2">
        <div class="card rounded shadow">
            <div class="card-body">
                <img src="admin/foodImage/'.$image.'" alt="food image" class="w-100" height="150px">
                <h6>Name: '.$name.'</h6>
                <p>Price: '.$price.'</p>
                <button class="btn btn-success center mb-1">Add to cart</button>
            </div>
        </div>
    </div>
    ';
    echo $response;
}

function getCartItems(){
    global $con;
    // $fetch_data = "SELECT c.prod_id as cprod, f.food_id as fid, f.food_image FROM cart c, food f WHERE c.prod_id =f.food_id AND c.user_id = '$userid'";

}
?>