<?php
session_start();
include "../config/database.php";
if(isset($_SESSION['name'])){
include "sidebar.php";
?>
<?php 
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
                    <h4 class="mb-4">Edit Category</h4>
                    <div class="preview-img"></div>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <?php
                        $cid = $_GET['id'];
                        $sql_query = "SELECT * FROM category WHERE category_id = '$cid'";
                        $sql_query_run = mysqli_query($connect, $sql_query);
                        // check to see if the database is empty
                        if(mysqli_num_rows($sql_query_run) > 0){
                            while($rows = mysqli_fetch_array($sql_query_run)){
                        ?>
                                <div class="mb-3 mt-3">
                                    <label for="category-name">Category name</label>
                                    <input type="hidden" name="category-id" value="<?= $rows['category_id']?>">
                                    <input type="text" name="category-name" id="category-id" class="form-control" value="<?= $rows['category_name']?>">
                                </div>
                                <div class="mb-3">
                                    <label for="category-image">Category Image</label>
                                    <input type="file" name="category-image" id="category-image" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <img src="categoryImage/<?= $rows['category_image']?>" alt="category image" width="100px" height="100px">
                                    <input type="hidden" name="old-image" value="<?= $rows['category_image']?>">
                                </div>
                                <div class="mb-3 mt-4">
                                    <input type="submit" value="Update" class="btn btn-primary" name="update-category-btn">
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
        const productImage = document.querySelector("#category-image");

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
                iziToast.success({
                            title: "Success",
                            icon: "bi bi-check2-circle",
                            message: "<?= $_SESSION['msg']?>",
                            position: 'topRight'
                        });
            <?php    
            unset($_SESSION['msg']);
            }
            if (isset($_SESSION['error'])){
            ?>
                iziToast.error({
                                title: "Error",
                                icon: 'bi bi-x-circle',
                                message: "<?= $_SESSION['error']?>",
                                position: "topRight"
                            }) 
            <?php
            unset($_SESSION['error']);
            }
            ?>
    </script>
<?php
}else{
    echo "<center><b>No id found</b></center>";
}
}else{
    $_SESSION['message'] = "You are not logged in";
    header("Location: login.php");
    die();
}
?>