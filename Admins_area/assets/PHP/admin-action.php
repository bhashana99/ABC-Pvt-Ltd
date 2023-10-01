<?php

require_once 'admin-db.php';

$admin = new Admin();
session_start();


//Handle Admin Login Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'superAdminLogin'){
    // print_r($_POST);
    $email = $admin->test_input($_POST['email']);
    $password = $admin->test_input($_POST['password']);

    $hpassword = sha1($password);

    $loggedInSuperAdmin = $admin->superAdmin_login($email,$hpassword);
    $loggedInAdmin = $admin->admin_login($email,$hpassword);
    
    if($loggedInSuperAdmin != null){
        echo 'superAdmin_login';
        $_SESSION['sAemail'] = $email;
    }else if($loggedInAdmin != null){
        echo 'admin_login';
        $_SESSION['aEmail'] = $email;
    }
    else{
        
        echo $admin->showMessage('danger','Username or Password is Incorrect!');
        echo $admin->showMessage('warning','Get More Help->Contact Super Admin');
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
if(isset($_POST['edit_id'])){
    // print_r($_POST);
    $id = $_POST['edit_id']; 
    $row = $admin->getProductDetails($id);
    echo json_encode($row);
}

//Handle product updated ajax request
if(isset($_POST['action']) && $_POST['action'] == 'update_product'){
    // print_r($_POST);
    $id = $_POST['id'];
    $title = $admin->test_input($_POST['title']);
    $description = $admin->test_input($_POST['description']);
    $price = $admin->test_input($_POST['price']);

    // echo $id, " ",$title," ",$description," ",$price;
    $admin->updateProduct($id,$title,$description,$price);    
}

//Handle delete product ajax request
if(isset($_POST['pDel_id'])){
    $id = $admin->test_input($_POST['pDel_id']);
    // print_r($_POST['pDel_id']);
    // print_r($id);
    $admin->delete_product($id);
}

//Handle add new admin ajax request
if(isset($_POST['action']) && $_POST['action'] == 'newAdmin'){
    // print_r($_POST);
    $name = $admin->test_input($_POST['admin_name']);
    $email = $admin->test_input($_POST['admin_email']);
    $phone = $admin->test_input($_POST['admin_phone']);
    $password = $admin->test_input($_POST['admin_password']);
    $status = false;
    $hidePassword = sha1($password); 

    $isAdmin = $admin->check_admin($email);

    if($isAdmin == null){
        $admin->createNew_admin($name,$email,$hidePassword,$phone);
        echo 'newAdmin_here';
    }else{
        echo $admin->showMessage('danger', "This $email already exists! Try another E-Mail");
    }

}

//Handle Fetch all admins Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'fetchAllAdmin'){
    $output = '';
    $data = $admin->fetchAll_admins();
    
    if($data){
        $output .= '<table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Phone Number</th>
                <th>Action</th>    
            </tr>
        </thead>
                <tbody>';
                foreach($data as $admin){

                    $output .= '<tr>
                                    <td>'.$admin['id'].'</td>
                                    <td>'.$admin['name'].'</td>
                                    <td>'.$admin['email'].'</td>
                                    <td>'.$admin['phone'].'</td>
                                    <td>
                                    <a href="#" id="'.$admin['id'].'" title="Edit Admin details" 
                                     class="text-primary adminEditIcon" data-toggle="modal" data-target="#editAdminModal" >
                                     <i class="fa-solid fa-pen-to-square"></i></a>&nbsp;&nbsp;
                                
                                    <a href="#" id="'.$admin['id'].'" title="Delete Admin" class="text-danger deleteAdminIcon" >
                                    <i class="fa-regular fa-trash-can"></i></a>&nbsp;&nbsp;
                                 </td>
                                </tr>';
                    
                    
                }
                $output .= '</tbody>
                </table>';
                        
                echo $output;            
    } else{
        echo '<h3 class="text-center text-secondary">:( You have not admins yet!';
      }
}


//handle admin details edit ajax request
if(isset($_POST['pEdit_id'])){
    //print_r($_POST);
    $eid = $_POST['pEdit_id'];
    //print_r($id);
    $row = $admin->getAdminDetails($eid);
    // print_r($row);
    echo json_encode($row);

}

//handle update admin details
if(isset($_POST['action']) && $_POST['action'] == 'update_admin'){
    // print_r($_POST);
    $id = $_POST['id'];
    $name = $admin->test_input($_POST['name']);
    $phone = $admin->test_input($_POST['phone']);
   
    $admin->updateAdmin($id,$name,$phone);    
}

//Handle delete product ajax request
if(isset($_POST['pDel_id'])){
    $id = $admin->test_input($_POST['pDel_id']);
    // print_r($_POST['pDel_id']);
    // print_r($id);
    $admin->delete_admin($id);
}


//Handle Fetch All Users Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'fetchAllUsers'){
    // echo 'Working..';
    $output = '';
    $data = $admin->fetchAllUsers(0);
    $path = '../../images/user_images/';
 
    if($data){
     $output .= '<table class="table table-striped table-bordered text-center">
                     <thead>
                         <tr>
                             <th>#</th>
                             <th>Image</th>
                             <th>Name</th>
                             <th>E-Mail</th>
                             <th>Phone</th>
                             <th>Gender</th>
                             <th>Verified</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>';
                 foreach ($data as $row) {
                     if($row['photo'] != ''){
                         $uphoto = $path.$row['photo'];
                     }
                     else{
                         $uphoto = '../../images/avatar.png';
                     }
                     $output .= '<tr>
                                     <td>'.$row['id'].'</td>
                                     <td><img src="'.$uphoto.'" class="rounded-circle" width="40px" height="40px"></td>
                                     <td>'.$row['name'].'</td>
                                     <td>'.$row['email'].'</td>
                                     <td>'.$row['phone'].'</td>
                                     <td>'.$row['gender'].'</td>
                                     <td>'.$row['verified'].'</td>
                                     <td>
                                         <a href="#" id="'.$row['id'].'" title="View Details" 
                                          class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUserDetailsModal" >
                                             <i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
 
                                         <a href="#" id="'.$row['id'].'" title="Block User" class="text-danger blockUserIcon" >
                                         <i class="fa-solid fa-ban"></i></a>&nbsp;&nbsp;
                                      </td>
                                 </tr>';
                 }
                 $output .= '</tbody>
                 </table>';
                         
                 echo $output;               
    }
    else{
     echo '<h3 class="text-center text-secondary">:( No any user registered yet!</h3>';
    }
 }
 
 
//Handle Display User In Details Ajax Request
if(isset($_POST['details_id'])){
    $id = $_POST['details_id'];

    $data = $admin->fetchUserDetailsById($id);

    echo json_encode($data);
}


?>