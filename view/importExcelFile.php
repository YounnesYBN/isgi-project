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
    <link rel="stylesheet" href="../src/css/fontAwesome.min.css">
    <?php include "../src/css/tableStyle.php";?>
    <title>Select Excel File</title>
</head>
<body>
<header>
    <img src="../src/img/Logo.png" alt="ofppt logo">
    <h2>PV du 1er Consiel de Classe de au titre de L'année 2022/2023 pour chaque filière</h2>
    <form action="logout.php">
        <button type="submit" style="width: 90px; margin: 15px " id="btn-logout">Logout</button>
    </form>

</header>
<section>
    <input type="number" id="max_inp" placeholder="max">
    <input type="number" id="min_inp" placeholder="min">
</section>
<section>

    <label class="custom-file-upload">
        <input  type="file" id="fileHolder"/>
        <span class="container">
        <img src="../src/img/download.jpg" alt="download photo">
        </span>
    </label>
    <p id="message">

    </p>

    <button type="submit" name="submit" id="btn-ok">Valider</button>


</section>




<footer>
    <p><a href="">ISGI</a> All Right Reserved &copy;</p>
</footer>

<script src="./../src/js/importedExcelFile.js"></script>
</body>
</html>