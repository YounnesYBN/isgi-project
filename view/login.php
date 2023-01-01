<?php
session_start();

// ------------------------------
require '../app/controller/AppController.php';
// -----------------------------

$errorState = ["error"=>false,"message"=>""];
$controller = new AppController();
if(isset($_POST["submit"])){
    $name = $_POST["email"];
    $password = $_POST["password"];
    $type = $_POST["type"];
    $con = empty($name) == false && empty($password) == false && empty($type) == false ;
    if($con == true){
        if($controller->CheckConnectionDB()){
            $controller->GetAllUsers();
            $found = false ;

            // you forgot the count() Function GG
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../src/css/style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <img src="../src/img/Logo.png" alt="ofppt logo">
        <h2>PV du 1er Consiel de Classe de au titre de L'année 2022/2023 pour chaque filière</h2>
    </header>
    <form method="post">
        <label>Email</label>
        <input type="text" name="email" id="inEmail">
        <label>Mot de passe</label>
        <input type="password" name="password" id="inEmail">
        <select name="type">
            <option value="formateur">Formateur Parrains</option>
            <option value="gestionnaires">Gestionnaires Des Stagaires</option>
            <option value="directeur">Directeur</option>
        </select>
        <button type="submit" name="submit">Login</button>
    </form>
    <?php echo $errorState['message'];?>
</body>
</html>