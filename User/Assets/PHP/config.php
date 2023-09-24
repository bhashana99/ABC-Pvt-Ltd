<?php

class Database{

     //$dsn = data source network
     private $dsn = "mysql:host=localhost;port=3307;dbname=abc_pvt_ltd";
     private $dbuser = "root";
     private $dbpass = "";
     
     public $conn;
 
     public function __construct(){
         try{
             $this->conn = new PDO($this->dsn,$this->dbuser,$this->dbpass);
 
             echo 'Connected Successfully to the database!';
 
         }catch (PDOException $e){
             echo 'Error: '.$e->getMessage();
         }
 
         return $this->conn;
     }
 
}


// $checkDatabaseIsConnect = new Database();




?>