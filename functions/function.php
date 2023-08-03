<?php 
// function to search of items in the database
function search($image, $price, $name){
    $response = '
    <div class="col-md-3 mb-2">
        <div class="card rounded shadow">
            <img src="admin/foodImage/'.$image.'" alt="food image" class="w-100" height="150px">
            <div class="card-body">
                <h6>Name: '.$name.'</h6>
                <p>Price: '.$price.'</p>
                <i class="bx bxs-star"></i>
                <i class="bx bxs-star"></i>
                <i class="bx bxs-star"></i>
                <i class="bx bxs-star-half"></i>
                <button class="btn btn-primary center mb-1">Add to cart</button>
            </div>
        </div>
    </div>
    ';
    echo $response;
}
?>