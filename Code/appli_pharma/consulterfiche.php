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
	</center>
<title>Consultation des fiches de frais</title>
<form action="consulterfiche.php" method="POST">


</form>
	<center>
		<h2>Consultation des fiches de frais</h2>
	</center>


<?php
mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');

// Récupération id_vis
$sql2="select id_vis from visiteur where login='".$_SESSION['login']."'"; 
$resultat2=mysql_query($sql2) or die('erreur exec recet2');
$sql4=mysql_fetch_array($resultat2);

$sql1="select *
from fichefrais, etat, annee, mois
where fichefrais.id_etat=etat.id_etat
and fichefrais.lib_annee=annee.lib_annee
and fichefrais.id_mois=mois.id_mois
and id_vis = ".$sql4['id_vis']."
order by fichefrais.lib_annee, fichefrais.id_mois";
$resultat=mysql_query($sql1) or die('erreur insertion: '. $sql1. ' '. mysql_error());


echo "<center> <b>".mysql_num_rows($resultat)." fiche de frais repertorié</b></center>";
?>
<center><table class="table1">
<tr><th>Annee fiche</th><th>Mois fiche</th><th>Dernière date de modification</th><th>Montant validé</th><th>Etat</th></tr>
<?php
while($enreg=mysql_fetch_array($resultat))
{//debut de while
?>
<tr><td><?php echo $enreg['lib_annee']?></td>
<td><?php echo $enreg['lib_mois']?></td>
<td><?php echo $enreg['datemodif']?></td>
<td><?php echo $enreg['montantvalide']; ?></td>
<td><?php echo $enreg['lib_etat']; ?></td>
</tr>
</center>
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