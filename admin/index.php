<?php
session_start();
include "../config/database.php";
if (isset($_SESSION['name'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    
</head>

<body>
    <!-- <div class="container-xxl position-relative bg-white d-flex p-0"> -->
            <?php include "sidebar.php";?>
            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-users fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Food</p>
                                <h6 class="mb-0"><?php echo mysqli_num_rows(mysqli_query($connect, "SELECT * FROM food"));?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-users fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total users</p>
                                <h6 class="mb-0"><?php echo mysqli_num_rows(mysqli_query($connect, "SELECT * FROM users"));?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-handshake fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Category</p>
                                <h6 class="mb-0"><?php echo mysqli_num_rows(mysqli_query($connect, "SELECT * FROM category"));?></h6>
                            </div>
                        </div>
                    </div>
                    <?php if(isset($_SESSION['message'])){?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>
                            <?= $_SESSION['message'];?>
                        </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['message']);
                    }
                    ?>
                </div>
            </div>
            <?php include "footer.php";?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <!-- </div> -->
</body>

</html>
<?php
}else{
    $_SESSION['message'] = "You are not logged in";
    header("Location: login.php");
    die();
}
?>