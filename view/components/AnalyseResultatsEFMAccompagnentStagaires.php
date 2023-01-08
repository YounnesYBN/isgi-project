<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c8 = new AppController();
$c8->GetAllElement();
$arrayAfterFilter8 = [];
foreach($c8->AllElement as $element){
      if($element->GetAspeets_traiter()->GetLibelle() == "Analyse resultats EFM et accompagnent des stagaires"){
        $arrayAfterFilter8[] = $element ;
      }
}
$rowSpanNum8 = count($arrayAfterFilter8) + 1 ;

$validationGroupRows8 = "

    <tr>
        <td rowspan='{$rowSpanNum8}'>Analyse resultats EFM et accompagnent des stagaires</td>
    </tr>
";

foreach($arrayAfterFilter8 as $element){
    $validationGroupRows8 .= "
        <tr>
            <td class='tdA'>{$element->GetElement()}</td>
            <td class='tdB'><input type='number' value='{$element->GetDonnees()}' /></td>
            <td class='tdC'><input type='text' /></td>
        </tr>
    " ;

}

echo $validationGroupRows8 ;

?>