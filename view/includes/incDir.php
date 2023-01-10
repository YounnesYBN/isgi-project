<?php
include dirname(__DIR__) . "../../app/controller/AppController.php";
if ($_SESSION["pass"] == false) {
    header('location:login.php');
}

include dirname(__DIR__) . '../components/ValidationDesGroups.php';
include dirname(__DIR__) . '../components/AvancementDesProgrammesDeFormation.php';
include dirname(__DIR__) . '../components/RealisationDesEvaluationDeModule.php';
include dirname(__DIR__) . '../components/AnalyseResultatsEFMAccompagnentStagaires.php';
include dirname(__DIR__) . '../components/PlanificationStagesEntrepriser.php';
include dirname(__DIR__) . '../components/suiviRealisationsFormateurs.php';
