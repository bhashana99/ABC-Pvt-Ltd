<?php
session_start();
if(!isset($_SESSION['sAemail'])){
  header('location:../index.php');
  exit();
}

// Define an array of titles for each page
$titles = array(
    'superAdmin-insertProduct.php' => 'Insert Product',
    'superAdmin-productCustomize.php' => 'Product Customize',
    'superAdmin-admins.php' => 'Customize Admins',
    'superAdmin-users.php' => 'Users',
    'superAdmin-makeAdmins.php' => 'Make Admin',
    
);

// Get the current PHP file name
$currentFile = basename($_SERVER['PHP_SELF']);

// Use the file name to fetch the title from the array, or use a default title if not found
$title = isset($titles[$currentFile]) ? $titles[$currentFile] : 'Default Title';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title> <?= $title;  ?> | Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/fad89713bc.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.js"></script>
    <script>
      $(document).ready(function(){
        $("#open-nav").click(function(){
          $(".admin-nav").toggleClass('animate');
        })
      });
    </script>
    <style>
    .admin-nav{
        width:220px;
        min-height: 100vh;
        overflow: hidden;
        background-color: #343a40;
        transition: 0.3s all ease-in-out;
    }
    .admin-link{
        background-color:#343a40;
    }
    .admin-link:hover, .nav-active{
        background-color:#212529;
        text-decoration: none;
    }
    .animate{
        width: 0;
        transition: 0.3s all ease-in-out;
    }
</style>
<style media="screen">
    .preview{
      display: block;
      
      border: none;
      margin-top: 10px;
    }
  </style>

</head>
<body>
<div class="container-fluid">
        <div class="row">
            <div class="admin-nav p-0">
                <h4 class="text-light text-center p-2">Super Admin panel</h4>

                <div class="list-group list-group-flush">

                    <a href="superAdmin-productCustomize.php" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'superAdmin-productCustomize.php')? "nav-active":"" ?>">
                    <i class="fa-solid fa-wrench"></i>&nbsp;&nbsp;Available products
                    </a>

                    <a href="superAdmin-insertProduct.php" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'superAdmin-insertProduct.php')? "nav-active":"" ?>">
                    <i class="fa-solid fa-cart-plus"></i>&nbsp;&nbsp;Insert Product
                    </a>

                    <a href="superAdmin-makeAdmins.php" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'superAdmin-makeAdmins.php')? "nav-active":"" ?>">
                    <i class="fa-solid fa-person-walking-arrow-right"></i>&nbsp;&nbsp;Make Admin
                    </a>
                    
                    <a href="superAdmin-admins.php" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'superAdmin-admins.php')? "nav-active":"" ?>">
                    <i class="fa-solid fa-user-shield"></i>&nbsp;&nbsp;Admins Details
                    </a>

                    <a href="superAdmin-users.php" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'superAdmin-users.php')? "nav-active":"" ?>">
                    <i class="fa-solid fa-users"></i>&nbsp;&nbsp;Users Details
                    </a>

               
                </div>
            </div>

            <div class="col">
                <div class="row">
                    <div class="col-lg-12 bg-primary pt-2 justify-content-between d-flex">
                        <a href="#" class="text-white" id="open-nav"><h3><i class="fas fa-bars"></i></h3></a>

                        <h4 class="text-light"><?= $title; ?></h4>

                        <a href="logout.php" class="text-light mt-1">
                            <i class="fas fa-sign-out-alt"></i>&nbsp;Logout
                        </a>
                    </div>
                </div>


