<?php
 require_once './session.php';

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
    $currentUserId = $cid;
    $isInCart = $user->checkCart($pid);

    if($isInCart == null){
        $user->insertCart($currentUserId,$pname,$pprice,$pimage,$pqty,$total);

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


if(isset($_POST['action']) && $_POST['action'] == 'displayItem'){
    $output = '';
    $items = $user->getItemDetailsCart($cid);

    $grandTotal = 0;
    $path = '../images/product_images/';

    // print_r($items);
    if($items){
        $output .= '<table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <td colspan="7">
                                    <h4 class="text-center text-info m-0">Products in your cart!</h4>
                                </td>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>
                                <a href="#" class="clearCart badge-danger badge p-1">
                                    <i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart
                                </a>
                            </th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($items as $item){
                            $product_price = $item['product_price'];
                            $totalPrice = $item['product_price']*$item['qty'];
                            $grandTotal += $totalPrice; 
                            $imageSrc = $path.$item['product_image'];


                            $output .= '<tr>
                                            <td>'.$item['id'].'</td>
                                            <input type="hidden" class="pid" value="'.$item['id'].'">

                                            <td><img src="'.$imageSrc.'" alt="" width="50"></td>

                                            <td>'.$item['product_name'].'</td>

                                            <td><i class="fa-solid fa-rupee"></i>&nbsp;&nbsp;'.number_format($product_price,2).'</td>

                                            <input type="hidden" class="pprice" value="'.$item['product_price'].'">
                                            
                                            <td><input type="number" class="form-control itemQty"   value="'.$item['qty'].'" style="width:75px;" min="1"></td>

                                            <td><i class="fa-solid fa-rupee"></i>&nbsp;&nbsp; '.number_format($totalPrice,2).' </td>
                                            <td><a href="#" class="text-danger lead itemRemove" data-id="'.$item['id'].'"><i class="fas fa-trash-alt"></i></a></td>
                        
                                        </tr>';
                        }
                        $output .= '<tr>
                                        <td colspan="3">
                                        <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping</a>
                                        </td>
                                        <td colspan="2"><b>Grand Total</b></td>
                                        <td><b><i class="fa-solid fa-rupee"></i>&nbsp;&nbsp;'.number_format($grandTotal,2).'</b></td>
                                        <td>
                                        <a href="checkout.php" class="btn btn-info " ><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                                        </td>
                                    </tr>
                                </tbody>
                                
                            </table>';
                            echo $output;
                            // echo 'Formatted Total Price: ' . number_format($totalPrice, 2);

    }else{
        echo '<h3 class="text-center text-secondary mt-5">:(  You have not added  any item yet! add your first item now!';

    }

}

//handle change qty ajax request
if(isset($_POST['action']) && $_POST['action'] == 'change_qty'){
    // print_r($_POST);
    $qty = $_POST['qty'];
    $id = $_POST['pid'];
    $price = $_POST['pprice'];
    $cid = $cid;

   
    $total = $price * $qty;
    // echo 'Qty: '. $qty .', ID: '. $id .', Price: '. $price.' total: '.$total.' ' ;

    $data = $user->changeQty($id,$cid,$total,$qty);
   

}

//Handle delete all item in cart
if(isset($_POST['action']) && $_POST['action'] == 'delete_item'){
    
    // print_r($_POST);
    $pid = $_POST['pid'];
    // print_r($pid);
    $user->deleteOneItem($pid,$cid);
}

?>