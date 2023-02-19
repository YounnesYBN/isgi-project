<?php

session_start();
if ($_SESSION["pass"] == false) {
    header('location:login.php');
}

if (isset($_POST['submit'])) {
}
?>

<!doctype html>
<html lang="en">

<head>
    <script src="./../src/js/xlsx.full.min.js"></script>
    <script src="./../src/js/jquery-3.6.3.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../src/css/style.css">
    <link rel="stylesheet" href="../src/css/importExcel.css">
    <?php include "../src/css/tableStyle.php"; ?>
    <title>Select Excel File</title>
    <style>
        #max_inp,
        #min_inp {
            /* width: 35%; */
            border: 1px solid #006c57;
            width: 60%;
            border-radius: 10px;
        }

        #touxCon {
            font-size: 20px;
            padding: 12px;
            margin: 50px 0;
        }

        select {
            width: calc(100% / 3 - 1%);
            background-color: #009879;
            color: rgb(255, 255, 255);
            text-align: center;
            height: 40px;
            border-radius: 5px;
            outline: none;
            font-size: 15px;

        }

        select option {
            background-color: white;
            color: black;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <header>
        <img src="../src/img/Logo.png" alt="ofppt logo">
        <h2>PV du 1er Consiel de Classe de au titre de L'année 2022/2023 pour chaque filière</h2>
        <form action="logout.php">
            <button type="submit" style="width: 90px; margin: 15px " id="btn-logout">Logout</button>
        </form>

    </header>
    <section id="touxCon">


        <input type="number" id="min_inp" placeholder="La Moyen:">

        <input type="number" id="max_inp" placeholder="Convenable:">

        <select name="" id="selectYear">
            <option value="1">1A</option>
            <option value="2">2A</option>
        </select>
        <select name="" id="filierSelect">

        </select>

    </section>
    <section>

        <label class="custom-file-upload">
            <input type="file" id="fileHolder" />
            <span class="container">
                <img src="../src/img/download.jpg" alt="download photo">
            </span>
        </label>
        <p id="message">

        </p>

        <div class="buttons">
            <button type="submit" name="submit" id="btn-ok">Valider</button>
            <button id="btn-Accueil"><a href="./home.php">Accueil</a></button>
            <button id="btn-demandeMH"><a href="./demandeMH.php">demande MH</a></button>
        </div>


    </section>




    <footer>
        <p><a href="https://isgim.edupage.org">ISGI</a> All Right Reserved &copy;</p>
    </footer>

    <script src="./../src/js/importedExcelFile.js"></script>
</body>

</html>