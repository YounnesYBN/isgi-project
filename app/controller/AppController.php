<?php 
include dirname(__DIR__). "../module/pdo.php";
include dirname(__DIR__). "../module/user.php";

class AppController{

   public $AllUsers = array();

   public function CheckConnectionDB(){
    $db = new PDOdb();
    return $db->ConnecteToDB();
   } 

   public function GetAllUsers(){
    $db = new PDOdb();
    $db->ConnecteToDB() ;
    $q = "select * from utilisateur";
    $rs = $db->SelectQeurys($q);
    while($line = $rs->fetch()){
        $user = new User($line["id"],$line["email"],$line["password"],$line["type"]);
        $this->AllUsers[] = $user ;
    }

   }



}

?>