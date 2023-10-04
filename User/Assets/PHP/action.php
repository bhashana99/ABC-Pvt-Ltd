<?php
require_once './session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


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
    $isInCart = $cUser->checkCart($pid);

    if($isInCart == null){
        $cUser->insertCart($currentUserId,$pname,$pprice,$pimage,$pqty,$total);

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
    $itemCount = $cUser->numberOfItem();

    echo $itemCount;
}


if(isset($_POST['action']) && $_POST['action'] == 'displayItem'){
    $output = '';
    $items = $cUser->getItemDetailsCart($cid);

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
                                        <a href="home.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping</a>
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
        echo '<div class="text-center "><h3 class="text-center text-secondary mt-5">:( <br><br> You have not added  any item yet! <br>add your first item now!</h3>
    <a href="home.php" class="btn btn-success mt-3"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping</a></div>
    ';
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

    $data = $cUser->changeQty($id,$cid,$total,$qty);
   

}

//Handle delete one item in cart
if(isset($_POST['action']) && $_POST['action'] == 'delete_item'){
    
    // print_r($_POST);
    $pid = $_POST['pid'];
    // print_r($pid);
    $cUser->deleteOneItem($pid,$cid);
}

//Handle delete all item in cart
if(isset($_POST['action']) && $_POST['action'] == 'deleteAll_item'){
    // print_r($_POST);
    $cUser->deleteAllItem($cid);
}

//Handle show checkout details
if(isset($_POST['action']) && $_POST['action'] == 'checkout'){
// print_r($_POST);
$output = '';
$data = $cUser->summaryCart($cid);
//  print_r($data);
 $grandTotal = 0;
 $items=[];

if($data){


    foreach($data as $item){
        $grandTotal += $item['total_price'];
        $items[] = $item['ItemQty'];
    }

    $allItems = implode(", ",$items);

    $output .= '
                    <div class="row justify-content-center">
                        <div class="col-lg-6 px-4 pb-4" id="order">
                            <h4 class="text-center text-info p-2">Complete your order!</h4>
                            <div class="jumbotron p-3 mb-2 text-center">
                                <h6 class="lead"><b>Product(s) : </b><span id="allProducts">'.$allItems.'</span></h6>
                                <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
                                <h5><b>Total Amount Payable : </b><span id="total">'.number_format($grandTotal,2).'</span>/-</h5>
                            </div>
                            <form action="" method="post" id="placeOrder">
                                <input type="hidden" name="products" id="pnames" value="'.$allItems.'">
                                <input type="hidden" name="grand_total" id="ototal" value="'.$grandTotal.'">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="phone" pattern="^\+94\d{9}$" class="form-control" placeholder="+94xxxxxxxxx" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="address" class="form-control" cols="30" rows="8" placeholder="Enter Delivery Address Here..."></textarea>
                                </div>
                                <h6 class="text-center lead">Select Payment Mode</h6>
                                <div class="form-group">
                                    <select name="pmode" class="form-control">
                                        <option value="" selected disabled>Cash On Delivery</option>
                                        <option value="cards">Debit/Credit Card</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block submit">
                                </div>
                            </form>
                        </div>
                    </div>
                        
                ';

                echo $output;

}else{
    echo '<div class="text-center "><h3 class="text-center text-secondary mt-5">:( <br><br> You have not added  any item yet! <br>add your first item now!</h3>
    <a href="home.php" class="btn btn-success mt-3"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping</a></div>
    ';

}

}

//Handle delivery ajax request
if(isset($_POST['action']) && $_POST['action'] == 'check_out'){
    // print_r($_POST);
    $products = $_POST['products'];
    $grandTotal = $_POST['grand_total'];
    $name = $_POST['name'];
    $email = $_POST['email']; 
    $phone = $_POST['phone']; 
    $address = $_POST['address']; 
    $pmode = $_POST['pmode'];

    $cUser->insertOrder($cid,$name,$email,$phone,$address,$pmode,$products,$grandTotal);
    $cUser->deleteAllItem($cid);

    $data = '.<div class="text-center">
    <h1 class="display-4 mt-2 text-danger">Thank You!</h1>
    <h2 class="text-success">Your Order Placed Successfully!</h2>
    <h4 class="bg-danger text-light rounded p-2">Item Purchased: '.$products.' </h4>
    <h4>Your Name : '.$name.'</h4>
    <h4>Your E-Mail : '.$email.'</h4>
    <h4>Your Phone : '.$phone.'</h4>
    <h4>Total Amount Paid : '.number_format($grandTotal,2).'</h4>
    <h4>Payment Mode : '.$pmode.'</h4>
    <a href="home.php" class="btn btn-success mt-3"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Back to Shopping</a>
 </div>.';
 echo $data;

}

///Handle Profile Update Ajax Request
if(isset($_FILES['image'])){
    $name = $cUser->test_input($_POST['name']);
    $gender = $cUser->test_input($_POST['gender']);
    $dob = $cUser->test_input($_POST['dob']);
    $phone = $cUser->test_input($_POST['phone']);
  
    $oldImage = $_POST['oldimage'];
    $user_image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
  
    if(isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")){
        // $user_image = $folder.$_FILES['image']['name'];
    move_uploaded_file($tmp_image,"../../../images/user_images/$user_image");
  
  
    if($oldImage != null && file_exists($oldImage)){
      unlink($oldImage);
  }
    }
    else{
        $user_image = $oldImage;
    }
    $cUser->update_profile($name, $gender, $dob, $phone, $user_image, $cid);
  }

 
 // Handle Change Password Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'change_pass'){
    // print_r($_POST);
    $currentPass = $_POST['curpass'];
    $newPass = $_POST['newpass'];
    $cnewPass = $_POST['cnewpass'];
 
    $hnewPass = password_hash($newPass, PASSWORD_DEFAULT);
 
    if($newPass != $cnewPass){
     echo $cUser->showMessage('danger', 'Password did not matched!');
    }
    else{
     if(password_verify($currentPass, $cpass)){
         $cUser->change_password($hnewPass,$cid);
         echo $cUser->showMessage('success','Password Changed Successfully!');

     }
     else{
         echo $cUser->showMessage('danger','Current Password is Wrong!');
     }
    }
 }
  


//Handle Verify E-Mail Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'verify_email'){
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
        $mail->addAddress($cemail);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'E-Mail Verification';
        $mail->Body = '<h4><br><a href="http://localhost/project/SENG-21253/ABC(Pvt)Ltd/User/verify-email.php?email='.$cemail.'">Verify your E-Mail Click Here.</a></h4>';

        $mail->send();
        echo $cUser->showMessage('success','Verification link sent to your E-Mail.');
    }
    catch(Exception $e){
        echo $cUser->showMessage('danger','Something went wrong please try again later!');
        
    }
}


?>