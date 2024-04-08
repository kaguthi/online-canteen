<?php
session_start();
include "../config/database.php";
if(isset($_SESSION['name'])){
include "sidebar.php";
?>
<body>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h4 class="mb-6">Users Table</h4>
                    <div class="table-responsive">
                    <a href="addUser.php" class="btn btn-primary mb-2"><i class="bi bi-plus-circle"></i> New User</a>
                        <table class="table table-striped table-bordered" id="user-table">
                            <thead>
                                <tr>
                                    <th>User_id</th>
                                    <th>Username</th>
                                    <th>lastname</th>
                                    <th>email</th>
                                    <th>telephone</th>
                                    <th>password</th>
                                    <th>options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- query the database -->
                                <?php 
                                $get_data = "SELECT * FROM users";
                                $get_data_run = mysqli_query($connect, $get_data);
                                if(mysqli_num_rows($get_data_run) > 0){
                                    while($rows = mysqli_fetch_array($get_data_run)){
                                        ?>
                                        <tr>
                                            <td><?= $rows['user_id']?></td>
                                            <td><?= $rows['firstname']?></td>
                                            <td><?= $rows['lastname']?></td>
                                            <td><?= $rows['email']?></td>
                                            <td><?= $rows['telephone']?></td>
                                            <td><?= $rows['password']?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning edit-btn"><i class="bi bi-pencil-square"></i></button>
                                                <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }else{
                                    echo "no data found";
                                }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- class modal -->
    <div class="modal fade" id="edit-user">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="editUser.php" method="post" id="edit-form">
                        <div class="mb-3 mt-3">
                            <input type="hidden" name="userid" id="userid" class="form-control">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" id="lastname" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="telephone">telephone</label>
                            <input type="tel" name="telephone" id="telephone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Update" class="btn btn-primary" name="update-btn">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php include "footer.php";?>
</body>
<script>
    $(document).ready(function(){
        $("#user-table").DataTable({
			buttons: [
                {
                    extend: 'copy',
                    text: 'Copy current page',
                    exportOptions:{
                        modifier: {
                            page: 'current'
                        }
                    }
                }
            ]
		}
		);
    });
</script>
<script>    
    $(".edit-btn").on('click', function(){
        $("#edit-user").modal("show");
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            // console.log(data);

            $("#userid").val(data[0]);
            $("#username").val(data[1]);
            $("#lastname").val(data[2]);
            $("#email").val(data[3]);
            $("#telephone").val(data[4]);
            $("#password").val(data[5]);
    });
;
</script>
<script>
    <?php 
    if(isset($_SESSION["success"])){
        ?>
        iziToast.success({
            title: "Success",
            icon: "bi bi-check2-circle",
            message: "<?php echo $_SESSION['success'];?>",
            position: "topRight"
        });
    <?php
    }
    unset($_SESSION["success"]);
    ?>
</script>
<?php
}else{
    $_SESSION['message'] = "You are not logged in";
    header("Location: login.php");
    die();
}
?>