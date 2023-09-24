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

    //Current User In Session
    public function currentUser($email){
        $sql = "SELECT * FROM users WHERE email = :email AND blocked != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' =>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    //Forgot Password
    public function forgot_password($token,$email){
        $sql = "UPDATE users SET token = :token, token_expire = Date_ADD(NOW(),INTERVAL 10 MINUTE) WHERE email=:email ";

        $stmt =$this->conn->prepare($sql);
        $stmt->execute(['token'=>$token,'email'=>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return true;
    }

     //Reset Password User Auth
     public function reset_pass_auth($email,$token){
        $sql = "SELECT id FROM users WHERE email = :email AND token = :token AND token != '' AND token_expire > NOW() AND blocked != 0";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email,'token'=>$token]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    //Update New Password
    public function update_new_pass($pass,$email){
        $sql = "UPDATE users SET token='' , password = :pass WHERE email = :email AND blocked != 0  ";

        $stmt =$this->conn->prepare($sql);
        $stmt->execute(['email'=>$email,'pass'=>$pass]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return true;

    }







}




?>