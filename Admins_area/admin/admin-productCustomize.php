<?php

require_once './admin-header.php';
?>

<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card my-2 border-info">
            <div class="card-header bg-info text-white">
                <h4 class="m-0 ">All Product</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllProducts">
                    <p class="text-center align-self-center lead">Please Wait...</p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- product edit modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
      <h4 class="modal-title text-light">Edit Product Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="#" method="post" id="editProductForm" class="px-3">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="title" class="form-label ">Title</label>
                        <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Enter Title" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">description</label>
                        <textarea class="form-control form-control-lg" id="description" name="description"  rows="3" placeholder="Write your description Here..." required ></textarea>
                    </div>
                    
                    <div class="form-group">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-solid fa-rupee-sign"></i></span>
                                </div>
                            <input type="text" name="price" id="price" class="form-control form-control-lg" placeholder="Enter price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update Category Details" class="btn btn-info btn-block btn-lg" id="editProductBtn" name="editCategory" >
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

        fetchAllProduct();
        //fetch all products ajax request
        function fetchAllProduct(){
            $.ajax({
                url:'../assets/php/admin-action.php',
                method:'post',
                data:{action:'fetchAllProduct'},
                success:function(response){
                    $("#showAllProducts").html(response);
                    $("table").DataTable();
                }
            });
        }

      
        // edit product details
        $("body").on("click",".productEditIcon", function(e){
            e.preventDefault();

            edit_id = $(this).attr('id');
            // console.log(edit_id);

            $.ajax({
                url:'../assets/php/admin-action.php',
                method:'post',
                data:{edit_id:edit_id},
                success:function(response){
                    // console.log(response);
                    data = JSON.parse(response);
                    // console.log(response);
                    $("#id").val(data.id);
                    $("#title").val(data.title);
                    $("#description").val(data.description);
                    $("#price").val(data.price);
                }

            });
        });

        //updated product details
        $("#editProductBtn").click(function(e){
            if($("#editProductForm")[0].checkValidity()){
                e.preventDefault();

                $.ajax({
                    url:'../assets/php/admin-action.php',
                    method:'post',
                    data: $("#editProductForm").serialize()+"&action=update_product",
                    success:function(response){
                        // console.log(response);
                            Swal.fire({
                            title: 'Product Update successful!',
                            type: 'success'
                        });
                        
                        
                        $("#editProductForm")[0].reset();
                        $("#editProductModal").modal('hide');
                        fetchAllProduct();
                       
                    }
                });
            }
        });

       

       //delete product ajax request
       $("body").on("click",".deleteProductIcon",function(e){
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
                    fetchAllProduct();
                        }

                    });
                    
                    }
            });
       });




    });
</script>
    
</body>
</html>