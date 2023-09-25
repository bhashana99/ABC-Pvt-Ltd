<?php

require_once './superAdmin-header.php';

?>

<div class="container mt-5 mx-auto">
    <div class="row">
        <h2>Add New Product</h2>
    </div>

    <div class="container ">
        <form action="#" id="productAddForm" method="post" class="col-lg-6" enctype="multipart/form-data">
                
                        <div class="form-row mt-2">
                            <label for="product_title" class="form-label">Product Title</label>
                            <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Enter product title" autofocus required autocomplete="off">
                        </div>
                        <div class="form-row mt-2">
                            <label for="product_description" class="form-label">Product description</label>
                            <textarea class="form-control form-control-lg " id="product_description" name="product_description"  rows="4"  placeholder="Write your description Here..." required ></textarea>
                        </div>
                        <div class="form-row mt-2">
                            <label for="product_image" class="mr-2 form-label">Product image :</label>
                            <input type="file" name="product_image" id="product_image" class="form-control "  required>
                        </div>

                        <div class="form-row mt-3">
                            <label for="product_price" class="form-label">Product price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-solid fa-rupee-sign"></i></span>
                                </div>
                                <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter product price"  required autocomplete="off">
                            </div>
                            
                        </div>

                    <div id="productAddError"></div>
                    <div class="row mt-4">
                        <div class="col-auto ">
                        <input type="submit" id="insert_product_btn" class="btn btn-primary btn-lg  py-2 px-5 " value="ADD" name="insert_product">
                        </div>
                    </div>
        </form>
    </div>
   
</div>

<!-- footer area -->
        </div>
    </div>
</div>


</body>
</html>