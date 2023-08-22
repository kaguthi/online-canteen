<?php
session_start();
include "../config/database.php";
include "sidebar.php";
if(isset($_SESSION['name'])){
    if(isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];
        ?>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <span class="fs-3">View Order</span>
                        <a href="order.php" class="btn btn-warning float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Order Info</h5>
                                <hr>
                                <!-- fetch the data from table user and order -->
                                <?php
                                $fetch_query = "SELECT o.*, u.* FROM orders o, users u WHERE order_id = '$order_id' AND o.user_id=u.user_id";
                                $fetch_query_run = mysqli_query($connect, $fetch_query);
                                if(mysqli_num_rows($fetch_query_run) < 0){
                                    echo "No data found";
                                }
                                foreach ($fetch_query_run as $item) {
                                    ?>
                                    <div class="mb-3 mt-3">
                                        <label class="fw-bold">Order Id</label>
                                        <input type="text" class="form-control" value="<?= $item['order_id']?>" readonly>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="fw-bold">Username</label>
                                        <input type="text" class="form-control" value="<?= $item['firstname']?>" readonly>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="fw-bold">Last Name</label>
                                        <input type="text" class="form-control" value="<?= $item['lastname']?>" readonly>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="fw-bold">Email</label>
                                        <input type="text" class="form-control" value="<?= $item['email']?>" readonly>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="fw-bold">Telephone</label>
                                        <input type="text" class="form-control" value="<?= $item['telephone']?>" readonly>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="fw-bold">Order Number</label>
                                        <input type="text" class="form-control" value="<?= $item['order_number']?>" readonly>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="fw-bold">Payment Method</label>
                                        <input type="text" class="form-control" value="<?= $item['payment_mode']?>" readonly>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="fw-bold">Total Price</label>
                                        <input type="text" class="form-control" value="<?= $item['total_price']?>" readonly>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-md-6">
                                <h5>Product Details</h5>
                                <hr>
                                <!-- fetch the data from table order and order_info -->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>Product</td>
                                            <td>price</td>
                                            <td>Quantity</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $fetch_data = "SELECT f.*, oi.* FROM food f, order_info oi WHERE oi.order_id = '$order_id' AND f.food_id = oi.prod_id";
                                        $fetch_data_run = mysqli_query($connect, $fetch_data);
                                        if(mysqli_num_rows($fetch_data_run) < 0){
                                            echo "No data found";
                                        }
                                        foreach ($fetch_data_run as $product) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <img src="foodImage/<?= $product['food_image']?>" alt="food image" width="50px" height="50px">
                                                        <?= $product['food_name']?>
                                                    </td>
                                                    <td><?= $product['food_price']?></td>
                                                    <td><?= $product['qty']?></td>
                                                </tr>
                                            <?php
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
include "footer.php";
}
}else{
    $_SESSION['message'] = "You are not logged in";
    header("Location: login.php");
    die();
}
?>