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
    <script src="./../src/js/table2excel.js"></script>
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
            <nav>
                <select name="filiere" id="selFiliere">
                    <option value="Filiere">Filière</option>
                    <option value="AA">AA</option>
                    <option value="AAOC">AAOC</option>
                    <option value="AAOCP">AAOCP</option>
                    <option value="AAOG">AAOG</option>
                    <option value="DEVOAM">DEVOAM</option>
                    <option value="DEVOWF">DEVOWF</option>
                    <option value="GE">GE</option>
                    <option value="GEOCF">GEOCF</option>
                    <option value="GEOCM">GEOCM</option>
                    <option value="GEOOM">GEOOM</option>
                    <option value="GEORH">GEORH</option>
                    <option value="ID">ID</option>
                    <option value="IF">IF</option>
                    <option value="INFO">INFO</option>
                    <option value="IDOCC">IDOCC</option>
                    <option value="IDOSR">IDOSR</option>
                    <option value="PG">PG</option>
                    <option value="TSPG">TSPG</option>
                </select>
                <select name="annee" id="selAnnee">
                    <option value="annee">Année</option>
                    <option value="A1">A1</option>
                    <option value="A2">A2</option>
                </select>
                <select name="modeFormation" id="selModeFormation">
                    <option value="modeFormation">Mode Formation</option>
                    <option value="residetiel">Résidetiel</option>
                    <option value="alterné">Alterné</option>
                </select>
            </nav>

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

    <script src="../src/js/jquery-3.6.3.min.js"></script>
    <script src="../src/js/script.js"></script>
    <script src="../src/js/export.js"></script>
</body>

</html>