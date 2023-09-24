<?php

require_once 'user_db.php';

$user = new UserDB;

//Handle Register Ajax Request
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

//Handle Login Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'login'){
    //print_r($_POST);

    $email = $user->test_input($_POST['email']);
    $pass = $user->test_input($_POST['password']);

    $loggedInUser = $user->login($email);

    if($loggedInUser != null){
        if(password_verify($pass,$loggedInUser['password'])) {   //$pass coming from form & $password coming from database
            if(!empty($_POST['rem'])){
                setcookie("email",$email,time()+(60*60*24*30),'/');
                setcookie("password",$pass,time()+(60*60*24*30),'/');
            }
            else{
                setcookie("email","",1,'/');
                setcookie("password","",1,'/');
            }

            echo 'login';
            $_SESSION['user'] = $email;

        }
        else{
            echo $user->showMessage('danger','Password is incorrect!');
        }
    }
    else{
            echo $user->showMessage('danger','This Email Not Registered');
    }
}


?>