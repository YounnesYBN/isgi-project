
<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c1 = new AppController();
$c1->GetAllElement();
$c1->GetAllTable_association();
$c1->SetCommantaire();

// print_r($c1->AllElement);

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
    $val = $element->GetCommentType()=="input"?($element->GetComment()==null ?"":$element->GetComment()->GetText_commantaire()):"" ;
    $validationGroupRows .= "
        <tr>
            <td>{$element->GetElement()}</td>
            <td><input type='number' value='{$element->GetDonnees()}' /></td>
            <td><input type='text' value='{$val}' id_ele='{$element->GetId()}' type_ele='{$element->GetCommentType()}' /></td>
        
        </tr>
    " ;

}

echo $validationGroupRows ;

?>


