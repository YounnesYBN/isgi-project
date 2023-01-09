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
           $validationGroupRows7 .= "
           <tr>
               <td>{$element->GetElement()}</td>
               <td><input type='number' id_ele = '{$element->GetId()}' value='{$element->GetDonnees()}' /></td>
               <td>
                   <select name='selectComment' id='{$element->GetId()}'>
                   <option value=''>Choisir Un</option>
                           {$otherOption}
                   </select>
                   <button type='button' id='btn-select' id_ele='{$element->GetId()}' id_user='{$id_user}'>Ajouter Un option</button>
               </td>
               </tr>
            " ;
        }else{
            $validationGroupRows7 .= "
           <tr>
               <td>{$element->GetElement()}</td>
               <td><input type='number'  id_ele = '{$element->GetId()}' value='{$element->GetDonnees()}' /></td>
               <td>
                   <select name='selectComment' id='{$element->GetId()}'>
                   <option value=''>Choisir Un</option>
                           {$otherOption}
                   </select>
                   <button type='button' id='btn-select' id_ele='{$element->GetId()}' id_user='{$id_user}'>Ajouter Un option</button>
               </td>
               </tr>
            " ;
        }
        
    }else{
        $val = $element->GetComment()==null ?"":$element->GetComment()->GetText_commantaire();
        $validationGroupRows7 .= "
        <tr>
        <td>{$element->GetElement()}</td>
        <td><input type='number' id_ele = '{$element->GetId()}' value='{$element->GetDonnees()}' /></td>
        <td><textarea name='textarea' id='textComment' placeholder='Add Comment:' id_ele = '{$element->GetId()}'  >{$val}</textarea></td>
    </tr>
        " ;
    }
    
    
    

}

echo $validationGroupRows7 ;

?>