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
                    <h4 class="mb-4">Food Table</h4>
                    <div class="table-responsive">
                        <a href="addFood.php" class="btn btn-primary mb-2"><i class="bi bi-plus-circle"></i> New Food</a>
                        <table class="table" id="food-table">
                            <thead>
                                <tr>
                                    <th>Food_id</th>
                                    <th>Food name</th>
                                    <th>Food image</th>
                                    <th>Food price</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- fetch the data from the database -->
                                <?php
                                $sql_query = "SELECT * FROM food";
                                $sql_query_run = mysqli_query($connect, $sql_query);
                                if(mysqli_num_rows($sql_query_run) > 0){
                                    while($rows = mysqli_fetch_array($sql_query_run)){
                                        ?>
                                        <tr>
                                            <td><?= $rows['food_id']?></td>
                                            <td><?= $rows['food_name']?></td>
                                            <td><img src="foodImage/<?= $rows['food_image']?>" alt="food image" width="50px" height="50px"></td>
                                            <td><?= $rows['food_price']?></td>
                                            <td><?= $rows['category']?></td>
                                            <td><?= $rows['description']?></td>
                                            <td>
                                                <a href="editFood.php?id=<?= $rows['food_id']?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                <button type="button" class="btn btn-danger delete-food-btn" name="delete-food-btn" value="<?= $rows['food_id']?>"><i class="bi bi-trash"></i></button>
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
    <?php include "footer.php";?>
    <script>
        $(document).ready(function(){
            $("#food-table").DataTable();
        })
    </script>
    <script>
        $(document).ready(function(){
            $(".delete-food-btn").click(function(event){
                event.preventDefault();
                var id = $(this).val();
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover the file once deleted',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) =>{
                    if(result.isConfirmed){
                        $.ajax({
                            url: "upload.php",
                            method: "POST",
                            data: {
                                id:id,
                                deleteFood: 'delete-food-btn'
                            },
                            success:function(response){
                                console.log(response);
                                if(response == 200){
                                    Swal.fire('Success','Your file is deleted successfully','success');
                                    $("#food-table").load(location.href + " #food-table");
                                }else if(response == 500){
                                    Swal.fire('Error','Something went wrong','error');
                                }
                            }
                        })
                    }
                })
            })
        })
    </script>
</body>
<?php
}else{
    $_SESSION['message'] = "You are not logged in";
    header("Location: login.php");
    die();
}
?>