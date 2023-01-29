<?php
include "./AppController.php";
$controller = new AppController();

if (isset($_POST['setData'])) {

  $dataArray = $_POST['dataArray'];
  foreach ($dataArray as $element) {

    $controller->UpdateElementNumber($element["val"], $element["id_ele"]);
  }

  echo json_encode(["error" => false]);
}