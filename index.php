<?php 
session_start();
include "config/database.php";
include "utils.php";?>
<style>
    span{
        position: absolute;
        top: 2px;
        right: 5px;
        background-color: red;
        border-radius: 50%;
        width: 15px;
        height: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }
</style>
<nav class="navbar navbar-expand-lg bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">KitchenInn</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item" style="position: relative;">
            <a class="nav-link" href="cart.php"><i class='bx bx-cart text-white' style="font-size: 25px;"></i></a>
            <span class="text-white">0</span>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="order.php">My Orders</a>
        </li>
        <?php 
        // check if the user is logged in
        if(isset($_SESSION['userid'])){
          ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="logout.php"><?= $_SESSION['uname'];?></a>
          </li>
          <?php
        }else{
          ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="signup.php">Sign Up</a>
          </li>
          <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
<script>
  count_item();
	function count_item(){
		$.ajax({
			url : "functions/updatecart.php",
			method : "POST",
			data : {count_item:1},
			success : function(data){
				$("#badge").html(data);
			}
		})
	}
</script>
<?php
include "home.php";
?>