<?php 


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c2 = new AppController();
$c2->GetAllElement();
$c2->GetAllTable_association();
$c2->SetCommantaire();
$arrayAfterFilter2 = [];
foreach($c2->AllElement as $element){
      if($element->GetAspeets_traiter()->GetLibelle() == "Suivi des résalisations des formateurs"){
        $arrayAfterFilter2[] = $element ;
      }
}
$rowSpanNum2 = count($arrayAfterFilter2) + 1 ;

$validationGroupRows2 = "

    <tr>
        <td rowspan='{$rowSpanNum2}'>Suivi des résalisations des formateurs</td>
    </tr>
";

foreach($arrayAfterFilter2 as $element){
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
           $validationGroupRows2 .= "
           <tr>
               <td>{$element->GetElement()}</td>
               <td><input type='number'  id_ele = '{$element->GetId()}'value='{$element->GetDonnees()}' /></td>
               <td>
                   <select name='selectComment' id='{$element->GetId()}'>
                            
                           {$otherOption}
                   </select>
                   <button type='button' id='btn-select' id_ele='{$element->GetId()}' id_user='{$id_user}'>Ajouter Un option</button>
               </td>
               </tr>
            " ;
        }else{
            $validationGroupRows2 .= "
           <tr>
               <td>{$element->GetElement()}</td>
               <td><input type='number' id_ele = '{$element->GetId()}' value='{$element->GetDonnees()}' /></td>
               <td>
                   <select name='selectComment' id='{$element->GetId()}'>
                            
                           {$otherOption}
                   </select>
                   <button type='button' id='btn-select' id_ele='{$element->GetId()}' id_user='{$id_user}'>Ajouter Un option</button>
               </td>
               </tr>
            " ;
        }
        
    }else{
        $val = $element->GetComment()==null ?"":$element->GetComment()->GetText_commantaire();
        $validationGroupRows2 .= "
        <tr>
        <td>{$element->GetElement()}</td>
        <td><input type='number' id_ele = '{$element->GetId()}' value='{$element->GetDonnees()}' /></td>
        <td><textarea name='textarea' id='textComment' placeholder='Add Comment:' id_ele = '{$element->GetId()}'  >{$val}</textarea></td>
        </tr>
        " ;
    }
    
    
    

}

echo $validationGroupRows2 ;

?>