<?php

require_once 'session.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst(basename($_SERVER['PHP_SELF'],'.php'));?> | ABC PHONE</title>
    <script src="https://kit.fontawesome.com/fad89713bc.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
   
</head>
<body>
    
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="./home.php"><img src="../images/company_logo.png" height="45" alt=""></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link active"  href="./home.php"><i class="fas fa-home"></i>&nbsp;Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./checkout.php">Checkout</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./cart.php"><i class="fas fa-shopping-cart"></i> <span class="badge badge-danger" id="cart-item">2</span></a>
      </li>
      <li class="nav-item dropdown mr-3 ml-3">
        <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown" >
            <i class="fas fa-user-cog"></i>&nbsp;Hi! UserName
        </a>
        <div class="dropdown-menu ">
            <a href="" class="dropdown-item"><i class="fas fa-cog"></i>&nbsp;Setting</a>
            <a href="assets/php/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
        </div>
    </li>
    </ul>
  </div>
</nav>
