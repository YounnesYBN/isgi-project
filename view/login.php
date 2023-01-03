<?php 

include dirname(__DIR__). "../app/controller/loginController.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../src/css/style.css">
    <title>Login</title>
</head>
<body>
    <header>
        <img src="../src/img/Logo.png" alt="ofppt logo">
        <h2>PV du 1er Consiel de Classe de au titre de L'année 2022/2023 pour chaque filière</h2>
    </header>

    <section class="login-section">

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
            </form>
        </div>
        <span id="alertspan">
            <?php echo (isset($errorState) ? 'Oops! : ' . $errorState['message'] : '' )?>
        </span>
    </section>


    
</body>
</html>