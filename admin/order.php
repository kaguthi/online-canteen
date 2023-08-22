<?php
session_start();
include "../config/database.php";
if(isset($_SESSION['name'])){
include "sidebar.php";
?>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">View Order</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="table-data">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <!-- <th>Username</th> -->
                                <th>Payment Mode</th>
                                <th>Total Price</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- fetch the data from users table and order table -->
                            <?php
                            $fetch = "SELECT * FROM orders";
                            $fetch_run = mysqli_query($connect, $fetch);
                            if(mysqli_num_rows($fetch_run) < 0){
                                echo "No data available";
                            }
                            foreach ($fetch_run as $item) {
                              ?>
                                 <tr>
                                    <td><?= $item['order_id']?></td>
                                    <td><?= $item['payment_mode']?></td>
                                    <td><?= $item['total_price']?></td>
                                    <td><?= $item['Created_At']?></td>
                                    <td><a href="vieworder.php?order_id=<?= $item['order_id']?>" class="btn btn-primary">View Details</a></td>
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
<?php
include "footer.php";
?>
<script>
    $(document).ready(function(){
        $('#table-data').DataTable();
    })
</script>
<?php
}else{
    $_SESSION['message'] = "You are not logged in";
    header("Location: login.php");
    die();
}
?>