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
           $validationGroupRows6 .= "
           <tr>
               <td>{$element->GetElement()}</td>
               <td><input type='number' value='{$element->GetDonnees()}' /></td>
               <td>
                   <select name='selectComment' id='{$element->GetId()}'>
                            
                           {$otherOption}
                   </select>
                   <button type='button' id='btn-select' id_ele='{$element->GetId()}' id_user='{$id_user}'>Ajouter Un option</button>
               </td>
               </tr>
            " ;
        }else{
            $validationGroupRows6 .= "
           <tr>
               <td>{$element->GetElement()}</td>
               <td><input type='number' value='{$element->GetDonnees()}' /></td>
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
        $validationGroupRows6 .= "
            <tr>
                <td>{$element->GetElement()}</td>
                <td><input type='number' value='{$element->GetDonnees()}' /></td>
                <td><textarea name='textarea' id='textComment' placeholder='Add Comment:' id_ele = '{$element->GetId()}' id_user='{$id_user}' >{$val}</textarea></td>
            </tr>
        " ;
    }
    
    
    

}

echo $validationGroupRows6 ;

?>