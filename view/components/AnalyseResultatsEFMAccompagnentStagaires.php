<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c8 = new AppController();
$c8->GetAllElement();
$c8->GetAllTable_association();
$c8->SetCommantaire();
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
    $val = $element->GetCommentType()=="input"?($element->GetComment()==null ?"":$element->GetComment()->GetText_commantaire()):"" ;
    
    $validationGroupRows8 .= "
        <tr>
            <td>{$element->GetElement()}</td>
            <td><input type='number' value='{$element->GetDonnees()}' /></td>
            <td><input type='text' value='{$val}' id_ele='{$element->GetId()}' type_ele='{$element->GetCommentType()}' /></td>
        
        </tr>
    " ;

}

echo $validationGroupRows8 ;

?>