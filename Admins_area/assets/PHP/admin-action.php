<?php

require_once 'admin-db.php';

$admin = new Admin();
session_start();

//Handle Admin Login Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'superAdminLogin'){
    //print_r($_POST);
    $email = $admin->test_input($_POST['email']);
    $password = $admin->test_input($_POST['password']);

    $hpassword = sha1($password);

    $loggedInAdmin = $admin->superAdmin_login($email,$hpassword);

    if($loggedInAdmin != null){
        echo 'superAdmin_login';
        $_SESSION['email'] = '$email';
    }
    else{
        echo $admin->showMessage('danger','Username or Password is Incorrect!');
    }
}


?>