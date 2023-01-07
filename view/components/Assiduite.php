<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c7 = new AppController();
$c7->GetAllElement();
$arrayAfterFilter7 = [];
foreach($c7->AllElement as $element){
      if($element->GetAspeets_traiter()->GetLibelle() == "Assiduité"){
        $arrayAfterFilter7[] = $element ;
      }
}
$rowSpanNum7 = count($arrayAfterFilter7) + 1 ;

$validationGroupRows7 = "

    <tr>
        <td rowspan='{$rowSpanNum7}'>Assiduité</td>
    </tr>
";

foreach($arrayAfterFilter7 as $element){
    $validationGroupRows7 .= "
        <tr>
            <td>{$element->GetElement()}</td>
            <td><input type='number' value='{$element->GetDonnees()}' /></td>
            <td><input type='text' /></td>
        </tr>
    " ;

}

echo $validationGroupRows7 ;

?>