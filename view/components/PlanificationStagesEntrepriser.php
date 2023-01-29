<?php


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c4 = new AppController();
$c4->GetAllElement();
$c4->GetAllTable_association();
$c4->SetCommantaire();
$arrayAfterFilter4 = [];
foreach ($c4->AllElement as $element) {
    if ($element->GetAspeets_traiter()->GetLibelle() == "Planification des stages en entreprises") {
        $arrayAfterFilter4[] = $element;
    }
}
$rowSpanNum4 = count($arrayAfterFilter4) + 1;

$validationGroupRows4 = "

    <tr>
        <td rowspan='{$rowSpanNum4}'>Planification des stages en entreprises</td>
    </tr>
";

foreach ($arrayAfterFilter4 as $element) {
    $id_user = $_SESSION["info"]["id"];
    if ($element->GetCommentType() == "select") {
        $otherOption = "";
        if ($element->GetComment() != null) {
            foreach ($element->GetComment() as $message) {
                $otherOption .= "
                <option value='{$message->GetId()}'>
                {$message->GetText_commantaire()}
                </option>";
            }
            $validationGroupRows4 .= "
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
            ";
        } else {
            $validationGroupRows4 .= "
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
            ";
        }
    } else {
        $val = $element->GetComment() == null ? "" : $element->GetComment()->GetText_commantaire();
        $validationGroupRows4 .= "
        <tr>
        <td>{$element->GetElement()}</td>
        <td><input type='number' id_ele = '{$element->GetId()}' value='{$element->GetDonnees()}' /></td>
        <td><textarea name='textarea' id='textComment' placeholder='Add Comment:' id_ele = '{$element->GetId()}'  >{$val}</textarea></td>
    </tr>
        ";
    }
}

echo $validationGroupRows4;