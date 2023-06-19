<html>
<?php 
session_start();
include "utils.php";?>
    <body>
        <div class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <?php if(isset($_SESSION['message'])){?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['message'];?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                        unset($_SESSION['message']);
                        }?>
                        <div class="card shadow">
                            <div class="card-header">
                                <h2>Register</h2>
                            </div>
                            <div class="card-body">
                                <form action="auth.php" method="post">
                                    <div class="mb-2 mt-2">
                                        <label for="firstname">Enter firstname</label>
                                        <input type="text" name="firstname" id="firstname" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="firstname">Enter lastname</label>
                                        <input type="text" name="lastname" id="lastname" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="firstname">Enter email</label>
                                        <input type="email" name="email" id="email" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="telephone">Enter telephone</label>
                                        <input type="tel" name="telephone" id="telephone" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="password">Enter password</label>
                                        <input type="password" name="password" id="password" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="password">Confirm password</label>
                                        <input type="password" name="repassword" id="repassword" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" value="Sign Up" class="btn btn-primary" name="sign-up-btn">
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