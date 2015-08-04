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
	<center>
		<h4>Bienvenue nous sommes le :<?php echo date("d m Y",time());?></h4>
	</center>
<center>Etes-vous sûr de vouloir clôturer les fiches du mois qui s'est achevé 
<br>
<a href="cloture.php"><input class="bouton-valider" type="button" value="Oui"></a>
<a href="menucomptable.php"><input class="bouton-annuler" type="button" value="Non"></a>
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