<?php
session_start();
if (isset($_SESSION['login']) and isset($_SESSION['mdp']) and !empty($_SESSION['login']) and !empty($_SESSION['mdp']) and $_SESSION['type']=='visiteur') {
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
		
	<center>
	<div class="menu">
		<a href="renseignerff.php">Renseigner  frais forfait</a> 
		<a href="consulterligne.php">Consulter mes frais</a>
		<a href="renseignerfhf.php">Renseigner frais hors forfait</a>
		<a href="consulterfiche.php">Consulter mes fiche de frais</a> 
	</div>
<title>Consultation des lignes de frais</title>
<form action="consulterligne.php" method="POST">
</center>
</head> 
</form>
<center>
<h2>Consultation des frais</h2>
</center>
</form>

<?php
mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');

// Récupération id_vis
$sql2="select id_vis from visiteur where login='".$_SESSION['login']."'"; 
$resultat2=mysql_query($sql2) or die('erreur exec recet2');
$sql4=mysql_fetch_array($resultat2);

$sql1="select *
from lignefraisforfait, fraisforfait, etatligne, annee, mois
where fraisforfait.id_ff=lignefraisforfait.id_ff
and lignefraisforfait.id_etatligne=etatligne.id_etatligne
and lignefraisforfait.id_mois=mois.id_mois
and lignefraisforfait.lib_annee=annee.lib_annee
and id_vis = ".$sql4['id_vis']."
order by lignefraisforfait.lib_annee, lignefraisforfait.id_mois";
$resultat=mysql_query($sql1) or die('erreur insertion: '. $sql1. ' '. mysql_error());


echo "<center> <b>".mysql_num_rows($resultat)." Frais Forfait saisis</b></center>";
?>
<center><table class="table1">
<tr><th>Annee du frais</th><th>Mois du frais</th><th>Libellé du frais</th><th>Quantité</th><th>Montant total</th><th>Montant validé</th><th>Etat</th></tr>
<?php
while($enreg=mysql_fetch_array($resultat))
{//debut de while
?>
<tr><td><?php echo $enreg['lib_annee']?></td>
<td><?php echo $enreg['lib_mois']?></td>
<td><?php echo $enreg['lib_ff']; ?></td>
<td><?php echo $enreg['quantite_lff']; ?></td>
<td><?php echo $enreg['montanttotal_lff']; ?></td>
<td><?php echo $enreg['montvalid_lff']; ?></td>
<td><?php echo $enreg['lib_etatligne']; ?></td>
</tr>
<?php
} // fin de while
echo "</table>";
?>
</center>
<BR>
<?php
mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');

 //Récupération id_vis
$sql7="select id_vis from visiteur where login='".$_SESSION['login']."'"; 
$resultat4=mysql_query($sql7) or die('erreur insertion: '. $sql7. ' '. mysql_error());
$sql8=mysql_fetch_array($resultat4);

$sql9="select *
from lignefraishorsforfait, etatligne, annee, mois 
where lignefraishorsforfait.id_etatligne=etatligne.id_etatligne
and lignefraishorsforfait.id_mois=mois.id_mois
and lignefraishorsforfait.lib_annee=annee.lib_annee
and id_vis = ".$sql4['id_vis']."
order by lignefraishorsforfait.lib_annee, lignefraishorsforfait.id_mois";
$resultat7=mysql_query($sql9) or die('erreur dans le requete');
echo "<center> <b>".mysql_num_rows($resultat7)." Frais Hors Forfait saisis</b></center>";
?>
<center><table class="table1">
<tr><th>Annee du frais</th><th>Mois du frais</th><th>Libellé du frais</th><th>Montant Total</th><th>Montant Validé</th><th>Etat</th></tr>
<?php
while($enreg=mysql_fetch_array($resultat7))
{//debut de while
?>
<tr><td><?php echo $enreg['lib_annee']?></td>
<td><?php echo $enreg['lib_mois']?></td>
<td><?php echo $enreg['lib_lfhf']; ?></td>
<td><?php echo $enreg['mont_lfhf']; ?></td>
<td><?php echo $enreg['montvalid_lfhf']; ?></td>
<td><?php echo $enreg['lib_etatligne']; ?></td>
</tr>
<?php
} // fin de while
echo "</table>";
?>
</body>
</html>
<?php
}
else {
echo "<script>alert(\"Vous n'êtes pas autorisé à accéder à cette zone \");
document.location.href = 'index.php';</script>";
}
?>