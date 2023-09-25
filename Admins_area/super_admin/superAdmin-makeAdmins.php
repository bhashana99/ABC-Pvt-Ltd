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
                    <label for="admin_password">New Password</label>
                    <input type="text" class="form-control" id="admin_password" name="admin_password"  placeholder="password" required>
                </div>
                <div class="form-group">
                    <label for="admin_phone">Phone Number</label>
                    <input type="tel" class="form-control" id="admin_phone" name="admin_phone"  pattern="^\+94\d{9}$" placeholder="+94xxxxxxxxx" required>
                </div>
                
                <div id="adminAddError"></div>
                <div class="form-group">
                    <input type="submit" id="make_admin" class="btn btn-primary btn-lg py-2 px-5" value="Start Process" name="make_admin">
                </div>
            </form>
        </div>
       
    </div>
</div>


<!-- footer area -->
</div>
        </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        // console.log(response);
                        if(response === 'newAdmin_here'){
                            $("#make_admin").val('Start Process');
                            $("#adminAddForm")[0].reset();
                            $("#adminAddError").html('');
                            let timerInterval
                            Swal.fire({
                            title: 'Creating New Admin!',
                            html: 'It will finishing <b></b> milliseconds.',
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                            }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('I was closed by the timer')
                            }
                            });
                        }else{
                            $("#adminAddError").html(response);
                            $("#make_admin").val('Start Process');
                        }
                    }
                });
            }
        });
    });
</script>

</body>
</html>




