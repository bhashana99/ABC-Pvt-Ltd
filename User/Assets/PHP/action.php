<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

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
           $_SESSION['user'] = $email;
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

 // Handel Forgot Password Ajax Request
 if(isset($_POST['action']) && $_POST['action'] == 'forgot'){
    // print_r($_POST);

    $email =$user->test_input($_POST['email']);

    $user_found = $user->currentUser($email);

    if($user_found != null){
        $token = uniqid();
        $token = str_shuffle($token);

        $user->forgot_password($token,$email);

        try{
            //Server settings
             //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = Database::USERNAME;
            $mail->Password = Database::PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            
            //Recipients
            $mail->setFrom(Database::USERNAME,'ABC Phone Store');
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password';
            $mail->Body = '<h3>Click the below link to reset your password.<br><br><a href="http://localhost/project/SENG-21253/ABC(Pvt)Ltd/User/reset-pass.php?email='.$email.'&token='.$token.'">Reset to password Click Here</a></h3>';
            
    
            $mail->send();
            echo $user->showMessage('success','We have send you the reset link in your e-mail ID, please check your e-mail!');
        }
        catch(Exception $e){
            echo $user->showMessage('danger','Something went wrong please try again later!');
            
        }
    }
    else{
        echo $user->showMessage('info','This e-mail is not registered!');
        
    }
}


//Handle sent data to cart ajax request
if(isset($_POST['pid'])){
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pimage = $_POST['pimage'];
    $pdescription = $_POST['pdescription'];
    $pqty = 1;
    $total = $pprice * $pqty;

    $isInCart = $user->checkCart($pid);

    if($isInCart == null){
        $user->insertCart($pname,$pprice,$pimage,$pqty,$total);

        echo '<div class="alert alert-success alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Item added to your cart!</strong> 
            </div>';

    }else{

        echo '<div class="alert alert-danger alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Item already added to your cart!</strong> 
            </div>';
    }

 
}

//Handle cart number ajax request
if(isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item'){
    $itemCount = $user->numberOfItem();

    echo $itemCount;
}


?>