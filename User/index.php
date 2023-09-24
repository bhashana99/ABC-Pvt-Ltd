<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ABC Phone Store</title>
    <script src="https://kit.fontawesome.com/fad89713bc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./Assets/CSS/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
</head>
<body>

<div class="container">
    <!-- Login form start -->
    <div class="row justify-content-center wrapper" id="login-box" >
            <div class="col-lg-10 mt-5 mb-auto">
            <div class="text-center p-0 m-0"><img src="../images/company_profile.png" alt=""></div>
                <div class="card-group myShadow">
                    <div class="card rounded-left p-4">
                        <h1 class="text-center font-weight-bold text-primary ">Sign in</h1>
                        <hr class="myHr">
                        <form action="#" method="post" class="px-3" id="login-form">
                          <div id="loginAlert"></div>
                            <div class="input-group input-group-lg form-group my-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" >
                                        <i class="far fa-envelope  fa-lg"></i>
                                    </span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control rounded-0 "
                                placeholder="E-Mail" required value="<?php if(isset($_COOKIE['email'])) {
                                  echo $_COOKIE['email'];
                                }  ?>" >
                            </div>
                            <div class="input-group input-group-lg form-group my-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" >
                                        <i class="fas fa-key  fa-lg"></i>
                                    </span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control rounded-0 "
                                placeholder="Password" required  value="<?php if(isset($_COOKIE['password'])) {
                                  echo $_COOKIE['password'];
                                }  ?>" >
                            </div>
                            <div class="form-group">
                              <div class="custom-control custom-checkbox float-left">
                                <input type="checkbox" name="rem" id="customCheck" class="custom-control-input" 
                                <?php if(isset($_COOKIE['email'])){ ?> checked <?php } ?>  
                                >
                                <label for="customCheck" class="custom-control-label" >Remember me</label>
                              </div>  
                              <div class="forgot float-right">
                                <a href="#" id="forgot-link" >Forgot Password?</a>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                              <input type="submit" value="Sign In" id="login-btn" class="btn btn-primary btn-lg btn-block myBtn" >
                            </div>
                        </form>
                    </div>
                    <div class="card justify-content-center rounded-right myColor p-4">
                      <h1 class="text-center font-weight-bold text-white">New here?</h1>
                      <hr class="my-3 bg-light myHr">
                      <p class="text-center font-weight-bolder text-light lead">Register an account to unlock a world of benefits and access exclusive features.</p>
                      <button class="btn btn-outline-light btn-lg align-self-center 
                      font-weight-bolder mt-4 myLinkBtn" id="register-link" >Register</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- Login form end -->

    <!-- register form start -->
    <div class="row justify-content-center wrapper" id="register-box" style="display: none;">
            <div class="col-lg-10 mt-1 mb-auto">
            <div class="text-center p-0 m-0"><img src="../images/company_profile.png" alt=""></div>
                <div class="card-group myShadow">
                <div class="card justify-content-center rounded-left myColor p-4">
                      <h1 class="text-center font-weight-bold text-white">Welcome Back</h1>
                      <hr class="my-3 bg-light myHr">
                      <p class="text-center font-weight-bolder text-light lead"> Welcome back! Sign in to access your account and enjoy our services.</p>
                      <button class="btn btn-outline-light btn-lg align-self-center 
                      font-weight-bolder mt-4 myLinkBtn" id="login-link" >Sign In</button>
                    </div>
                    <div class="card rounded-right p-4">
                        <h1 class="text-center font-weight-bold text-primary ">Register</h1>
                        <hr class="myHr">
                        
                        <form action="#" method="post" class="px-3" id="register-form">
                          <div id="regAlert"></div>
                            <div class="input-group input-group-lg form-group my-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" >
                                        <i class="far fa-user  fa-lg"></i>
                                    </span>
                                </div>
                                <input type="text" name="name" id="name" class="form-control rounded-0 "
                                placeholder="Full Name" required >
                            </div>

                            <div class="input-group input-group-lg form-group my-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" >
                                        <i class="far fa-envelope  fa-lg"></i>
                                    </span>
                                </div>
                                <input type="email" name="email" id="remail" class="form-control rounded-0 "
                                placeholder="abc@mail.com" required >
                            </div>

                            <div class="input-group input-group-lg form-group my-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" >
                                    <i class="fa-solid fa-mobile-retro fa-lg"></i>
                                    </span>
                                </div>
                                <input type="tel" name="phone" id="phone"  pattern="^\+94\d{9}$" class="form-control rounded-0 "
                                placeholder="+94xxxxxxxxx" required >
                            </div>

                            <div class="input-group input-group-lg form-group my-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" >
                                        <i class="fas fa-key  fa-lg"></i>
                                    </span>
                                </div>
                                <input type="password" name="password" id="rpassword" class="form-control rounded-0 "
                                placeholder="Password" required minlength="5" >
                            </div>
                            <div class="input-group input-group-lg form-group my-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" >
                                        <i class="fas fa-key  fa-lg"></i>
                                    </span>
                                </div>
                                <input type="password" name="cpassword" id="cpassword" class="form-control rounded-0 "
                                placeholder="Confirm Password" required minlength="5" >
                            </div>

                            <div class="form-group">
                              <div class="text-danger font-weight-bold" id="passError"></div>
                            </div>
                            <div class="form-group">
                              <input type="submit" value="Sign Up" id="register-btn" 
                              class="btn btn-primary btn-lg btn-block myBtn" >
                            </div>
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
    <!-- register form end -->


    <!-- forgot password form start -->
    <div class="row justify-content-center wrapper" id="forgot-box" style="display: none;" >
        <div class="col-lg-10 mt-5 mb-auto">
            <div class="text-center p-0 m-0"><img src="../images/company_profile.png" alt=""></div>
                <div class="card-group myShadow">
                  <div class="card justify-content-center rounded-left myColor p-4">
                      <h1 class="text-center font-weight-bold text-white">Reset Password</h1>
                      <hr class="my-3 bg-light myHr">             
                      <button class="btn btn-outline-light btn-lg align-self-center 
                      font-weight-bolder mt-4 myLinkBtn" id="back-link" >Back</button>
                    </div>
                    <div class="card rounded-right p-4" style="flex-grow:1.4;">
                        <h1 class="text-center font-weight-bold text-primary ">Forgot Your Password</h1>
                        <hr class="my-3">
                        <p class="lead text-center text-secondary ">To reset your password,enter the registered e-mail address and
                           we will send you the rest instructions on your email!</p>
                        <form action="#" method="post" class="px-3" id="forgot-form">
                          <div id="forgotAlert"></div>
                            <div class="input-group input-group-lg form-group my-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" >
                                        <i class="far fa-envelope  fa-lg"></i>
                                    </span>
                                </div>
                                <input type="email" name="email" id="femail" class="form-control rounded-0 "
                                placeholder="E-Mail" required >
                            </div>
                            
                            
                            <div class="form-group">
                              <input type="submit" value="Reset Password" id="forgot-btn" 
                              class="btn btn-primary btn-lg btn-block myBtn" >
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    <!-- forgot password form end -->
</div>




<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
 
<script>
    $(document).ready(function(){
        //When Register button was click
        $("#register-link").click(function(){
          $("#login-box").hide();
          $("#register-box").show();
        });

        //when sign in button was click
        $("#login-link").click(function(){
          $("#register-box").hide();
          $("#login-box").show();
        });

        //when forgot password was click
        $("#forgot-link").click(function(){
          $("#login-box").hide();
          $("#forgot-box").show();
        });

        //when back button was click
        $("#back-link").click(function(){
          $("#forgot-box").hide();
          $("#login-box").show();
        });

        // Register Ajax Request
        $("#register-btn").click(function(e){
          if($("#register-form")[0].checkValidity()){
            e.preventDefault();
            $("#register-btn").val('Please Wait...');
            if($("#rpassword").val() != $("#cpassword").val()){
              $("#passError").text('* Password did not matched!');
              $("#register-btn").val('Sign Up');
            }
            else{
              $("#passError").text('');
              $.ajax({
                url: 'assets/php/action.php',
                method: 'post',
                data: $("#register-form").serialize()+'&action=register',
                success:function(response){
                    // console.log(response);
                  $("#register-btn").val('Sign Up');
                  //console.log(response);
                  if(response === 'register'){
                    window.location ='home.php';
                  }
                  else{
                    $("#regAlert").html(response);
                  }
                }
              })
            }

          }
        });

        //Login Ajax Request
        $("#login-btn").click(function(e){
          if($("#login-form")[0].checkValidity()){
            e.preventDefault();

            $("#login-btn").val('Please Wait...');
            $.ajax({
              url: 'assets/php/action.php',
              method: 'post',
              data: $("#login-form").serialize()+'&action=login',
              success:function(response){
               // console.log(response);
               $("#login-btn").val('Sign In');
               if(response === 'login'){
                window.location = 'home.php';
               }
               else{
                $("#loginAlert").html(response);
               }
              }
            });
          }
        });







    });


</script>








</body>
</html>