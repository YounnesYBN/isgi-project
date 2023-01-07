<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c7 = new AppController();
$c7->GetAllElement();
$c7->GetAllTable_association();
$c7->SetCommantaire();
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
    $val = $element->GetCommentType()=="input"?($element->GetComment()==null ?"":$element->GetComment()->GetText_commantaire()):"" ;
    
    $validationGroupRows7 .= "
        <tr>
            <td>{$element->GetElement()}</td>
            <td><input type='number' value='{$element->GetDonnees()}' /></td>
            <td><input type='text' value='{$val}' id_ele='{$element->GetId()}' type_ele='{$element->GetCommentType()}' /></td>
        
        </tr>
    " ;

}

echo $validationGroupRows7 ;

?>