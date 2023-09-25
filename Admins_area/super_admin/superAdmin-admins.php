<?php

require_once 'superAdmin-header.php';
?>

<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card my-2 border-info">
            <div class="card-header bg-info text-white">
                <h4 class="m-0 ">All Admins</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllAdmins">
                    <p class="text-center align-self-center lead">Please Wait...</p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- product edit modal -->
<div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
      <h4 class="modal-title text-light">Edit Admin Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="#" method="post" id="editAdminForm" class="px-3">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" name="phone" id="phone" class="form-control form-control-lg" placeholder="+94xxxxxxxxx" pattern="^\+94\d{9}$" required>
                    </div>
                    
                    
                    <div class="form-group">
                        <input type="submit" value="Update Admin Details" class="btn btn-info btn-block btn-lg" id="editAdminBtn" name="editAdmin" >
                    </div>
                </form>
      </div>
      
    </div>
  </div>
</div>



<!-- footer area -->
</div>
        </div>
</div>


<script>
    $(document).ready(function(){

        fetchAllAdmin();
        //fetch all products ajax request
        function fetchAllAdmin(){
            $.ajax({
                url:'../assets/php/admin-action.php',
                method:'post',
                data:{action:'fetchAllAdmin'},
                success:function(response){
                    $("#showAllAdmins").html(response);
                    $("table").DataTable();
                }
            });
        }

       //edit product details ajax request
       $("body").on("click",".adminEditIcon", function(e){
        e.preventDefault();
        var pEdit_id = $(this).attr('id');
        $.ajax({
            url:'../assets/php/admin-action.php',
            method:'post',
            data:{pEdit_id: pEdit_id},
            success: function(response){
                // console.log(response);
                 data = JSON.parse(response);
                   console.log(data);
                $("#id").val(data.id);
                // console.log(data.id);
                $("#name").val(data.name);
                
                $("#phone").val(data.phone);
                

            }
        });

       });

       //update admin details ajax request
       $("#editAdminBtn").click(function(e){
        if($("#editAdminForm")[0].checkValidity()){
            e.preventDefault();

            $.ajax({
                url:'../assets/php/admin-action.php',
                method:'post',
                data: $("#editAdminForm").serialize()+"&action=update_admin",
                success:function(response){
                    // console.log(response);
                    Swal.fire({
                        title: 'Admin Details Updated successfully!',
                        type: 'success'
                    });
                    $("#editAdminForm")[0].reset();
                    $("#editAdminModal").modal('hide');
                    fetchAllAdmin();
                }
            })
        }
       });

       //delete product ajax request
       $("body").on("click",".deleteAdminIcon",function(e){
        e.preventDefault();

        var pDel_id = $(this).attr("id");
        
        Swal.fire({
                title:'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result)=>{
                if (result.value) {
                    $.ajax({
                        url: '../assets/php/admin-action.php',
                        method:'post',
                        data:{pDel_id: pDel_id},
                        success:function(response){
                        Swal.fire(
                            'Deleted!',
                            'Product deleted successfully!',
                            'success'
                    )
                    fetchAllAdmin();
                        }

                    });
                    
                    }
            });
       });




    });
</script>
</body>
</html>

