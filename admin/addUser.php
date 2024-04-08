<?php
session_start();
include "../config/database.php";
if(isset($_SESSION['name'])){
include "sidebar.php";
?>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Add User</h4>
                <form action="user_add.php" method="post">
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
                    <div class="mb-3">
                        <input type="submit" value="Upload" class="btn btn-primary" name="sign-up-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    <?php
        if(isset($_SESSION["error"])){
            ?>
            iziToast.error({
            title: "Error",
            icon: "bi bi-x-circle",
            message: "<?php echo $_SESSION['error'];?>",
            position: "topRight"
        });
    <?php
    }
    unset($_SESSION["error"]);
    ?>
</script>
<?php
}
else{
    $_SESSION['message'] = "You are not logged in";
    header("Location: login.php");
    die();
}
?>