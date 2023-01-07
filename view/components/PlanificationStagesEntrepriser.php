<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c4 = new AppController();
$c4->GetAllElement();
$c4->GetAllTable_association();
$c4->SetCommantaire();
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
    $val = $element->GetCommentType()=="input"?($element->GetComment()==null ?"":$element->GetComment()->GetText_commantaire()):"" ;
    
    $validationGroupRows4 .= "
        <tr>
            <td>{$element->GetElement()}</td>
            <td><input type='number' value='{$element->GetDonnees()}' /></td>
            <td><input type='text' value='{$val}' id_ele='{$element->GetId()}' type_ele='{$element->GetCommentType()}' /></td>
        
        </tr>
    " ;

}

echo $validationGroupRows4 ;

?>