<?php
include "config/database.php";
?>
<style>
    button{
        width: 95%;
        margin-left: 6px;
    }
    h6,p {
        margin-left: 10px;
        font-size: 14px;
    }
    .card{
        height: 300px;
    }
    .foot{
        top: 0;
    }
</style>
<!-- body -->
<html>
    <head>
        <title>KitchenInn</title>
    </head>
    <body>
        <!-- search box -->
        <div class="py-3">
            <div class="container">
                <div class="col-md-12">
                    <form action="" method="post">
                    <input type="text" name="searchbox" id="searchbox" class="form-control" placeholder="search" autocomplete="off">
                    </form>
                </div>
            </div>
        </div>
        <!-- body  -->
        <div class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row results">
                        <?php
                                $fetch_data = "SELECT * FROM food";
                                $fetch_data_run = mysqli_query($connect, $fetch_data);
                                if(mysqli_num_rows($fetch_data_run) > 0){
                                    while($row = mysqli_fetch_array($fetch_data_run)){
                            ?>
                                    <div class="col-md-3 mb-3">
                                        <div class="card rounded shadow">
                                            <img src="admin/foodImage/<?= $row['food_image']?>" alt="food image" class="w-100" height="160px">
                                            <div class="card-body">
                                                <h6>Name: <?= $row['food_name']?></h6>
                                                <p>Price: <?= $row['food_price']?></p>
                                                <button class="btn btn-primary shadow add-cart-btn" value="<?= $row['food_id']?>">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }}else{
                                    echo "<center><h3>No data found</h3></center>
                                        <div class='spinner-border' style='width: 3rem; height: 3rem;' role='status'>
                                        <span class='visually-hidden'>Loading...</span>
                                    </div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>