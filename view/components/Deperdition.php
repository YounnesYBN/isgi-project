<?php


if ($_SESSION["pass"] == false) {
    header('location:./../login.php');
}

$c5 = new AppController();
$c5->GetAllElement();
$c5->GetAllTable_association();
$c5->SetCommantaire();
$arrayAfterFilter5 = [];
foreach ($c5->AllElement as $element) {
    if ($element->GetAspeets_traiter()->GetLibelle() == "Deperdition") {
        $arrayAfterFilter5[] = $element;
    }
}
$rowSpanNum5 = count($arrayAfterFilter5) + 1;

$validationGroupRows5 = "

    <tr>
        <td rowspan='{$rowSpanNum5}'>Deperdition</td>
    </tr>
";

foreach ($arrayAfterFilter5 as $element) {
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
            $validationGroupRows5 .= "
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
            $validationGroupRows5 .= "
           <tr>
               <td>{$element->GetElement()}</td>
               <td><input type='number'id_ele = '{$element->GetId()}' value='{$element->GetDonnees()}' /></td>
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
        $validationGroupRows5 .= "
        <tr>
        <td>{$element->GetElement()}</td>
        <td><input type='number' id_ele = '{$element->GetId()}' value='{$element->GetDonnees()}' /></td>
        <td><textarea name='textarea' id='textComment' placeholder='Add Comment:' id_ele = '{$element->GetId()}'  >{$val}</textarea></td>
    </tr>
        ";
    }
}

echo $validationGroupRows5;
