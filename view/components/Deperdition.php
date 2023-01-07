<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c5 = new AppController();
$c5->GetAllElement();
$arrayAfterFilter5 = [];
foreach($c5->AllElement as $element){
      if($element->GetAspeets_traiter()->GetLibelle() == "Deperdition"){
        $arrayAfterFilter5[] = $element ;
      }
}
$rowSpanNum5 = count($arrayAfterFilter5) + 1 ;

$validationGroupRows5 = "

    <tr>
        <td rowspan='{$rowSpanNum5}'>Deperdition</td>
    </tr>
";

foreach($arrayAfterFilter5 as $element){
    $validationGroupRows5 .= "
        <tr>
            <td>{$element->GetElement()}</td>
            <td><input type='number' value='{$element->GetDonnees()}' /></td>
            <td><input type='text' /></td>
        </tr>
    " ;

}

echo $validationGroupRows5 ;

?>