<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c2 = new AppController();
$c2->GetAllElement();
$c2->GetAllTable_association();
$c2->SetCommantaire();
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
    $val = $element->GetCommentType()=="input"?($element->GetComment()==null ?"":$element->GetComment()->GetText_commantaire()):"" ;
    
    $validationGroupRows2 .= "
        <tr>
            <td>{$element->GetElement()}</td>
            <td><input type='number' value='{$element->GetDonnees()}' /></td>
            <td><input type='text' value='{$val}' id_ele='{$element->GetId()}' type_ele='{$element->GetCommentType()}' /></td>
        
        </tr>
    " ;

}

echo $validationGroupRows2 ;

?>