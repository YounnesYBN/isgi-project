<?php
if ($_SESSION["pass"] == false) {
    header('location:login.php');
}

?>

<tr>
    <td rowspan="9" class="tds">Suivi des résalisations des formateurs</td>
</tr>

<tr>
    <td>nomber total de formateurs permants</td>
    <td><input type="number" name=""></td>
    <td><input type="text" name=""></td>
</tr>

<tr>
    <td>nombre total de formateurs vacataires</td>
    <td><input type="number" name=""></td>
    <td><input type="text" name=""></td>
</tr>

<tr>
    <td>nombre total de formateurs absentés (absence par rapport les séances ,absent ou mobilisé)</td>
    <td><input type="number" name=""></td>
    <td><input type="text" name=""></td>
</tr>

<tr>
    <td>nombre totale de formateurs vacataires absentés</td>
    <td><input type="number" name=""></td>
    <td><input type="text" name=""></td>
</tr>

<tr>
    <td>nombre d'heures non dispensées a cause d'absence/mobilisation des formateurs permanents</td>
    <td><input type="number" name=""></td>
    <td><input type="text" name=""></td>
</tr>

<tr>
    <td>nombre d'heures non dispensées a cause d'absence des formateurs vacataires</td>
    <td><input type="number" name=""></td>
    <td><input type="text" name=""></td>
</tr>

<tr>
    <td>Nombre d'heures rattrapées par les formateurs permanents</td>
    <td><input type="number" name=""></td>
    <td><input type="text" name=""></td>
</tr>

<tr>
    
    <td>Nombre d'heures rattrapées par les formateurs vacataires</td>
    <td><input type="number" name=""></td>
    <td><input type="text" name=""></td>
</tr>

