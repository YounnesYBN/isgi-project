<?php
session_start();
if ($_SESSION["pass"] == false) {
    header('location:login.php');
}

if (isset($_POST['submit'])) {
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../src/css/style.css">
    <link rel="stylesheet" href="../src/css/importExcel.css">
    <?php include '../src/css/tableStyle.php' ?>
</head>

<body>
    <header>
        <img src="../src/img/Logo.png" alt="ofppt logo">
        <h2>PV du 1er Consiel de Classe de au titre de L'année 2022/2023 pour chaque filière</h2>
        <form action="logout.php">
            <button type="submit" style="width: 90px; margin: 15px " id="btn-logout">Logout</button>
        </form>

    </header>
    <div id="popupCon" style="
        display:none;
        height: 100vh;
        width: 100%;
        position: absolute;
        z-index: 99;
        flex-direction: column;
        align-items: center;
        justify-content: center;">

        <div id="popup">
            <div class="X con">
                <button id="xbutton">
                    X
                </button>
            </div>
            <div class="textAria con">
                <textarea placeholder="Ajouter Une Option:" id="optionTextAria"></textarea>
            </div>
            <div class="AddBut con">
                <button id="addButt">
                    Ajouter
                </button>
            </div>
        </div>
    </div>
    <main>
        <form action="" method="POST">


            <section>
                <table id="tableGenerale">
                    <thead>
                        <tr>
                            <th>Aspeets à Trailer</th>
                            <th>Eléments de traitement</th>
                            <th>les données</th>
                            <th>commentaires</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        if ($_SESSION["info"]['type'] == "directeur") {
                            include 'includes/incDir.php';
                        } elseif ($_SESSION["info"]['type'] == "formateur") {
                            include 'includes/incFor.php';
                        } elseif ($_SESSION["info"]['type'] == "gestionnaires") {
                            include 'includes/incGst.php';
                        } elseif ($_SESSION["info"]['type'] == "conseiller") {
                            include 'includes/incCons.php';
                        }


                        ?>
                    </tbody>







                </table>
            </section>
            <div class="btnDiv">
                <button type="button" name="submit" id="btn-valide">Valider</button>
            </div>
        </form>
    </main>
    <footer style="
    display: flex;
    background-color: #072e55;
    height: 120px;
    align-items: center;
    justify-content: center;
    color: #fff;
    text-transform: uppercase;
    font-weight: bold;
    
    ">
        <p><a href="https://isgim.edupage.org" style="color: #009879;">ISGI</a> All Right Reserved &copy;</p>
    </footer>

    <script src="./../src/js/table2excel.js"></script>
    <script src="../src/js/jquery-3.6.3.min.js"></script>
    <script src="../src/js/script.js"></script>
    <script src="../src/js/export.js"></script>
</body>

</html>