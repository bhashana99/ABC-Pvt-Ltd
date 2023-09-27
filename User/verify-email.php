<?php
require_once 'Assets/PHP/session.php';
require_once 'Assets/PHP/user_db.php';

$user = new UserDB();

if(isset($_GET['email'])){
    $email = $_GET['email'];

    $user->verify_email($email);
    header('location:setting.php');
    exit();
}
else{
    header('location:ABC(Pvt)Ltd/User/index.php');
    exit();
}

?>