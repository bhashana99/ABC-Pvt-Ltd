<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ABC Phone Store</title>
    <script src="https://kit.fontawesome.com/fad89713bc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
</head>
<body>

<div class="container">
    <!-- Login form start -->
    <div class="row justify-content-center wrapper" id="login-box" >
            <div class="col-lg-10 mt-5 mb-auto">
            <div class="text-center p-0 m-0"><img src="./images/company_profile.png" alt=""></div>
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
                                placeholder="E-Mail" required >
                            </div>
                            <div class="input-group input-group-lg form-group my-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" >
                                        <i class="fas fa-key  fa-lg"></i>
                                    </span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control rounded-0 "
                                placeholder="Password" required >
                            </div>
                            <div class="form-group">
                              <div class="custom-control custom-checkbox float-left">
                                <input type="checkbox" name="rem" id="customCheck" class="custom-control-input" 
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
</div>




<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
   

</body>
</html>