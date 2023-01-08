<?php 

include "AppController.php";
$controller = new AppController();

if(isset($_POST["addOption"])){
    $id_ele = $_POST["id_ele"] ;
    $id_user = $_POST["id_user"] ;
    $message = $_POST["message"] ;
    $rs = $controller->addOption($id_user,$id_ele,$message);
    echo json_encode($rs);
}


?>