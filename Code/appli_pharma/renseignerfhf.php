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
<title>Renseignements de frais hors forfait</title>
</center>

<center>
<h2>Renseigner un nouveau frais hors forfait </h2>
<form action="renseignerfhf.php" method="POST">
<table class="table1">
<tr><th>Choisissez l'année</th><td>
<select name="lib_annee"> 
<?php 
mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
  mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');

$liste_req = mysql_query("SELECT lib_annee FROM annee"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['lib_annee']."'>".$liste_val['lib_annee']."</option>\n"; 
} 
?>
<tr><th>Choisissez le mois</th><td>
<select name="lib_mois"> 
<?php 
mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
  mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');

$liste_req = mysql_query("SELECT id_mois, lib_mois FROM mois"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['lib_mois']."'>".$liste_val['lib_mois']."</option>\n"; 
} 
?>
<tr><th>Libellé du frais</th><td><input type="text" name="lib_lfhf"></td></tr>
<tr><th>Montant du frais</th><td><input type="number" name="mont_lfhf"></td></tr>
</select> 
</table>
<br>
<input class="bouton-valider" type="submit" value="Ajouter"> &nbsp;&nbsp;<input class="bouton-annuler" type="reset" value="Annuler">
</form>
</center>

<?php

if(isset($_POST['lib_annee']) and isset($_POST['lib_mois']) and isset($_POST['lib_lfhf']) and isset($_POST['mont_lfhf'])){
if(!empty($_POST['lib_annee']) and !empty($_POST['lib_mois']) and !empty($_POST['lib_lfhf']) and !empty($_POST['mont_lfhf']))
{
mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');

// Récupération id_vis
$sql2="select id_vis from visiteur where login='".$_SESSION['login']."'"; 
$resultat2=mysql_query($sql2) or die('erreur exec recet2');
$sql4=mysql_fetch_array($resultat2);

// Récupération id_mois
$sql17="select id_mois from mois where lib_mois='".$_POST['lib_mois']."'"; 
$resultat17=mysql_query($sql17) or die('erreur insertion: '. $sql17. ' '. mysql_error());
$sql18=mysql_fetch_array($resultat17);

// Insertion de la ligne dans lignefraisforsorfait
$req="insert into lignefraishorsforfait 
values('','".$_POST['lib_lfhf']."','".$_POST['mont_lfhf']."','0','0','','".$sql4[0]."','2','".$_POST['lib_annee']."','".$sql18[0]."')";
mysql_query($req) or die('erreur insertion: '. $req);



echo "<script>alert(\"Ligne de frais hors forfait créée avec succes. N'oubliez pas d'envoyer votre justificatif pour traitement du frais.\");
document.location.href='menuvisiteur.php';</script>";
/*header("Location:menuvisiteur.php");*/

}

else

echo "<script>alert(\"Veuillez renseigner tous les champs\");
document.location.href='renseignerfff.php';</script>";
}


else

//alerte('Les variables non existants');



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