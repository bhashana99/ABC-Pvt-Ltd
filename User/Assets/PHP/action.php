<?php

require_once 'user_db.php';

$user = new UserDB;

if(isset($_POST['action']) && $_POST['action'] == 'register'){
    //print_r($_POST);

    $name = $user->test_input($_POST['name']);
    $email = $user->test_input($_POST['email']);
    $pass = $user->test_input($_POST['password']);
    $phone = $_POST['phone'];

    $hpass = password_hash($pass, PASSWORD_DEFAULT);

    if($user->user_exist($email)){
        echo $user->showMessage('warning','This E-mail is already registered!');
    }
    else{
        if($user->register($name,$email,$hpass,$phone)){
           echo 'register';   
        }
        else{
            echo $user->showMessage('danger','Something went wrong! try again later!');
        }
    }
}



?>