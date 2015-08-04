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
	<center>
		<title id="titre">Validation des lignes de frais non traitées</title>
		
	</center>


<center>
<h2>Validation des lignes de frais non traitées</h2>
<form action="validerff.php" method="POST">
</form>
</center>
<?php
mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');


$sql1="select *
from lignefraisforfait, fraisforfait, etatligne, visiteur, annee, mois
where visiteur.id_vis=lignefraisforfait.id_vis
and fraisforfait.id_ff=lignefraisforfait.id_ff
and lignefraisforfait.id_etatligne=etatligne.id_etatligne
and lignefraisforfait.id_mois=mois.id_mois
and lignefraisforfait.lib_annee=annee.lib_annee
and lignefraisforfait.id_etatligne = 2
order by lignefraisforfait.id_mois";


$resultat1=mysql_query($sql1) or die('erreur insertion: '. $sql1. ' '. mysql_error());


echo "<center> <b>".mysql_num_rows($resultat1)." Frais Forfait saisis</b></center>";
?>
<center><table class="table1">
<tr><th>Nom du salarié</th><th>Prénom du salarié</th><th>Année du frais</th><th>Mois du frais</th><th>Libellé du frais</th><th>Quantité</th><th>Montant total</th><th>Montant validé</th><th>Action</th></tr>
<?php
while($resa=mysql_fetch_array($resultat1))
{//debut de while
?>
<tr><td><?php echo $resa['nom']?></td>
<td><?php echo $resa['prenom']?></td>
<td><?php echo $resa['lib_annee']?></td>
<td><?php echo $resa['lib_mois']?></td>
<td><?php echo $resa['lib_ff']; ?></td>
<td><?php echo $resa['quantite_lff']; ?></td>
<td><?php echo $resa['montanttotal_lff']; ?></td>
<td><?php echo $resa['montvalid_lff']; ?></td>
<td><a href="traitementlff.php?reference=<?php echo $resa['id_lff'];?>">Traiter</a></td>
</tr>
<?php
} // fin de while

?>
</table>
<br><br><br>
</center>
<?php
mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');


$sql9="select * 
from lignefraishorsforfait, etatligne, visiteur, annee, mois
where visiteur.id_vis=lignefraishorsforfait.id_vis
and lignefraishorsforfait.id_etatligne=etatligne.id_etatligne
and lignefraishorsforfait.id_mois=mois.id_mois
and lignefraishorsforfait.lib_annee=annee.lib_annee
and lignefraishorsforfait.id_etatligne = 2
order by lignefraishorsforfait.id_mois";

$resultat7=mysql_query($sql9) or die('erreur insertion: '. $sql9. ' '. mysql_error());

echo "<center> <b>".mysql_num_rows($resultat7)." Frais Hors Forfait saisis</b></center>";
?>
<center><table class="table1">
<tr><th>Nom du salarié</th><th>Prénom du salarié</th><th>Annee du frais</th><th>Mois du frais</th><th>Libellé du frais</th><th>Montant Total</th><th>Montant validé</th><th>Action</th></tr>
<?php
while($resa=mysql_fetch_array($resultat7))
{//debut de while
?>
<tr><td><?php echo $resa['nom']?></td>
<td><?php echo $resa['prenom']?></td>
<td><?php echo $resa['lib_annee']?></td>
<td><?php echo $resa['lib_mois']?></td>
<td><?php echo $resa['lib_lfhf']; ?></td>
<td><?php echo $resa['mont_lfhf']; ?></td>
<td><?php echo $resa['montvalid_lfhf']; ?></td>
<td><a href="traitementlfhf.php?reference=<?php echo $resa['id_lfhf'];?>">Traiter</a></td> 
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
else {
echo "<script>alert(\"Vous n'êtes pas autorisé à accéder à cette zone \");
document.location.href = 'index.php';</script>";
}
?>