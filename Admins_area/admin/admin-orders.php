<?php

require_once './admin-header.php';
?>


<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card my-2 border-warning">
            <div class="card-header bg-warning text-white">
                <h4 class="m-0"><i class="fa-solid fa-list-check"></i>&nbsp;&nbsp;Orders to be processed</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllOrderProcess">
                    <p class="text-center align-self-center lead">Please Wait...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card my-2 border-success">
            <div class="card-header bg-success text-white">
                <h4 class="m-0"><i class="fa-solid fa-clipboard-check"></i>&nbsp;&nbsp;Completed Orders</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllCompleteOrders">
                    <p class="text-center align-self-center lead">Please Wait...</p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Footer Area -->
</div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(e){

        fetchAllProcessedOrders();
        //fetch all Orders to be processed details
        function fetchAllProcessedOrders(){
            $.ajax({
                url:'../assets/php/admin-action.php',
                method: 'post',
                data: {action: 'fetchAllProcessedOrders'},
                success: function(response){
                    // console.log(response);
                    $("#showAllOrderProcess").html(response);
                    $("table").DataTable();
                }
            });
        }

        //Display Order info
        $("body").on("click",".moreInfo", function(e){
            e.preventDefault();

            var info_id = $(this).attr("id");

            $.ajax({
                url:'../assets/php/admin-action.php',
                method: 'post',
                data: {info_id: info_id},
                success:function(response){
                    // console.log(response);
                    data = JSON.parse(response);
                    // console.log(response);
                    Swal.fire({
                        title: '<Strong>Order : ID('+data.order_id+')</strong>',
                        type:'info',
                        html: '<b>Action : '+'<span class="text-warning">to be processed</span></b>'+
                            '<br><b>User Id : </b>'+data.user_id+
                            '<br><br><b>Products : </b>'+data.products+
                            '<br><br><b>Amount : </b><i class="fa-solid fa-rupee-sign"></i>&nbsp;'+ data.amount_paid + 
                            '<br><br><p class="text-primary">Contact info</p>'+
                            '<b>Name : </b>'+data.name+
                            '<br><br><b>phone : </b>'+data.phone+
                            '<br><br><b>Address : </b>'+data.address+
                            '<br><br><b>E-Mail : </b>'+data.email+
                            '<br><br><b class="text-danger">Payment Method : </b>'+data.pmode,
                        showCloseButton: true,
                    });
                }
            });
        });

        //order complete list ajax request
        $("body").on("click",".orderCompleteIcon", function(e){
            e.preventDefault();
            var complete_id = $(this).attr("id");

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to complete this Order!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, complete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                url:'../assets/php/admin-action.php',
                method: 'post',
                data:{complete_id:complete_id},
                success:function(response){
                    // console.log(response);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Order Complete',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    fetchAllProcessedOrders();

                }
            });
                }
                });     
        });


        fetchAllCompleteOrders();
        //fetch all complete order details
        function fetchAllCompleteOrders(){
            $.ajax({
                url:'../assets/php/admin-action.php',
                method: 'post',
                data: {action: 'fetchAllCompleteOrders'},
                success: function(response){
                    // console.log(response);
                    $("#showAllCompleteOrders").html(response);
                    $("table").DataTable();
                }
            });
        }



    });
</script>