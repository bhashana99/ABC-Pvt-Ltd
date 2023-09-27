<?php

require_once 'Assets/PHP/header.php';
// require_once 'Assets/PHP/user_db.php';



?>
<div class="container">
    <h1 class="mt-5 text-center text-primary "><b>Profile Setting</b></h1>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card rounded-0 mt-3 border-primary">
                <div class="card-header border-primary ">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#profile" class="nav-link active font-weight-bold" data-toggle="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#editProfile" class="nav-link  font-weight-bold" data-toggle="tab">Edit Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#changePass" class="nav-link font-weight-bold" data-toggle="tab">Change Password</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">

                    <!-- Profile Tab Content Start -->
                        <div class="tab-pane container active" id="profile">
                          <div id="verifyEmailAlert"></div>
                            <div class="card-deck">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-light text-center lead">
                                        User ID : <?= $cid; ?>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;" >
                                          <b>Name : </b><?= $cname; ?>
                                        </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;" >
                                          <b>E-Mail : </b><?= $cemail; ?>
                                        </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;" >
                                          <b>Gender : </b><?= $cgender; ?>
                                        </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;" >
                                          <b>Date of Birth : </b><?= $cdob; ?>
                                        </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;" >
                                          <b>Phone : </b><?= $cphone; ?>
                                        </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;" >
                                          <b>Register On :  </b><?= $reg_on; ?>
                                        </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;" >
                                          <b>E-Mail Verified :  </b><?= $verified; ?>

                                          <?php if($verified == 'Not Verified!'): ?>
                                            <a href="#" id="verify-email" class="float-right">Verify Now</a>
                                            <?php endif; ?>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="card border-primary align-self-center">
                                  <?php if(!$cphoto): ?>
                                    <img src="../images/avatar.png" class="img-thumbnail img-fluid" 
                                    width="408px">
                                    <?php else: ?>
                                      <img src="<?= '../images/user_images/'.$cphoto;  ?>"  class="img-thumbnail img-fluid" 
                                        width="408px">
                                  <?php endif; ?>
                                </div>
                            </div>
                        </div>

           <!-- Profile Tab Content End -->

            <!-- Edit Profile Tab Content Start -->

            <div class="tab-pane container fade" id="editProfile">
              <div class="card-deck">
                <div class="card border-danger align-self-center">
                <?php if(!$cphoto): ?>
                 <img src="../images/avatar.png" class="img-thumbnail img-fluid" 
                  width="408px">
                 <?php else: ?>
                <img src="<?= '../images/user_images/'.$cphoto; ?>"  class="img-thumbnail img-fluid" 
                  width="408px">
                <?php endif; ?>
                </div>
                <div class="card border-danger">
                  <form action="" method="post" class="px-3 mt-2" 
                  enctype="multipart/form-data" id="profile-update-form">
                    <input type="hidden" name="oldimage" value="<?= $cphoto; ?>" >
                    <div class="form-group m-0">
                      <label for="profilePhoto" class="m-1">Upload Profile Image</label>
                      <input type="file" name="image" id="profilePhoto" >
                    </div>

                    <div class="form-group m-0">
                      <label for="name" class="m-1" >Name</label>
                      <input type="text" name="name" id="name" class="form-control" value="<?= $cname; ?>" >
                    </div>

                    <div class="form-group m-0">
                      <label for="gender" class="m-1">Gender</label>
                      <select class="form-control" name="gender" id="gender" >
                        <option value="" disabled <?php if($cgender == null){
                          echo 'selected';} ?> >Select</option>
                        <option value="Male" <?php if($cgender == 'Male'){
                          echo 'selected';} ?> >Male</option>
                        <option value="Female" <?php if($cgender == 'Female'){
                          echo 'selected';} ?> >Female</option>
                      </select>
                    </div>

                    <div class="form-group m-0">
                      <label for="dob" class="m-1">Date of Birth</label>
                      <input type="date" name="dob" id="dob" value="<?= $cdob; ?>" 
                      class="form-control" >
                    </div>

                    <div class="form-group m-0">
                      <label for="phone" class="m-1">Phone</label>
                      <input type="" name="phone" id="phone" value="<?= $cphone; ?>" 
                      class="form-control" >
                    </div>

                    <div class="form-group mt-2">
                      <input type="submit" name="profile_update" value="Update Profile"
                      class="btn btn-danger btn-block" id="profileUpdateBtn" >
                    </div>

                  </form>
                </div>
              </div>
            </div>
            <!-- Edit Profile Tab Content End -->

            <!-- Change Password Tab Content Start -->

            <div class="tab-pane container fade" id="changePass">
              <div  id="changepassAlert"></div>
              <div class="card-deck">
                <div class="card border-success">
                  <div class="card-header bg-success text-white text-center lead">
                    Change Password
                  </div>
                  <form action="#" method="post" class="px-3 mt-2" id="change-pass-form" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="curpass" >Enter Your Current Password</label>
                      <input type="password" name="curpass" placeholder="Current Password"
                      class="form-control form-control-lg" id="curpass" required minlength="5" >
                    </div>

                    <div class="form-group">
                      <label for="newpass" >Enter Your New Password</label>
                      <input type="password" name="newpass" placeholder="New Password"
                      class="form-control form-control-lg" id="newpass" required minlength="5" >
                    </div>

                    <div class="form-group">
                      <label for="cnewpass" >Confirm Your New Password</label>
                      <input type="password" name="cnewpass" placeholder="Confirm New Password"
                      class="form-control form-control-lg" id="cnewpass" required minlength="5" >
                    </div>

                    <div class="form-group">
                      <p class="text-danger" id="changepassError"></p>
                    </div>

                    <div class="form-group">
                      <input type="submit" name="changepass" value="Change Password"
                      class="btn btn-success btn-block btn-lg" id="changePassBtn">
                    </div>
                  </form>
                </div>
                <div class="card border-success align-self-center">
                  <img src="../images/pass_change.png" class="img-thumbnail img-fluid" width="408px" >
                  
                </div>
              </div>
            </div>

            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>

      $(document).ready(function(e){    
        //Profile Update Ajax Request
        $("#profile-update-form").submit(function(e){
          e.preventDefault();

          $.ajax({
            url: 'Assets/PHP/action.php',
            method: 'post',
            processData: false,
            contentType:false,
            cache:false,
            data: new FormData(this),
            success:function(response){
              // console.log(response);
              
              const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        });

                        Toast.fire({
                        icon: 'success',
                        title: 'Profile Updated'
                        });

                        setTimeout(function() {
                          location.reload();
                      }, 1000);
                              
                        
            }

          });
        });

         //Change Password Ajax Request
         $("#changePassBtn").click(function(e){
          if($("#change-pass-form")[0].checkValidity()){
            e.preventDefault();
            $("#changePassBtn").val('Please Wait...');

            if($("#newpass").val() != $("#cnewpass").val()){
              $("#changepassError").text('* Password did not matched!');
              $("#changePassBtn").val('Please Wait...');

            }
            else{
              $.ajax({
                url:'Assets/PHP/action.php',
                method: 'post',
                data: $("#change-pass-form").serialize()+'&action=change_pass',
                success:function(response){
                  //console.log(response);
                  $("#changepassAlert").html(response);
                  $("#changePassBtn").val('Change Password');
                  $("#changepassError").text('');
                  $("#change-pass-form")[0].reset();

                    
                }
              })
            }
          }
        });

        // Verify E-Mail Ajax Request
        $("#verify-email").click(function(e){
          e.preventDefault();
          $(this).text('Please Wait...');

          $.ajax({
            url: 'Assets/PHP/action.php',
            method: 'post',
            data: { action: 'verify_email'},
            success:function(response){
              $("#verifyEmailAlert").html(response);
              $("#verify-email").text('Verify Now');
            }
          });
        });

        

      });

            </script>
  
       </body>
</html>