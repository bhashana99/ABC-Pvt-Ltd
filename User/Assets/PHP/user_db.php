<?php

require_once 'config.php';

class UserDB extends Database{

    //Register New User
    public function register($name,$email,$password,$phone){
        $sql = "INSERT INTO users (name,email,password,phone) VALUES (:name,:email,:pass,:phone)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name'=>$name,'email'=>$email,'pass'=>$password,'phone'=>$phone]);
        return true;
    }

    //Check if user already registered
    public function user_exist($email){
        $sql = "SELECT email FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

     //Login Existing User
     public function login($email){
        $sql = "SELECT email,password FROM users WHERE email = :email AND blocked != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' =>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }









}




?>