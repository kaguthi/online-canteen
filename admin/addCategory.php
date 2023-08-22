<?php
session_start();
include "../config/database.php";
if(isset($_SESSION['name'])){
include "sidebar.php";
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
                    <h4 class="mb-4">Add Category</h4>
                    <div class="preview-img"></div>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3 mt-3">
                            <label for="category-name">Category name</label>
                            <input type="text" name="category-name" id="category-id" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="category-image">Category Image</label>
                            <input type="file" name="category-image" id="category-image" class="form-control">
                        </div>
                        <div class="mb-3 mt-4">
                            <input type="submit" value="Submit" class="btn btn-primary" name="add-category-btn">
                        </div>
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
    $_SESSION['message'] = "You are not logged in";
    header("Location: login.php");
    die();
}

?>