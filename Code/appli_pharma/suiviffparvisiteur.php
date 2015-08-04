<?php
session_start();
if (isset($_SESSION['login']) and isset($_SESSION['mdp']) and !empty($_SESSION['login']) and !empty($_SESSION['mdp']) and $_SESSION['type']=='comptable') {
?>
<html>
<head>
	<link rel ="stylesheet" href="style.css" name="text/css"/>	
	<script src="jquery.js" type="text/javascript"></script>
	<script src="javappe.js" type="text/javascript"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body> 
	<div id="bground"></div>
		<span class="bouton-menu"  onclick="document.location='logout.php'">Déconnexion</span>		
		<span id="hovermenu"class="bouton-menu">Menu</span>
	
		<div class="menu">
					<a href="validerff.php">Validation lignes non traitées</a>   
					<a href="suiviffperiode.php">Suivi fiches de frais par période</a>   
					<a href="suiviff.php">Suivi lignes de frais par période</a>   
					<a href="consulterfichevisiteur.php">Suivi fiches de frais par visiteur</a>   
					<a href="suiviffparvisiteur.php">Suivi lignes de frais par visiteur</a>   
					<a href="script.php">Clôturer fiches du mois terminé</a>   
		</div> 
<body>
</center>

<center>
<h2>Voir les frais par visiteur</h2>
<form method="POST" action="" >
<tr><th>Choisissez le visiteur</th><td>
<input type="text" name="search" id="search">
</form>

<div id="resultat">
	<ul>
		
	</ul>
</div>
<div id="loader">

	<img src="image/loader.gif" alt="loader"/>
	
</div>
<div id="feedback"></div>
<script src="jquery.js"></script>
<script src="func.js"></script>
<?php 
mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
  mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');

$liste_req = mysql_query("SELECT nom, prenom FROM visiteur where type='visiteur'"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom']."'>".$liste_val['nom']." ".$liste_val['prenom']."</option>\n"; 
} 
?>
</select> 
</table>
<br>
</form>
</center>
<?php
mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');



if(isset($_POST['nom'])){

// Récupération id_visiteur
$sql3="select id_vis from visiteur where nom='".$_POST['nom']."'"; 
$resultat3=mysql_query($sql3) or die('erreur lecture: '. $sql3. ' '. mysql_error());
$sql4=mysql_fetch_array($resultat3);

$sql1="select *
from lignefraisforfait, fraisforfait, etatligne, visiteur, annee, mois
where visiteur.id_vis=lignefraisforfait.id_vis
and fraisforfait.id_ff=lignefraisforfait.id_ff
and lignefraisforfait.id_etatligne=etatligne.id_etatligne
and lignefraisforfait.lib_annee=annee.lib_annee
and lignefraisforfait.id_mois=mois.id_mois
and lignefraisforfait.id_vis='".$sql4['id_vis']."'";


$resultat1=mysql_query($sql1) or die('erreur lecture: '. $sql1. ' '. mysql_error());


echo "<center> <b>".mysql_num_rows($resultat1)." Frais Forfait saisis pour ce visiteur</b></center>";
?>
<center><table class="table1">
<tr><th>Nom du salarié</th><th>Prénom du salarié</th><th>Libellé du frais</th><th>Quantité</th><th>Montant total</th><th>Montant valide</th><th>Date du traitement</th><th>Etat</th></tr>
<?php
while($resa=mysql_fetch_array($resultat1))
{//debut de while
?>
<tr><td><?php echo $resa['nom']?></td>
<td><?php echo $resa['prenom']?></td>
<td><?php echo $resa['lib_ff']; ?></td>
<td><?php echo $resa['quantite_lff']; ?></td>
<td><?php echo $resa['montanttotal_lff']; ?></td>
<td><?php echo $resa['montvalid_lff']; ?></td>
<td><?php echo $resa['datetrait_lff']; ?></td>
<td><?php echo $resa['lib_etatligne']; ?></td>

</tr>
<?php
} // fin de while

?>
</table>
</center>
<?php
mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');


$sql9="select *
from lignefraishorsforfait, etatligne, visiteur, annee, mois
where visiteur.id_vis=lignefraishorsforfait.id_vis
and lignefraishorsforfait.id_etatligne=etatligne.id_etatligne
and lignefraishorsforfait.lib_annee=annee.lib_annee
and lignefraishorsforfait.id_mois=mois.id_mois
and lignefraishorsforfait.id_vis='".$sql4['id_vis']."'";

$resultat7=mysql_query($sql9) or die('erreur lecture: '. $sql9. ' '. mysql_error());

echo "<center> <b>".mysql_num_rows($resultat7)." Frais Hors Forfait saisis sur cette période</b></center>";
?>
<center><table border="1">
<tr 
bgcolor="#99FF33"><th>Nom du salarié</th><th>Prénom du salarié</th><th>Libellé du frais</th><th>Montant Total</th><th>Montant valide</th><th>Date du traitement</th><th>Etat</th></tr>
<?php
while($resa=mysql_fetch_array($resultat7))
{//debut de while
?>
<tr><td><?php echo $resa['nom']?></td>
<td><?php echo $resa['prenom']?></td>
<td><?php echo $resa['lib_lfhf']; ?></td>
<td><?php echo $resa['mont_lfhf']; ?></td>
<td><?php echo $resa['montvalid_lfhf']; ?></td>
<td><?php echo $resa['datetrait_lfhf']; ?></td>
<td><?php echo $resa['lib_etatligne']; ?></td>
</tr>
<?php
} // fin de while

?>
</table>
</center>
</body>
</html>
<?php
}
}
else 
{
echo "<script>alert(\"Vous n'êtes pas autorisé à accéder à cette zone \");
document.location.href = 'index.php';</script>";
}
?>