
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
    $id_user = $_SESSION["info"]["id"] ;
    if($element->GetCommentType()=="select"){
        $otherOption = "";
        if($element->GetComment() != null){
            foreach($element->GetComment() as $message){
                $otherOption .= "
                <option value='{$message->GetId()}'>
                {$message->GetText_commantaire()}
                </option>";
           }
           $validationGroupRows .= "
           <tr>
               <td>{$element->GetElement()}</td>
               <td><input type='number' value='{$element->GetDonnees()}' /></td>
               <td>
                   <select name='selectComment' id=''>
                           <option value=''>Choisir Un</option>
                           <option value=''>option A</option>
                           <option value=''>option B</option>
                           <option value=''>option C</option>
                           {$otherOption}
                   </select>
                   <button type='button' id='btn-select' id_ele='{$element->GetId()}' id_user='{$id_user}'>Ajouter Un option</button>
               </td>
               </tr>
            " ;
        }else{
            $validationGroupRows .= "
           <tr>
               <td>{$element->GetElement()}</td>
               <td><input type='number' value='{$element->GetDonnees()}' /></td>
               <td>
                   <select name='selectComment' id=''>
                           <option value=''>Choisir Un</option>
                           <option value=''>option A</option>
                           <option value=''>option B</option>
                           <option value=''>option C</option>
                           {$otherOption}
                   </select>
                   <button type='button' id='btn-select' id_ele='{$element->GetId()}' id_user='{$id_user}'>Ajouter Un option</button>
               </td>
               </tr>
            " ;
        }
        
    }else{
        $val = $element->GetComment()==null ?"":$element->GetComment()->GetText_commantaire();
        $validationGroupRows .= "
            <tr>
                <td>{$element->GetElement()}</td>
                <td><input type='number' value='{$element->GetDonnees()}' /></td>
                <td><textarea name='textarea' id='textComment' placeholder='Add Comment:' id_ele = '{$element->GetId()}' id_user='{$id_user}' >{$val}</textarea></td>
            </tr>
        " ;
    }
    
    
    

}

echo $validationGroupRows ;

?>


