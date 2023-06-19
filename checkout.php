<?php
session_start(); 
include "config/database.php";
$userid = $_SESSION['userid'];
include "utils.php";?>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="index.php">KitchenInn/Checkout</a>
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
<style>
    span{
        font-weight: 500;
        font-size: 58px;
    }
    .payment{
        background-color: green;
        text-align: center;
        padding: 12px;
        width: 100px;
        height: 100px;
    }
</style>
<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="functions/placeorder.php" method="post">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Payment details</h6>
                            <hr>
                            <?php
                            $fetch_user_data = "SELECT * FROM users WHERE user_id = '$userid'";
                            $fetch_user_data_run = mysqli_query($connect, $fetch_user_data);
                            if(mysqli_num_rows($fetch_user_data_run) > 0){
                                $row = mysqli_fetch_array($fetch_user_data_run);?>
                                
                                    <div class="mb-3 mt-3">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control" value="<?= $row['firstname']?>" readonly>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="lastname">Lastname</label>
                                        <input type="text" name="lastname" id="lastname" class="form-control" value="<?= $row['lastname']?>" readonly>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="telephone">Telephone</label>
                                        <input type="tel" name="telephone" id="telephone" class="form-control" placeholder="254712345678" autofocus pattern="[0-9]{12}">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="email">email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="<?= $row['email']?>" readonly>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="payment mode">Select Payment Method</label>
                                        <select name="payment-mode" id="payment-mode" class="form-control">
                                            <option value="mpesa">Mpesa</option>
                                        </select>
                                    </div>
                                    <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-4">
                            <h6>Items</h6>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Name</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Price</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Quantity</p>
                                </div>
                            </div>
                            <hr>
                            <!-- fetch the data from the cart -->
                            <?php
                            $total_price = 0;
                            
                            $select_query = "SELECT c.prod_id as cprod, c.qty, f.food_id as fid, f.food_image, f.food_name, f.food_price FROM cart c, food f WHERE c.prod_id =f.food_id AND c.user_id = '$userid'";
                            $select_query_run = mysqli_query($connect, $select_query);
                            foreach($select_query_run as $items){
                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><?= $items['food_name']?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><?= $items['food_price']?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><?= $items['qty']?></p>
                                    </div>
                                </div>
                                <?php
                                $total_price += $items['food_price'] * $items['qty'];
                            }
                            ?>
                            <hr>
                            <!-- calculate total price -->
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Total Price:</h6>
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" name="total_price" value="<?= $total_price?>">
                                    <h6><?= $total_price?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 mt-3">
                                        <input type="submit" value="Confirm and Place Order" class="btn btn-primary" name="checkout">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>