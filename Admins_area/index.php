
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin</title>
    <script src="https://kit.fontawesome.com/fad89713bc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
      html,body{
        height: 100%;
      }
    </style>
</head>
<body class="bg-dark">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center ">
            <div class="col-lg-5">
                <div class="card border-danger shadow-lg">
                    <div class="card-header bg-danger">
                       <h3 class="m-0 text-white">
                        <i class="fas fa-user-cog"></i>&nbsp;Admin Panel Login
                       </h3> 
                    </div>
                    <div class="card-body">
                      <form action="#" method="post" class="px-3" id="admin-login-form">
                        <div id="adminLoginAlert"></div>
                        <div class="form-group">
                          <input type="email" name="email" class="form-control form-control-lg rounded-0"
                          placeholder="admin@mail.com" required autofocus>
                        </div>

                        <div class="form-group">
                          <input type="password" name="password" class="form-control form-control-lg rounded-0"
                          placeholder="Password" required >
                        </div>

                        <div class="form-group">
                          <input type="submit" name="admin-login" class="btn btn-danger btn-block btn-lg rounded-0"
                          value ="Login" id="adminLoginBtn" >
                        </div>
                      </form>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

 
<script>
  $(document).ready(function(){

    $("#adminLoginBtn").click(function(e){
      if($("#admin-login-form")[0].checkValidity()){
        e.preventDefault();

        $(this).val('Please Wait...');
        $.ajax({
          url:'assets/php/admin-action.php',
          method:'post',
          data: $("#admin-login-form").serialize()+'&action=superAdminLogin',
          success:function(response){
          //  console.log(response);
          if(response === 'superAdmin_login'){
            window.location = 'super_admin/superAdmin-productCustomize.php';
          }
          else{
            $("#adminLoginAlert").html(response);
          }
          $("#adminLoginBtn").val('Login');
          }
        });
      }
    });
  });
</script>

</body>
</html>