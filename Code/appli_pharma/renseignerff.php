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
<title>Renseignements de frais</title>
</center>

<center>
<h2>Renseigner un nouveau frais forfait</h2>
<form action="renseignerff.php" method="POST">
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
<tr><th>Choisissez le type de frais</th><td>
<select name="lib_ff"> 
<?php 
mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
  mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');

$liste_req = mysql_query("SELECT id_ff, lib_ff FROM fraisforfait"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['lib_ff']."'>".$liste_val['lib_ff']."</option>\n"; 
} 
?>
<tr><th>Quantité</th><td><input type="int" name="quantite_lff"></td></tr>
</select> 
</table>
<br>
<input class="bouton-valider" type="submit" value="Ajouter"> &nbsp;&nbsp;<input class="bouton-annuler" type="reset" value="Annuler">
</form>
</center>
<?php

if(isset($_POST['lib_ff']) and isset($_POST['quantite_lff']) and isset($_POST['lib_annee']) and isset($_POST['lib_mois'])){
if(!empty($_POST['lib_ff']) and !empty($_POST['quantite_lff']) and !empty($_POST['lib_annee']) and !empty($_POST['lib_mois']))
{

// Récupération id_ff
$sql1="select id_ff from fraisforfait where lib_ff='".$_POST['lib_ff']."'"; 
$resultat1=mysql_query($sql1) or die('erreur exec recet');
$sql3=mysql_fetch_array($resultat1);

// Récupération mont_ff
$sql8="select mont_ff from fraisforfait where lib_ff='".$_POST['lib_ff']."'"; 
$resultat9=mysql_query($sql8) or die('erreur exec recet2');
$sql9=mysql_fetch_array($resultat9);



// Calcul montanttotal_lff
$sql10 = $sql9['mont_ff'] * $_POST['quantite_lff']; 


// Récupération id_vis
$sql2="select id_vis from visiteur where login='".$_SESSION['login']."'"; 
$resultat2=mysql_query($sql2) or die('erreur exec recet3');
$sql4=mysql_fetch_array($resultat2);

// Récupération id_mois
$sql17="select id_mois from mois where lib_mois='".$_POST['lib_mois']."'"; 
$resultat17=mysql_query($sql17) or die('erreur insertion: '. $sql17. ' '. mysql_error());
$sql18=mysql_fetch_array($resultat17);

// Insertion de la ligne dans lignefraisforfait
$req="insert into lignefraisforfait 
values('','".$_POST['quantite_lff']."','".$sql10."','','','','".$sql3[0]."','".$sql4[0]."','2','".$_POST['lib_annee']."','".$sql18[0]."')";
mysql_query($req) or die('erreur insertion: '. $req);



echo "<script>alert(\"Ligne de frais forfait créée avec succes. N'oubliez pas d'envoyer votre justificatif pour traitement du frais.\");
document.location.href='menuvisiteur.php';</script>";
/*header("Location:menuvisiteur.php");*/

}

else

echo "<script>alert(\"Veuillez renseigner tous les champs\");
document.location.href='renseignerff.php';</script>";
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