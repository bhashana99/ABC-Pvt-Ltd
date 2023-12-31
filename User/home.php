<?php

require_once 'Assets/PHP/header.php';
require_once 'Assets/PHP/user_db.php';

$baseImageUrl = 'http://localhost/project/SENG-21253/ABC(Pvt)Ltd/images/product_images/';

$user = new UserDB();
?>

<div class="container">
    <div id="message"></div>
    <div class="row mt-2 pb-3">
    <?php
        $products = $user->displayProduct();
        foreach ($products as $product):
            $imageUrl = $baseImageUrl . $product['image'];
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
            <!-- <div class="card-deck"> -->
                <div class="card p-2 border-secondary mb-2 shadow" style="height: 100%;">
                    <img src="<?= $imageUrl ?>" alt="product image" class="card-img-top" height="250">
                    <div class="card-body p-1">
                        <h4 class="card-title text-center text-info"><?= $product['title'] ?></h4>
                        <h6 class="card-text text-center text-secondary"><?= $product['description'] ?></h6>
                        <h5 class="card-text text-center text-danger"><i class="fa-solid fa-rupee"></i>&nbsp;&nbsp;<?= number_format($product['price'], 2) ?>/-</h5>
                    </div>
                    <div class="card-footer p-1">
                        <form action="" class="form-submit">
                            <input type="hidden" class="pid" value="<?= $product['id'] ?>">
                            <input type="hidden" class="pname" value="<?= $product['title'] ?>">
                            <input type="hidden" class="pdescription" value="<?= $product['description'] ?>">
                            <input type="hidden" class="pprice" value="<?= $product['price'] ?>">
                            <input type="hidden" class="pimage" value="<?= $product['image'] ?>">
                            <button type="button" class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to cart</button>
                        </form>
                    </div>
                </div>
            <!-- </div> -->
        </div>
        <?php endforeach; ?>
    </div>
</div>


<script>
$(document).ready(function(){
        //sent data for cart Ajax request
        $(".addItemBtn").click(function(e){
            e.preventDefault();

            var $form = $(this).closest(".form-submit");
            var pid = $form.find(".pid").val();
            var pname = $form.find(".pname").val();
            var pprice = $form.find(".pprice").val();
            var pimage = $form.find(".pimage").val();
            var pdescription = $form.find(".pdescription").val();

            $.ajax({
                url:'Assets/PHP/action.php',
                method:'post',
                data:{pid:pid,pname:pname,pprice:pprice,pimage:pimage,pdescription:pdescription},
                success:function(response){
                    $("#message").html(response);
                    window.scrollTo(0,0);
                    load_cart_item_number();
                }
            });

        });

        load_cart_item_number();
        //show cart number ajax request
        function load_cart_item_number(){
            $.ajax({
                url:'Assets/PHP/action.php',
                method: 'get',
                data: {cartItem:"cart_item"},
                success:function(response){
                    $("#cart-item").html(response);
                }
            });
        }

    });


</script>





</body>
</html>