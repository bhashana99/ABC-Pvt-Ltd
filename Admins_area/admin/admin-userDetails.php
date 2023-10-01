<?php

require_once './admin-header.php';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card my-2 border-success">
            <div class="card-header bg-success text-white">
                <h4 class="m-0">Active Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllUsers">
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
    $(document).ready(function(){

        fetchAllUsers();
      //Fetch All Users Ajax Request
      function fetchAllUsers(){
        $.ajax({
            url:'../assets/php/admin-action.php',
          method: 'post',
          data: {action: 'fetchAllUsers'},
          success: function(response){
            //console.log(response);
            $("#showAllUsers").html(response);
            $("table").DataTable();
          }
        });
      }
    });
</script>

</body>
</html>