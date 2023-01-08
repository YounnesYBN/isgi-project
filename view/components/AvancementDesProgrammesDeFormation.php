<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c6 = new AppController();
$c6->GetAllElement();
$c6->GetAllTable_association();
$c6->SetCommantaire();
$arrayAfterFilter6 = [];
foreach($c6->AllElement as $element){
      if($element->GetAspeets_traiter()->GetLibelle() == "Avancement Des Programmes De Formation"){
        $arrayAfterFilter6[] = $element ;
      }
}
$rowSpanNum6 = count($arrayAfterFilter6) + 1 ;

$validationGroupRows6 = "

    <tr>
        <td rowspan='{$rowSpanNum6}'>Avancement Des Programmes De Formation</td>
    </tr>
";

foreach($arrayAfterFilter6 as $element){
    $val = $element->GetCommentType()=="input"?($element->GetComment()==null ?"":$element->GetComment()->GetText_commantaire()):"" ;
    
    $validationGroupRows6 .= "
        <tr>
            <td>{$element->GetElement()}</td>
            <td><input type='number' value='{$element->GetDonnees()}' /></td>
            <td><input type='text' value='{$val}' id_ele='{$element->GetId()}' type_ele='{$element->GetCommentType()}' /></td>
        
        </tr>
    " ;

}

echo $validationGroupRows6 ;

?>