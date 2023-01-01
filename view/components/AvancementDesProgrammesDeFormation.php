<?php 

if ($_SESSION["pass"] == false) {
    header('location:login.php');
}

?>
<tr>
    <td rowspan="9">Avancement Des Programmes De Formation</td> 
</tr>
<tr>
    <td>nomber total de groups </td>
    <td><input type="number"></td>
    <td><input type="text"></td>
</tr>
<tr>
    <td>Nombre total de groupes ayant un taux d'AP convenable</td>
    <td><input type="number"></td>
    <td><input type="text"></td>
</tr>
<tr>
    <td>Nombre total de groupes ayant un taux d'AP moyen</td>
    <td><input type="number"></td>
    <td><input type="text"></td>
</tr>
<tr>
    <td>Nombre total de groupes ayant un taux d'AP faible</td>
    <td><input type="number"></td>
    <td><input type="text"></td>
</tr>
<tr>
    <td>Nombre de groupes prévus d'achever le programme de fromation a temps($fin mai 2022 pour 2 A et début juillet 2022 pour 1A)</td>
    <td><input type="number"></td>
    <td><input type="text"></td>
</tr>
<tr>
<td>les raison du faible taux d'AP</td>
    <td><input type="number"></td>
    <td><input type="text"></td>
</tr>
    <tr>
<td>Les action mises en place pour la régularisation de la situation </td>
    <td><input type="number"></td>
    <td><input type="text"></td>
</tr>
<tr>
    <td>les propositions d'amélioration</td>
    <td><input type="number"></td>
    <td><input type="text"></td>
</tr>