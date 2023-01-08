<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c4 = new AppController();
$c4->GetAllElement();
$arrayAfterFilter4 = [];
foreach($c4->AllElement as $element){
      if($element->GetAspeets_traiter()->GetLibelle() == "Planification des stages en entreprises"){
        $arrayAfterFilter4[] = $element ;
      }
}
$rowSpanNum4 = count($arrayAfterFilter4) + 1 ;

$validationGroupRows4 = "

    <tr>
        <td rowspan='{$rowSpanNum4}'>Planification des stages en entreprises</td>
    </tr>
";

foreach($arrayAfterFilter4 as $element){
    $validationGroupRows4 .= "
        <tr>
            <td class='tdA'>{$element->GetElement()}</td>
            <td class='tdB'><input type='number' value='{$element->GetDonnees()}' /></td>
            <td class='tdC'><input type='text' /></td>
        </tr>
    " ;

}

echo $validationGroupRows4 ;

?>