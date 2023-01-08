<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c3 = new AppController();
$c3->GetAllElement();
$c3->GetAllTable_association();
$c3->SetCommantaire();
$arrayAfterFilter3 = [];
foreach($c3->AllElement as $element){
      if($element->GetAspeets_traiter()->GetLibelle() == "Réalisation des Evalutions de fin de Module"){
        $arrayAfterFilter3[] = $element ;
      }
}
$rowSpanNum3 = count($arrayAfterFilter3) + 1 ;

$validationGroupRows3 = "

    <tr>
        <td rowspan='{$rowSpanNum3}'>Réalisation des Evalutions de fin de Module</td>
    </tr>
";

foreach($arrayAfterFilter3 as $element){
    $val = $element->GetCommentType()=="input"?($element->GetComment()==null ?"":$element->GetComment()->GetText_commantaire()):"" ;
    $validationGroupRows3 .= "
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

echo $validationGroupRows3 ;

?>