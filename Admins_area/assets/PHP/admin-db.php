<?php

require_once 'config.php';

class Admin extends Database{

    //SUper Admin Login
    public function superAdmin_login($email,$password){
        $sql = "SELECT email, password FROM super_admin WHERE email = :email AND password = :password ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email, 'password'=>$password]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }
    // Admin Login
    public function admin_login($email,$password){
        $sql = "SELECT email, password FROM admin WHERE email = :email AND password = :password ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email, 'password'=>$password]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

     //Check  product
     public function check_product($product_title){
        $sql = "SELECT * FROM products WHERE title=:product_title";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['product_title'=>$product_title]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
        return $row;
       }

       //insert product
     public function insert_product($title,$desc,$img,$price,$status){
        $sql = "INSERT INTO products(title,description,image,price,date,status)VALUES (:title,:desc,:img,:price,NOW(),:status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['title'=>$title,'desc'=>$desc,'img'=>$img,'price'=>$price,'status'=>$status]);
        return true;
       }

        //fetch all products
     public function fetchAll_products(){
        $sql = "SELECT * FROM products";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
        return $row;
       }
  
       //fetchAll Product details
       public function getProductDetails($id){
        $sql = "SELECT * FROM products WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
        return $row;
       }
  
       //Update Product details
       public function updateProduct($id,$title,$desc,$price){
        $sql = "UPDATE products SET title = :title, description = :desc, price = :price WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute(['id' => $id,'title' => $title, 'desc' => $desc, 'price' => $price]);
        
        if($result){
            return 'success';
        }else{

            return 'error';
        }
        
       }
  
       //delete product
       public function delete_product($id){
        $sql = "DELETE FROM products WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
  
        return true;
       }

       //check admin
       public function check_admin($email){
        $sql = "SELECT * FROM admin WHERE email=:email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
       }

       //create admin
       public function createNew_admin($name,$email,$password,$phone){
        $sql = "INSERT INTO admin(name,email,password,phone) VALUES (:name,:email,:password,:phone)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name'=>$name,'email'=>$email,'password'=>$password,'phone'=>$phone]);
        return true;
       }

        //fetch all admins
        public function fetchAll_admins(){
        $sql = "SELECT * FROM admin";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
        return $row;
       }

        //fetchAll admin details
        public function getAdminDetails($id){
            $sql = "SELECT * FROM admin WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
            return $row;
           }
      
           //Update admin details
           public function updateAdmin($id,$name,$phone){
            $sql = "UPDATE admin SET name=:name, phone=:phone WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id,'name'=>$name, 'phone'=>$phone]);
            return true;
           }
      
           //delete admin
           public function delete_admin($id){
            $sql = "DELETE FROM admin WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
      
            return true;
           }



}