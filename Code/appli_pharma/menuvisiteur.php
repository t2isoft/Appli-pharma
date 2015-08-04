<?php
session_start();
if (isset($_SESSION['login']) and isset($_SESSION['mdp']) and !empty($_SESSION['login']) and !empty($_SESSION['mdp']) and $_SESSION['type']=='visiteur') {
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Gestion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
	<span class="bouton-menu"  onclick="document.location='logout.php'">Déconnexion</span>
<center>
<h4>Bienvenue <?php echo $_SESSION['prenom'];?>.<br> Vous êtes connecté en tant que <?php echo $_SESSION['type'];?>. Nous sommes le :<?php echo date("d m Y",time());?></h4>
</center>
	<div class="box-home">
		<h3>Choisir une action </h3>
		<a href="renseignerff.php">Renseigner  frais forfait</a> 
		<a href="consulterligne.php">Consulter mes frais</a>
		<a href="renseignerfhf.php">Renseigner frais hors forfait</a>
		<a href="consulterfiche.php">Consulter mes fiche de frais</a> 
	</div>
<body>
</body>
</html>
<?php
}
else {
echo "<script>alert(\"Vous n'êtes pas autorisé à accéder à cette zone \");
document.location.href = 'index.php';</script>";
}
?>