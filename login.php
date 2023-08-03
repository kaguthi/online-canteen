<html>
    <?php 
    session_start();
    include "utils.php";?>
    <body>
        <div class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <?php 
                        if(isset($_SESSION['message'])){
                            ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?= $_SESSION['message']; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php
                            unset($_SESSION['message']);
                        }?>
                        <div class="card shadow">
                            <div class="card-header">
                                <h2>Login</h2>
                            </div>
                            <div class="card-body">
                                <form action="auth.php" method="post">
                                    <div class="mb-3 mt-3">
                                        <label for="email">Enter email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="password">Enter Password</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                        <input type="submit" value="Login" class="btn btn-primary" name="login-btn">
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