<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c2 = new AppController();
$c2->GetAllElement();
$arrayAfterFilter2 = [];
foreach($c2->AllElement as $element){
      if($element->GetAspeets_traiter()->GetLibelle() == "Suivi des résalisations des formateurs"){
        $arrayAfterFilter2[] = $element ;
      }
}
$rowSpanNum2 = count($arrayAfterFilter2) + 1 ;

$validationGroupRows2 = "

    <tr>
        <td rowspan='{$rowSpanNum2}'>Suivi des résalisations des formateurs</td>
    </tr>
";

foreach($arrayAfterFilter2 as $element){
    $validationGroupRows2 .= "
        <tr>
            <td class='tdA'>{$element->GetElement()}</td>
            <td class='tdB'><input type='number' value='{$element->GetDonnees()}' /></td>
            <td class='tdC'><input type='text' /></td>
        </tr>
    " ;

}

echo $validationGroupRows2 ;

?>