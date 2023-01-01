<?php

if ($_SESSION["pass"] == false) {
    header('location:login.php');
}
    include ('../components/Deperdition.php');
    include ('../components/Assiduite.php');
    include ('../components/AnalyseResultatsEFMAccompagnentStagaires.php');

?>