<?php

require_once './superAdmin-header.php';
require_once '../assets/PHP/admin-db.php';

$pAdmin = new Admin();

if(isset($_POST['insert_product'])){
    $product_title = $pAdmin->test_input($_POST['product_title']);
    $product_description = $pAdmin->test_input($_POST['product_description']);
    $product_price = $pAdmin->test_input($_POST['product_price']);
    $status = true;
    $product_image = $_FILES['product_image']['name'];
    $tmp_image = $_FILES['product_image']['tmp_name'];

    if($product_title == '' or $product_description == '' or $product_price == '' or $product_image == ''){
        echo "<script>alert('All fields are required')</script>";
    } else {
        $haveProduct = $pAdmin->check_product($product_title);
        if($haveProduct == null){
            $pAdmin->insert_product($product_title, $product_description, $product_image, $product_price, $status);
            move_uploaded_file($tmp_image, "../../images/product_images/$product_image");

            echo "<script>
                Swal.fire({
                    title: 'Category Add Successfully',
                    type: 'success'
                });
                document.getElementById('productAddForm').reset();
            </script>";
        } else {
            echo $pAdmin->showMessage('danger', 'This product already exists');
        }
    }
}

?>

<div class="container mt-5 mx-auto">
    <div class="row">
        <div class="col-md-6">
            <h2>Add New Product</h2>
            <form action="#" id="productAddForm" method="post" class="mt-4" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="product_title">Product Title</label>
                    <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Enter product title" autofocus required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="product_description">Product Description</label>
                    <textarea class="form-control" id="product_description" name="product_description" rows="4" placeholder="Write your description here..." required></textarea>
                </div>
                <div class="form-group">
                    <label for="product_image" class="mr-2">Product Image:</label>
                    <input type="file" name="product_image" id="product_image" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa-solid fa-rupee-sign"></i></span>
                        </div>
                        <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter product price" required autocomplete="off">
                    </div>
                </div>
                <div id="productAddError"></div>
                <div class="form-group">
                    <input type="submit" id="insert_product_btn" class="btn btn-primary btn-lg py-2 px-5" value="ADD" name="insert_product">
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-column align-items-center justify-content-center h-100">
                <div class="preview ">
                    <img src="../../images/default.png" id="img" alt="Preview" style="max-width: 100%; max-height: 300px;">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- footer area -->
</div>
</div>
</div>

<script>
    // Get references to the file input and img elements
    const fileInput = document.getElementById('product_image');
    const img = document.getElementById('img');

    // Add an event listener to the file input element
    fileInput.addEventListener('change', function() {
        // Check if a file is selected
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Set the src attribute of the img element to the selected file's data URL
                img.src = e.target.result;
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(fileInput.files[0]);
        } else {
            // If no file is selected, clear the img src
            img.src = '';
        }
    });
</script>

</body>
</html>
