<?php
session_start();
if(isset($_SESSION['name'])){
    $_SESSION['message'] = "You're already logged in";
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <style>
        body{
            background-color: lightgrey;
        }
        input{
            padding: 8px
        }
    </style>
</head>
<body>
    <!-- login form -->
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
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
                    <div class="card">
                        <div class="card-header">
                            <h2>Login</h2>
                        </div>
                        <div class="card-body">
                        <form action="login_details.php" method="post">
                            <div class="mb-3 mt-3">
                                <label for="username" class="">Username</label>
                                <input type="text" name="username" placeholder="Enter Username" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="">Password</label>
                                <input type="password" name="password" placeholder="Enter password" class="form-control">
                            </div>
                            <div class="submit-btn">
                                <input type="submit" value="Login" name="submit-btn" class="btn btn-primary">
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>