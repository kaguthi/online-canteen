<html>
    <?php 
    session_start();
    include "utils.php";?>
    <body>
        <div class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-header">
                                <h2>OTP Verification</h2>
                            </div>
                            <div class="card-body">
                                <h3>Check your email for the Code</h3>
                                <form action="verify.php" method="post">
                                    <div class="mb-3 mt-3">
                                        <label for="email">Enter OTP Code</label>
                                        <input type="number" name="otp-code" id="otp-code" class="form-control">
                                    </div>
                                    <?php
                                    // echo $_SESSION['otp'];
                                    ?>
                                    <div class="mb-3">
                                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                        <input type="submit" value="Verify" class="btn btn-primary" name="verify-btn">
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