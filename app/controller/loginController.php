<?php
$errorState = ["error"=>false,"message"=>""];
session_start();
include "./AppController.php";
$controller = new AppController();
if(isset($_GET["login"])){
    $name = $_GET["email"];
    $password = $_GET["password"];
    $type = $_GET["type"];
    $con = empty($name) == false &&empty($password) == false &&empty($type) == false ;
    if($con == true){

        if($controller->CheckConnectionDB()){
            $controller->GetAllUsers();
            $found = false ;
            for ($i=0; $i < $controller->AllUsers; $i++) { 
                $user = $controller->AllUsers[$i];
                if($user->GetName()==$name&&$user->GetPassword()==$password&&$user->GetType()==$type){
                    $found = true ;
                    $_SESSION["info"] = ["id"=>$user->GetId(),"name"=>$user->GetName(),"password"=>$user->GetPrenom(),"type"=>$user->GetType()];
                    $_SESSION["pass"] = true ;
                } 
            }
            if($found == true){
                $errorState["error"] = false;
                $errorState["message"] = "login success";
            }else{
                $errorState["error"] = true;
                $errorState["message"] = "login failed";
            }
            
        }else{
            $errorState["error"] = true;
            $errorState["message"] = "error in database";
        }
    }else{
        $errorState["error"] = true;
        $errorState["message"] = "enter all info";
    }
}





?>