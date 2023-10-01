<?php
session_start();
if(!isset($_SESSION['aEmail'])){
  header('location:../index.php');
  exit();
}

// Define an array of titles for each page
$titles = array(
    'admin-insertProduct.php' => 'Insert Product',
    'admin-productCustomize.php' => 'Product Customize',
    'admin-userDetails.php' => 'Users'
    
    
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
            <div class="admin-nav">
                <h4 class="text-light text-center p-2">Admin panel</h4>

                <div class="list-group list-group-flush mt-5">

                    <a href="admin-productCustomize.php" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'admin-productCustomize.php')? "nav-active":"" ?>">
                    <i class="fa-solid fa-wrench"></i>&nbsp;&nbsp;Available products
                    </a>

                    <a href="admin-insertProduct.php" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'admin-insertProduct.php')? "nav-active":"" ?>">
                    <i class="fa-solid fa-cart-plus"></i>&nbsp;&nbsp;Insert Product
                    </a>

                    <a href="admin-userDetails.php" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'admin-userDetails.php')? "nav-active":"" ?>">
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


