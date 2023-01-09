<?php
session_start();

include "./AppController.php" ;
$controller = new AppController();

if(isset($_POST["updateInfo"])){
    $AllElement = $_POST["allElement"] ;
    $_SESSION["test"] = $AllElement ;
   foreach($AllElement as $element){
        if($element["type"] == "number"){

            $controller->UpdateElementNumber($element["value"],$element["id_ele"]);
        }else{
            $controller->UpdateElementTextaria($element["id_ele"],$_SESSION["info"]["id"],$element["value"]);
        }
   }
}


?>