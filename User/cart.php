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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        //change qty ajax request
        $("body").on('change','.itemQty',function(e){
            var $el = $(this).closest("tr");
            var pid = $el.find(".pid").val();
            var pprice = $el.find(".pprice").val();
            var qty = $el.find(".itemQty").val();

            // console.log(pid,pprice,qty);
           
            location.reload(true);
            $.ajax({
                url: 'Assets/PHP/action.php',
                method:'post',
                cache:false,
                data:{
                    action:'change_qty',
                    qty:qty,
                    pid:pid,
                    pprice:pprice},
                success:function(response){
                    // console.log(response);
                    // location.reload(true);
                    
       
                }
        });
        });

        //delete one item in cart
        $("body").on('click','.itemRemove',function(e){
            e.preventDefault();
            var pid = $(this).data('id');
            
            $.ajax({
                url: 'Assets/PHP/action.php',
                method:'post',
                cache:false,
                data:{
                    action:'delete_item',
                    pid : pid
                },
                success:function(response){
                    // console.log(response);
                    displayAllItems();
                    load_cart_item_number();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        });

                        Toast.fire({
                        icon: 'success',
                        title: 'Item Removed successfully'
                        });
                }
            });
        });

        //delete all items in cart
        $("body").on('click','.clearCart',function(e){
            $.ajax({
                url: 'Assets/PHP/action.php',
                method:'post',
                data:{
                    action:'deleteAll_item',
                },
                success:function(response){
                    // console.log(response);
                    displayAllItems();
                    load_cart_item_number();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Cart cleared successfully',
                        showConfirmButton: false,
                        timer: 2500
                        }).then(function(){
                            window.location = "home.php";
                        })
                        
                }
            });
        });






});
</script>


</body>
</html>