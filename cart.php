<?php
session_start(); 
include "config/database.php";
if(isset($_SESSION['userid'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart page</title> 
</head>
<body>
    <?php include "utils.php";?>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php">KitchenInn/Cart</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <?php 
                if(isset($_SESSION['uname'])){
                    ?>
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" href="login.php"><?= $_SESSION['uname'];?></a>
                </li>
                    <?php
                }else{
                    echo "<pclass='text-white'>login first</p>";
                }
                    ?>
            </ul>
            </div>
        </div>
    </nav>

    <!-- fetch the data from the database -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <h6>Product Image</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Product name</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Product Price</h6>
                        </div>
                        <div class="col-md-3">
                            <h6>Quantity</h6>
                        </div>
                        <div class="col-md-3">
                            <h6>Action</h6>
                        </div>
                    </div>

                    <hr>
                    <div id="mycart">
                        <?php
                        $userid = $_SESSION['userid'];
                        $fetch_data = "SELECT c.prod_id as cprod, c.qty, f.food_id as fid, f.food_image, f.food_name, f.food_price FROM cart c, food f WHERE c.prod_id =f.food_id AND c.user_id = '$userid'";
                        $fetch_data_run = mysqli_query($connect, $fetch_data);
                        if(mysqli_num_rows($fetch_data_run) < 0){
                            echo '
                                <div class="row">
                                    <h4>No item in the cart</h4>
                                </div>
                            ';
                        }
                        foreach($fetch_data_run as $product){
                            ?>
                                <div class="row align-items-center product-data">
                                    <div class="col-md-2">
                                        <img src="admin/foodImage/<?= $product['food_image'];?>" alt="food image" width="70px" height="50px">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="hidden" name="product-id" value="<?= $product['cprod']?>">
                                        <h6><?= $product['food_name']?></h6>
                                    </div>
                                    <div class="col-md-2">
                                        <h6>ksh.<?= $product['food_price']?></h6>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="hidden" class="prodId" value="<?= $product['cprod'];?>">
                                        <div class="input-group input-group-sm mb-3" style=" width: 100px;">
                                        <button class="input-group-text decrement-btn updateQty">-</button>
                                        <input type="text" class="form-control text-center input-qty" value="<?= $product['qty']?>">
                                        <button class="input-group-text increment-btn updateQty">+</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-danger delete-btn" value="<?= $product['cprod']?>">Delete</button>
                                    </div>
                                </div>
                                <hr>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        <div class="float-end">
            <a href="checkout.php" class="btn btn-primary">proceed to checkout</a>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.delete-btn', function(event){
                event.preventDefault();
                var id = $(this).val();

                $.ajax({
                    url: "functions/update.php",
                    method: "POST",
                    data: {product: id},
                    success:function(response){
                        if(response == 200){
                            iziToast.success({
                                title: "Success",
                                icon: "bi bi-check2-circle",
                                message: "Item deleted successfully",
                                position: "topRight"
                            })
                            $('#mycart').load(location.href + " #mycart");
                        }else if(response){
                            iziToast.error({
                                title: "Error",
                                icon: 'bi bi-x-circle',
                                message: "Something Went Wrong",
                                position: "topRight"
                            })
                        }
                    }
                })
            })
        })
    </script>
    <script src="js/script.js"></script>
</body>
</html>
<?php
}else{
    header("Location: login.php");
    $_SESSION['message'] = "You're Not Logged in Yet";
    die();
}
?>
