<?php

if ($_SESSION["pass"] == false) {
    header('location:login.php');
}
    include dirname(__DIR__).'../components/Deperdition.php';
    include dirname(__DIR__).'../components/AnalyseResultatsEFMAccompagnentStagaires.php';
?>