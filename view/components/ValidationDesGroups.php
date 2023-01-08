
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

echo $validationGroupRows ;

?>


