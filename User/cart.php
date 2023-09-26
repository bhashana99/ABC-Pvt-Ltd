<?php

require_once 'Assets/PHP/header.php';


?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-11">
          <div id="alert"></div>
            <div class="table-responsive mt-2" id="showItem">
                <!-- <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <td colspan="7">
                                <h4 class="text-center text-info m-0">Products in your cart!</h4>
                            </td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>
                                <a href="#" id="clearCart" class="badge-danger badge p-1" ><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>id</td>

                            <input type="hidden" class="pid" value=0>

                            <td><img src="" alt="" width="50"></td>

                            <td>name</td>

                            <td><i class="fa-solid fa-dollar-sign"></i>&nbsp;&nbsp;<?= number_format(000000,2) ?></td>

                            <input type="hidden" class="pprice" value=0>
                            
                            <td><input type="number" class="form-control itemQty"   value=0 style="width:75px;"></td>
                            <td><i class="fa-solid fa-dollar-sign"></i>&nbsp;&nbsp;<?= number_format(000,2) ?></td>
                            <td><a href="#" class="text-danger lead" id="itemRemove"><i class="fas fa-trash-alt"></i></a></td>
           
                        </tr>
                        
                        
                        
                        <tr>
                          <td colspan="3">
                            <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping</a>
                          </td>
                          <td colspan="2"><b>Grand Total</b></td>
                          <td><b><i class="fa-solid fa-dollar-sign"></i>&nbsp;&nbsp;<?= number_format(0000,2); ?></b></td>
                          <td>
                            <a href="checkout.php" class="btn btn-info " ><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                          </td>
                        </tr>
                    </tbody>
                    
                </table> -->
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function(){

    
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


        displayAllItems();
        //display all cart items
        function displayAllItems(){
            $.ajax({
                url:'Assets/PHP/action.php',
                method: 'post',
                data: {action:'displayItem'},
                success:function(response){
                    // console.log(response);
                    $("#showItem").html(response);
                }

            });
        }






});
</script>


</body>
</html>