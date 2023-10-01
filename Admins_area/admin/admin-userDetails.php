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

<div class="row">
    <div class="col-lg-12">
        <div class="card my-2 border-danger">
            <div class="card-header bg-danger text-white">
                <h4 class="m-0">Blocked Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllBlockedUsers">
                    <p class="text-center align-self-center lead">Please Wait...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Display User's in Details Model -->
<div class="modal fade" id="showUserDetailsModal">
  <div class="modal-dialog modal-dialog-centered mw-100 w-50">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title" id="getName"></h4>
        <button class="close" type="button" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="card-deck">

          <div class="card border-primary">
            <div class="card-body">
              <p id="getEmail"></p>
              <p id="getPhone"></p>
              <p id="getDob"></p>
              <p id="getGender"></p>
              <p id="getCreated"></p>
              <p id="getVerified"></p>
            </div>
          </div>

          <div class="card align-self-center" id="getImage"></div>

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

      //Display User in Details Ajx Request
      $("body").on("click", ".userDetailsIcon", function(e){
        e.preventDefault();

        details_id = $(this).attr('id');

        $.ajax({
            url:'../assets/php/admin-action.php',
          type: 'post',
          data: {details_id: details_id},
          success:function(response){
           //console.log(response);
           data = JSON.parse(response);
           $("#getName").text(data.name+' '+'(ID: '+data.id+')');
           $("#getPhone").text('Phone :'+data.phone);
           $("#getDob").text('DOB :'+data.dob);
           $("#getGender").text('Gender :'+data.gender);
           $("#getCreated").text('Joined on :'+data.created_at);
           $("#getVerified").text('Verified :'+data.verified);

           if(data.photo != ''){
            $("#getImage").html('<img src="../assets/php/'+data.photo+'" class="img-thumbnail img-fluid align-self-center" width="280px" >');
           }
           else{
            $("#getImage").html('<img src="../../images/avatar.png" class="img-thumbnail img-fluid align-self-center" width="280px" >');
           }
          }
        });
      });


       //Block An User Ajax Request
       $("body").on("click",".blockUserIcon",function(e){
        e.preventDefault();
        blk_id = $(this).attr('id');

          $.ajax({
            url:'../assets/php/admin-action.php',
            method:'post',
            data:{blk_id: blk_id},
            success:function(response){
              Swal.fire(
                'Blocked!',
                'User blocked successfully!',
                'success'
          )
          fetchAllUsers();
          fetchAllBlockedUsers();
            }

          });
    });

    fetchAllBlockedUsers();
      //Fetch All Users Blocked Ajax Request
      function fetchAllBlockedUsers(){
        $.ajax({
          url:'../assets/php/admin-action.php',
          method: 'post',
          data: {action: 'fetchAllBlockedUsers'},
          success: function(response){
            //console.log(response);
            $("#showAllBlockedUsers").html(response);
            $("table").DataTable();
            fetchAllUsers();
            
          }
        });
      }

      //Restore Blocked An User Ajax Request
      $("body").on("click",".restoreUserIcon",function(e){
      e.preventDefault();
      res_id = $(this).attr('id');

      Swal.fire({
        title: 'Are you sure want restore this user?',
        //text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, restore user!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url:'../assets/php/admin-action.php',
            method:'post',
            data:{res_id: res_id},
            success:function(response){
              Swal.fire(
                'Restored!',
                'User restored successfully!',
                'success'
          )
          fetchAllBlockedUsers();
          fetchAllUsers();
            }

          });
         
        }
      });
    });


    });
</script>

</body>
</html>