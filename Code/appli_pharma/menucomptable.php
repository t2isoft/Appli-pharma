<?php
session_start();
if (isset($_SESSION['login']) and isset($_SESSION['mdp']) and !empty($_SESSION['login']) and !empty($_SESSION['mdp']) and $_SESSION['type']=='comptable') {
?>
<html>
	<head>
	
	<link rel ="stylesheet" href="style.css" name="text/css"/>
		<title>Gestion</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>
		<span class="bouton-menu"  onclick="document.location='logout.php'">Déconnexion</span>
		<center><h4>Bienvenue nous sommes le <?php echo date("d m Y",time());?></h4></center>
		
		<div class="box-home">
			<h3>Choisir une action </h3>
					<a href="validerff.php">Validation lignes non traitées</a>   
					<a href="suiviffperiode.php">Suivi fiches de frais par période</a>   
					<a href="suiviff.php">Suivi lignes de frais par période</a>   
					<a href="consulterfichevisiteur.php">Suivi fiches de frais par visiteur</a>   
					<a href="suiviffparvisiteur.php">Suivi lignes de frais par visiteur</a>   
					<a href="script.php">Clôturer fiches du mois terminé</a>   			
		<div>
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