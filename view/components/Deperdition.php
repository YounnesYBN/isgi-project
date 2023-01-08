<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c5 = new AppController();
$c5->GetAllElement();
$c5->GetAllTable_association();
$c5->SetCommantaire();
$arrayAfterFilter5 = [];
foreach($c5->AllElement as $element){
      if($element->GetAspeets_traiter()->GetLibelle() == "Deperdition"){
        $arrayAfterFilter5[] = $element ;
      }
}
$rowSpanNum5 = count($arrayAfterFilter5) + 1 ;

$validationGroupRows5 = "

    <tr>
        <td rowspan='{$rowSpanNum5}'>Deperdition</td>
    </tr>
";

foreach($arrayAfterFilter5 as $element){
    $val = $element->GetCommentType()=="input"?($element->GetComment()==null ?"":$element->GetComment()->GetText_commantaire()):"" ;
    $validationGroupRows5 .= "
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

echo $validationGroupRows5 ;

?>