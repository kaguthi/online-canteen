<?php
session_start();
include "../config/database.php";
if(isset($_SESSION['name'])){
include "sidebar.php";
if(isset($_GET['id'])){
?>
<style>
    .preview-img{
        width: 200px;
        height: 200px;
        border: 1px solid #ccc;
    }
    .preview-img img{
        width: 200px;
        height: 200px;
    }
</style>
<body>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h4 class="mb-4">Edit Food</h4>
                    <div class="preview-img"></div>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <?php
                        $fid = $_GET['id'];
                        $fetch_data = "SELECT * FROM food WHERE food_id = '$fid'";
                        $fetch_data_run = mysqli_query($connect, $fetch_data);
                        if(mysqli_num_rows($fetch_data_run) > 0){
                            while($row = mysqli_fetch_array($fetch_data_run)){
                        ?>
                            <div class="mb-3 mt-3">
                                <label for="food-name">Food Name</label>
                                <input type="text" name="food-name" id="food-name" class="form-control" value="<?= $row['food_name']?>">
                                <input type="hidden" name="food-id" value="<?= $row['food_id']?>">
                            </div>
                            <div class="mb-3">
                                <label for="Food-image">Food Image</label>
                                <input type="file" name="food-image" id="food-image" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="old-image" value="<?= $row['food_image']?>">
                                <img src="foodImage/<?= $row['food_image']?>" alt="food image"width="100px" height="100px">
                            </div>
                            <div class="mb-3">
                                <label for="food-price">Food Price</label>
                                <input type="number" name="food-price" id="food-price" class="form-control" value="<?= $row['food_price']?>">
                            </div>
                            <div class="mb-3">
                                <label for="Category">Category</label>
                                <select name="category" class="form-control">
                                    <?php
                                    $sql_run = "SELECT * FROM category";
                                    $sql_run_query = mysqli_query($connect, $sql_run);
                                    if(mysqli_num_rows($sql_run_query) > 0){
                                        while($rows = mysqli_fetch_array($sql_run_query)){
                                            ?>
                                            <option value="<?= $rows['category_name']?>"><?= $rows['category_name']?></option>
                                        <?php
                                        }
    
                                    }else{
                                        echo "No data found";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control"><?= $row['description']?></textarea>
                            </div>
                            <div class="mt-6 mb-4">
                                <input type="submit" value="Update" class="btn btn-primary" name="update-food-btn">
                            </div>
                        <?php
                            }
                        }else{
                            echo "No data found";
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const previewImg = document.querySelector(".preview-img");
        const productImage = document.querySelector("#food-image");

        productImage.addEventListener('change', function(){
            const image = this.files[0];
            // console.log(image);
            const reader = new FileReader();
            reader.onload = () =>{
                const imgUrl = reader.result;
                const img = document.createElement('img');
                img.src = imgUrl;
                previewImg.appendChild(img);
            }
            reader.readAsDataURL(image);
            });
    </script>
    <script>
        <?php
            if(isset($_SESSION['msg'])){?>
                alertify.set('notifier','position', 'top-right');
                alertify.success('<?= $_SESSION['msg']?>');
            <?php    
            unset($_SESSION['msg']);
            }
            if (isset($_SESSION['error'])){
            ?>
                alertify.set('notifier','position', 'top-right');
                alertify.error("<?= $_SESSION['error']?>"); 
            <?php
            unset($_SESSION['error']);
            }
            ?>
    </script>
    <?php include "footer.php"; ?>
</body>
<?php
}else{
    echo "<center><b>No data found</b></center>";
}
}else{
    $_SESSION['message'] = "You are not logged in";
    header("Location: login.php");
    die();
}
?>