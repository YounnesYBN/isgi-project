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

    <div class="containerLogin">
        <h2>S'identifier</h2>
        <form method="post">
            <label>Email</label>
            <input type="text" name="email" id="inEmail">
            <label>Mot de passe</label>
            <input type="password" name="password" id="inEmail">
            <select name="type">
                <option>Type De Visiteur</option>
                <option value="formateur">Formateur</option>
                <option value="gestionnaires">Gestionnaires Des Stagaires</option>
                <option value="directeur">Directeur</option>
                <option value="conseiller">Conseiller</option>
            </select>
            <button type="submit" name="submit">S'identifier</button>
            <span>
                <?php echo (isset($errorState) ? 'Oops! : ' . $errorState['message'] : '' )?>
            </span>
        </form>
    </div>

    <script src="../src/js/jquery-3.6.3.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>
</html>