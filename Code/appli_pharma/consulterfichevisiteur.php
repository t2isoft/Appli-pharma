﻿<?php
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
<title>Voir les fiche de frais par visiteur</title>
</center>


<center>
<h2>Voir les fiche de frais par visiteur</h2>
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
<script src="func2.js"></script>
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
from fichefrais, etat, annee, mois, visiteur
where fichefrais.id_etat=etat.id_etat
and fichefrais.lib_annee=annee.lib_annee
and fichefrais.id_vis=visiteur.id_vis
and fichefrais.id_mois=mois.id_mois
and fichefrais.id_vis='".$sql4['id_vis']."'
order by fichefrais.lib_annee, fichefrais.id_mois";

$resultat1=mysql_query($sql1) or die('erreur lecture: '. $sql1. ' '. mysql_error());


echo "<center> <b>".mysql_num_rows($resultat1)." fiche(s) de Frais pour ce visiteur</b></center>";
?>
<table class="table1">
<tr><th>Annéee de la fiche</th><th>Mois de la fiche</th><th>Dernière date de modification</th><th>Montant validé</th><th>Etat</th></tr>
<?php
while($enreg=mysql_fetch_array($resultat1))
{//debut de while
?>
<tr><td><?php echo $enreg['lib_annee']?></td>
<td><?php echo $enreg['lib_mois']?></td>
<td><?php echo $enreg['datemodif']?></td>
<td><?php echo $enreg['montantvalide']; ?></td>
<td><?php echo $enreg['lib_etat']; ?></td>
</tr>
<?php
} // fin de while

?>
</table>

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