<?php

require_once './superAdmin-header.php';
?>


<div class="container mt-5 mx-auto">
    <div class="row">
        <div class="col-md-6">
            <h2>Add New Admin</h2>
            <form action="#" id="adminAddForm" method="post" class="mt-4">
                <div class="form-group">
                    <label for="admin_name">Name</label>
                    <input type="text" class="form-control" name="admin_name" id="admin_name" placeholder="Enter admin name" autofocus required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="admin_email">E-Mail</label>
                    <input type="email" class="form-control" id="admin_email" name="admin_email"  placeholder="admin@mail.com" required>
                </div>
                <div class="form-group">
                    <label for="admin_phone">Phone Number</label>
                    <input type="email" class="form-control" id="admin_phone" name="admin_phone"  pattern="^\+94\d{9}$" placeholder="+94xxxxxxxxx" required>
                </div>
                
                <div id="productAddError"></div>
                <div class="form-group">
                    <input type="submit" id="insert_product_btn" class="btn btn-primary btn-lg py-2 px-5" value="Start Process" name="make_admin">
                </div>
            </form>
        </div>
       
    </div>
</div>


<!-- footer area -->
</div>
        </div>
</div>

<script>
    $(document).ready(function(){

        //Add new admin
        $("#make_admin").click(function(e){
            if($("#adminAddForm")[0].checkValidity()){
                e.preventDefault();

                $(this).val('Please Wait..');
                $.ajax({
                    url:'../assets/php/admin-action.php',
                    method:'post',
                    data:$("#adminAddForm").serialize()+'&action=newAdmin',
                    success:function(response){
                        console.log(response);
                    }
                });
            }
        });
    });
</script>

</body>
</html>




