<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c3 = new AppController();
$c3->GetAllElement();
$arrayAfterFilter3 = [];
foreach($c3->AllElement as $element){
      if($element->GetAspeets_traiter()->GetLibelle() == "Réalisation des Evalutions de fin de Module"){
        $arrayAfterFilter3[] = $element ;
      }
}
$rowSpanNum3 = count($arrayAfterFilter3) + 1 ;

$validationGroupRows3 = "

    <tr>
        <td rowspan='{$rowSpanNum3}'>Réalisation des Evalutions de fin de Module</td>
    </tr>
";

foreach($arrayAfterFilter3 as $element){
    $validationGroupRows3 .= "
        <tr>
            <td>{$element->GetElement()}</td>
            <td><input type='number' value='{$element->GetDonnees()}' /></td>
            <td><input type='text' /></td>
        </tr>
    " ;

}

echo $validationGroupRows3 ;

?>