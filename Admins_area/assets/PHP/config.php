<?php

class Database{

    const USERNAME = 'bhashanachamodya99@gmail.com';
    const PASSWORD = 'fkoctjkkbsjwhicu';

     //$dsn = data source network
     private $dsn = "mysql:host=localhost;port=3307;dbname=abc_pvt_ltd";
     private $dbuser = "root";
     private $dbpass = "";
     
     public $conn;
 
     public function __construct(){
         try{
             $this->conn = new PDO($this->dsn,$this->dbuser,$this->dbpass);
 
             //echo 'Connected Successfully to the database!';
 
         }catch (PDOException $e){
             echo 'Error: '.$e->getMessage();
         }
 
         return $this->conn;
     }

     //Check Input
    public function test_input($data){
        $data = trim($data);  //trim remove all white spaces
        $data = stripcslashes($data); // to remove all slashes
        $data = htmlspecialchars($data); //to remove special chars (@ < >)
        return $data;
    }

    //Error Success Message Alter
    public function showMessage($type,$message){
        return '<div class="alert alert-'.$type.' alert-dismissible" >
                    <button class="close" type="button" data-dismiss="alert" > &times;
                    </button>
                    <strong class="text-center" >'.$message.'</strong>   
                </div>';
    }


 
}


// $checkDatabaseIsConnect = new Database();

?>