<?php
session_start();

// ------------------------------
require '../app/controller/AppController.php';
// -----------------------------

if(isset($_POST["submit"])){
    $controller = new AppController();
    $errorState = ["error"=>false,"message"=>""];
    $name = $_POST["email"];
    $password = $_POST["password"];
    $type = $_POST["type"];
    $con = empty($name) == false && empty($password) == false && empty($type) == false ;
    if($con == true){
        if($controller->CheckConnectionDB()){
            $controller->GetAllUsers();
            $found = false ;

            
            for ($i=0; $i < count($controller->AllUsers) ; $i++) { 

                $user = $controller->AllUsers[$i];
                if($user->GetName()==$name && $user->GetPassword()==$password && $user->GetType()==$type){
                    $found = true ;
                    $_SESSION["info"] = ["id"=>$user->GetId(),"name"=>$user->GetName(),"password"=>$user->GetPassword(),"type"=>$user->GetType()];
                    $_SESSION["pass"] = true ;
                } 
            }
            if($found == true){
                header('location:home.php');
            }else{
                $errorState["error"] = true;
                $errorState["message"] = "La connexion a échoué, vérifiez les informations que vous avez saisies.";
            }
            
        }else{
            $errorState["error"] = true;
            $errorState["message"] = "La connexion a échoué, erreur inconnue.";
        }
    }else{
        $errorState["error"] = true;
        $errorState["message"] = "Toutes les informations doivent être saisies.";
    }
}
?>
