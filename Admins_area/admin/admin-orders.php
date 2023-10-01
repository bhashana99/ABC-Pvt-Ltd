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
                <div class="table-responsive" id="showAllBlockedUsers">
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



    });
</script>