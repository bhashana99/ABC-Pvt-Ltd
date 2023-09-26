<?php

require_once 'Assets/PHP/header.php';

?>



<div class="container" id="checkoutTemplate">
<!--     <div class="row justify-content-center">
        <div class="col-lg-6 px-4 pb-4" id="order">
            <h4 class="text-center text-info p-2">Complete your order!</h4>
            <div class="jumbotron p-3 mb-2 text-center">
                <h6 class="lead"><b>Product(s) : </b><span id="allProducts"></span></h6>
                <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
                <h5><b>Total Amount Payable : </b><span id="total"></span>/-</h5>
            </div>
            <form action="" method="post" id="placeOrder">
                <input type="hidden" name="products" value="">
                <input type="hidden" name="grand_total" value="">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" class="form-control" placeholder="Enter Phone number" required>
                </div>
                <div class="form-group">
                    <textarea name="address" class="form-control" cols="30" rows="8" placeholder="Enter Delivery Address Here..."></textarea>
                </div>
                <h6 class="text-center lead">Select Payment Mode</h6>
                <div class="form-group">
                    <select name="pmode" class="form-control">
                        <option value="" selected disabled>Cash On Delivery</option>
                        <option value="cod">Cash On Delivery</option>
                        <option value="netBanking">Net Banking</option>
                        <option value="cards">Debit/Credit Card</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
                </div>
            </form>
        </div>
    </div>-->
        
</div> 


<script>
    $(document).ready(function(e){

        load_checkout_details();
        //show checkout details
        function load_checkout_details(){
            $.ajax({
                url:'Assets/PHP/action.php',
                method: 'post',
                data: {action:"checkout"},
                success:function(response){
                    // console.log(response);
                    $("#checkoutTemplate").html(response);

                }
            });
        }

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

        //delivery ajax request
        $("body").on('click','.submit',function(e){
            if($("#placeOrder")[0].checkValidity()){
                e.preventDefault();

                var $form = $(this).closest("#placeOrder");
                // console.log($form);
                // var products = $form.find("#pnames").val();
                // var grantTotal = $form.find("#ototal").val();
                
                // console.log(products,grantTotal);
                $.ajax({
                    url: 'Assets/PHP/action.php',
                    method:'post',
                    cache:false,
                    data: $form.serialize() + "&action=check_out",
                    success:function(response){
                        // console.log(response);
                        $("#checkoutTemplate").html(response);
                        load_cart_item_number();
                    }
                    });

            }
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