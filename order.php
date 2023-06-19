<?php
session_start();
include "config/database.php";
include "utils.php";
if(isset($_SESSION['userid'])){
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php">KitchenInn/Order</a>
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

    <!-- order details -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Order Number</th>
                                <th>Payment Mode</th>
                                <th>Total Price</th>
                                <th>Created At</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- fetch the data from the database -->
                            <?php
                            $userId = $_SESSION['userid'];
                            $fetch_data = "SELECT * FROM orders WHERE user_id = '$userId' ORDER BY order_id DESC";
                            $fetch_data_run = mysqli_query($connect, $fetch_data);
                            if(mysqli_num_rows($fetch_data_run) > 0){
                                foreach($fetch_data_run as $item){
                                    ?>
                                    <tr>
                                        <td><?= $item['order_id']?></td>
                                        <td><?= $item['order_number']?></td>
                                        <td><?= $item['payment_mode']?></td>
                                        <td><?= $item['total_price']?></td>
                                        <td><?= $item['Created_At']?></td>
                                        <td><a href="vieworder.php?order_id= <?= $item['order_id']?>" class="btn btn-primary">View Details</a></td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                <tr>
                                    <td colspan="6">No Order Available</td>
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
    <?php
}else{
    header("Location: login.php");
    $_SESSION['message'] = "Login first";
    exit();
}
?>