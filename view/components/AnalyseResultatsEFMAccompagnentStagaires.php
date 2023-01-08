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
            <td><!--
                <select name='selectComment' id=''>
                    <option value=''>Choisir Un</option>
                    <option value=''>option A</option>
                    <option value=''>option B</option>
                    <option value=''>option C</option>
                </select>
                <button type='button' id='btn-select'>Ajouter Un option</button>
                -->
                <textarea name='textarea' id='textComment' placeholder='Add Comment:' ></textarea>
            </td>        
        </tr>
    " ;

}

echo $validationGroupRows8 ;

?>