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
}