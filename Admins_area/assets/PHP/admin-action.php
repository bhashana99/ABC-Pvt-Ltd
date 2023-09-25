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



//Handle Fetch all products Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'fetchAllProduct'){
    $output = '';
    $data = $admin->fetchAll_products();
    $path = '../../images/product_images/';
    
    if($data){
        $output .= '<table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th>    
            </tr>
        </thead>
                <tbody>';
                foreach($data as $product){

                    $image = $path.$product['image'];
                    //echo $image1;
                    
                    

                    $output .= '<tr>
                                    <td>'.$product['id'].'</td>
                                    <td><img src="'.$image.'" class="rounded mx-auto d-block" width="50px" height="50px"></td>
                                    <td>'.$product['title'].'</td>
                                    <td>'.$product['description'].'</td>
                                    <td>$'.$product['price'].'</td>
                                    <td>
                                    <a href="#" id="'.$product['id'].'" title="Edit Product details" 
                                     class="text-primary productEditIcon" data-toggle="modal" data-target="#editProductModal" >
                                     <i class="fa-solid fa-pen-to-square"></i></a>&nbsp;&nbsp;

                                    <a href="#" id="'.$product['id'].'" title="Delete product" class="text-danger deleteProductIcon" >
                                    <i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
                                 </td>
                                </tr>';
                    
                    
                }
                $output .= '</tbody>
                </table>';
                        
                echo $output;            
    } else{
        echo '<h3 class="text-center text-secondary">:( You have not product yet!';
      }
}


//handle product edit ajax request
if(isset($_POST['pEdit_id'])){
    //print_r($_POST);
    $eid = $_POST['pEdit_id'];
    //print_r($id);
    $row = $admin->getProductDetails($eid);
    // print_r($row);
    echo json_encode($row);

}

if(isset($_POST['action']) && $_POST['action'] == 'update_product'){
    // print_r($_POST);
    $id = $admin->test_input($_POST['id']);
    $title = $admin->test_input($_POST['title']);
    $description = $admin->test_input($_POST['description']);
    $price = $admin->test_input($_POST['price']);

    $admin->updateProduct($id,$title,$description,$price);    
}

//Handle delete product ajax request
if(isset($_POST['pDel_id'])){
    $id = $admin->test_input($_POST['pDel_id']);
    // print_r($_POST['pDel_id']);
    // print_r($id);
    $admin->delete_product($id);
}




?>