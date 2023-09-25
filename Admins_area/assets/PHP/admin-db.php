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

}