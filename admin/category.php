<?php
session_start();
include "../config/database.php";
if(isset($_SESSION["name"])){
include "sidebar.php";
?>
<body>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded p-4 h-100">
                    <h4 class="mb-4">Category Table</h4>
                    <div class="table-responsive">
                        <table class="table" id="category-table">
                            <thead>
                                <tr>
                                    <th>Category_id</th>
                                    <th>Category name</th>
                                    <th>Category image</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            // fetch the data from the database
                            $sql_query = "SELECT * FROM category";
                            $sql_query_run = mysqli_query($connect, $sql_query);
                            if(mysqli_num_rows($sql_query_run) > 0){
                                while($rows = mysqli_fetch_array($sql_query_run)){
                                    ?>

                                    <tr>
                                        <td><?= $rows['category_id']?></td>
                                        <td><?= $rows['category_name']?></td>
                                        <td><img src="categoryImage/<?= $rows['category_image']?>" alt="category image" width="50px" height="50px" style="border: 1px solid black;"></td>
                                        <td>
                                            <!-- <button class="btn btn-warning">Edit</button> -->
                                            <a href="editCategory.php?id=<?= $rows['category_id']?>" class="btn btn-warning">Edit</a>
                                            <button class="btn btn-danger delete-category" value="<?= $rows['category_id']?>" name="delete-category">Delete</button>
                                        </td>
                                    </tr>
                            <?php
                                }

                            }else{
                                echo "No data found";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#category-table").DataTable();
        })
    </script>
    <script>
        $(document).ready(function(){
            $(".delete-category").click(function(event){
                event.preventDefault();
                var id = $(this).val();
                // console.log(id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover the file once deleted',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result)=>{
                    if(result.isConfirmed){
                        $.ajax({
                            url: "upload.php",
                            method: "POST",
                            data: {
                                id:id,
                                delete: 'delete-category'
                            },
                            success:function(response){
                                console.log(response);
                                if(response == 200){
                                    Swal.fire('Success','Your file is deleted successfully','success');
                                    $("#category-table").load(location.href + " #category-table");
                                }else if(response == 500){
                                    Swal.fire('Error','Something went wrong','error');
                                }
                            }
                        })
                    }
                })
            });
        });
    </script>
    <!-- footer -->
    <?php include "footer.php";?>
</body>
<?php
}else{
    $_SESSION['message'] = "You are not logged in";
    header("Location: login.php");
    die();
}
?>