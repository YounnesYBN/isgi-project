
<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c1 = new AppController();
$c1->GetAllElement();
$arrayAfterFilter1 = [];
foreach($c1->AllElement as $element){
      if($element->GetAspeets_traiter()->GetLibelle() == "validation des groupes"){
        $arrayAfterFilter1[] = $element ;
      }
}
$rowSpanNum1 = count($arrayAfterFilter1) + 1 ;

$validationGroupRows = "
    <tr>
        <td rowspan='{$rowSpanNum1}'>validation des groupes</td>
    </tr>
";

foreach($arrayAfterFilter1 as $element){
    $validationGroupRows .= "
        <tr>
            <td>{$element->GetElement()}</td>
            <td><input type='number' value='{$element->GetDonnees()}' /></td>
            <td><img src='../src/img/imgComment.jpg' alt='Comment' width='25px'></td>
        </tr>
    " ;

}

echo $validationGroupRows ;

?>


