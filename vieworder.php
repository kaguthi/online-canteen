<?php
session_start();
include "config/database.php";
include "utils.php";
if(isset($_SESSION['userid'])){
    if(isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];
        $userId = $_SESSION['userid'];
?>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <h6>
                <a class="navbar-brand text-white" href="index.php">KitchenInn /</a>
                <a class="navbar-brand text-white" href="order.php">Order /</a>
                <a class="navbar-brand text-white" href="#">View Order</a>
            </h6>
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

    <!-- order card details -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary"> 
                            <span class="text-white fs-3">View Order</span>
                            <a href="order.php" class="btn btn-warning float-end">Back</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Order INFO</h5>
                                    <hr>
                                    <!-- fetch order details -->
                                    <?php
                                    $fetch_data = "SELECT * FROM orders WHERE order_id = '$order_id' AND user_id = '$userId'";
                                    $fetch_data_run = mysqli_query($connect, $fetch_data);
                                    if(mysqli_num_rows($fetch_data_run) > 0 ){
                                        $row = mysqli_fetch_array($fetch_data_run);
                                        ?>
                                        <div class="mb-3 mt-3">
                                            <label for="orderId">Order Id</label>
                                            <input type="text" name="order_id" id="order-id" class="form-control" value="<?=$row['order_id']?>" readonly>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="orderNumber">Order Number</label>
                                            <input type="text" name="orderNumber" id="orderNumber" class="form-control" value="<?= $row['order_number']?>" readonly>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="orderNumber">Payment Mode</label>
                                            <input type="text" name="orderNumber" id="orderNumber" class="form-control" value="<?= $row['payment_mode']?>" readonly>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="orderNumber">Total Price</label>
                                            <input type="text" name="orderNumber" id="orderNumber" class="form-control" value="<?= $row['total_price']?>" readonly>
                                        </div>
                                        
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <h5>Order Details</h5>
                                    <hr>
                                    <!-- fetch data from order info and product tables -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product Image</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $query = "SELECT o.id as oid, o.order_id, o.prod_id, o.qty, o.price, o.userid, f.* FROM order_info o, food f WHERE o.userid = '$userId' AND o.order_id = '$order_id' AND o.prod_id = f.food_id";
                                            $query_run = mysqli_query($connect, $query);
                                            if(mysqli_num_rows($query_run)){
                                                foreach ($query_run as $item) {
                                                    ?>
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img src="admin/foodImage/<?= $item['food_image']?>" alt="food image" width="50px" height="50px">
                                                            <?= $item['food_name']?>
                                                        </td>
                                                        <td class="align-middle"><?= $item['price']?></td>
                                                        <td class="align-middle"><?= $item['qty']?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}else{
    echo "No order Id Found";
}
}else{
    header("Location: login.php");
    $_SESSION['message'] = "Login first";
    exit();
}
?>