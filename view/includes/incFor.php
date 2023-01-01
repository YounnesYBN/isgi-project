<?php

if ($_SESSION["pass"] == false) {
    header('location:login.php');
}

    include ('../components/AvancementDesProgrammesDeFormation.php');
    include ('../components/RealisationDesEvaluationDeModule.php');
    include ('../components/AnalyseResultatsEFMAccompagnentStagaires.php');
    include ('../components/PlanificationStagesEntrepriser.php');
    include ('../components/suiviRealisationsFormateurs.php');
?>