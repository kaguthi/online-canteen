<nav class="navbar navbar-expand-lg bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">KitchenInn</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end barnav" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item" style="position: relative;">
            <a class="nav-link" href="cart.php"><i class='bx bx-cart text-white' style="font-size: 25px;"></i></a>
            <span class="text-white">0</span>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="order.php">My Orders</a>
        </li>
        <?php 
        // check if the user is logged in
        if(isset($_SESSION['userid'])){
          ?>
          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?= $_SESSION['uname'];?>
                  <img class="profile_image" src="profile_image/download.png">
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <li class="nav-item">
            <a class="nav-link text-white" href="logout.php"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="logout.php"></a>
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