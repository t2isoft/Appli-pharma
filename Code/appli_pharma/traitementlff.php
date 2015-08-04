<?php
session_start();
if (isset($_SESSION['login']) and isset($_SESSION['mdp']) and !empty($_SESSION['login']) and !empty($_SESSION['mdp']) and $_SESSION['type']=='comptable') {
?>
<html>
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
<title>Valider une ligne de frais forfait</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</center>

<?php 
mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');
$j1=date("Y-m-d");
if(isset($_GET['reference']))
{


$sql1="select * from lignefraisforfait, fraisforfait, etatligne, visiteur, annee, mois
where visiteur.id_vis=lignefraisforfait.id_vis
and fraisforfait.id_ff=lignefraisforfait.id_ff
and lignefraisforfait.id_etatligne=etatligne.id_etatligne 
and lignefraisforfait.lib_annee=annee.lib_annee
and lignefraisforfait.id_mois=mois.id_mois
and id_lff='".$_GET['reference']."'";
$r1=mysql_query($sql1);
while($resa=mysql_fetch_array($r1))
{
?>
<center>
<h2>Validation de la ligne de frais forfait : <?php echo $_GET['reference'] ?></h2>
<form action="traitementlff.php" method="post">
<table class="table2">
<tr><td bgcolor="#00FF99">Nom du salarié</td><td><input readonly="readonly" type="text" name="nom" 
value="<?php echo $resa['nom']; ?>"></td></tr>
<tr><td bgcolor="#00FF99">Prénom du salarié</td><td><input readonly="readonly" type="text" name="prenom" 
value="<?php echo $resa['prenom']; ?>"></td></tr>
<tr><td bgcolor="#00FF99">Année du frais</td><td><input readonly="readonly" type="int" name="lib_annee" 
value="<?php echo $resa['lib_annee']; ?>"></td></tr>
<tr><td bgcolor="#00FF99">Mois du frais</td><td><input readonly="readonly" type="text" name="lib_mois" 
value="<?php echo $resa['lib_mois']; ?>"></td></tr>
<tr><td bgcolor="#00FF99">Libellé du frais</td><td><input readonly="readonly" type="text" name="lib_ff" 
value="<?php echo $resa['lib_ff']; ?>"></td></tr>
<tr><td bgcolor="#00FF99">Quantité</td><td><input readonly="readonly" type="int" 
name="quantite_lff" value="<?php echo $resa['quantite_lff']; ?>"></td>
<tr><td bgcolor="#00FF99">Montant total du frais</td><td><input readonly="readonly" type="float" 
name="montanttotal_lff" value="<?php echo $resa['montanttotal_lff']; ?>"></td>
<tr><td bgcolor="#00FF99">Montant validé</td><td><input type="float" 
name="montvalid_lff" value="<?php echo $resa['montvalid_lff']; ?>"></td></tr>
<tr><td bgcolor="#00FF99">Justificatif fourni</td><td><input type="checkbox" 
<?php if(isset($resa['justiffourni_lff']) && !empty($resa['justiffourni_lff']) && $resa['justiffourni_lff']== true){echo 'checked="checked"';} ?> name="justiffourni_lff" ></td></tr>
<tr><td bgcolor="#00FF99">Si vous souhaitez traiter définitivement cette demande, cochez la case ci-contre</td><td><input type="checkbox" name="trait_lff" ></td></tr>
</table>
<input class="bouton-valider" type="submit" value="Traiter la fiche"> &nbsp;&nbsp;<input class="bouton-annuler"type="reset" value="Annuler">
<input type="hidden" name="reference" value="<?php echo $_GET['reference']; ?>">
</form>
</center>
<?php
}
}
// validation de ligne de frais forfait
if(isset($_POST['montvalid_lff']))
{
	$sql=" update lignefraisforfait set montvalid_lff='".$_POST['montvalid_lff']."', datetrait_lff='".$j1."' where id_lff='".$_POST['reference']."'";
	mysql_query($sql) or die('erreur insertion: '. $sql. ' '. mysql_error());
	
	$sql2=" update lignefraisforfait ";
	
	$sql2.=" set " ;

		
		if(isset($_POST['justiffourni_lff']) && !empty($_POST['justiffourni_lff']) && $_POST['justiffourni_lff'] == true)
		{
			$sql2.=" justiffourni_lff=1" ;
		}
		else 
		{
			$sql2.=" justiffourni_lff=0 " ;
		}
		

	$sql2.=" where id_lff='".$_POST['reference']."'";
	mysql_query($sql2) or die('erreur insertion: '. $sql2. ' '. mysql_error());
	
	if(isset($_POST['justiffourni_lff']) && !empty($_POST['justiffourni_lff']) && ($_POST['justiffourni_lff']) == true && isset($_POST['trait_lff']) && !empty($_POST['trait_lff']) && ($_POST['trait_lff']) == true && $_POST['montvalid_lff']!=0)
	{
	$sql3=" update lignefraisforfait set id_etatligne=1 where id_lff='".$_POST['reference']."'";
	mysql_query($sql3) or die('erreur exec recet1');
	
	$d= date('n');
    $d2=date("Y-m-d");
	$d3= date('Y');
	
	//Recupération id_visiteur
	$sql20="select id_vis from visiteur where nom='".$_POST['nom']."' and prenom='".$_POST['prenom']."'"; 
    $resultat20=mysql_query($sql20) or die('erreur lecture: '. $sql20. ' '. mysql_error());
    $sql21=mysql_fetch_array($resultat20);
	
	//Vérification existance d'une fiche de frais pour le visiteur pour l'année/mois en cours
	$sql30="select * from fichefrais 
	where id_vis= '".$sql21['id_vis']."'
	and lib_annee= '".$d3."'
	and id_mois = '".$d."'"; 
	$resultat30=mysql_query($sql30) or die('erreur lecture: '. $sql30. ' '. mysql_error());
	
	if(mysql_num_rows($resultat30)==0)
	{
	$sql40="insert into fichefrais 
	values('','".$_POST['montvalid_lff']."','".$d2."','1','".$sql21[0]."','".$d3."','".$d."')";
	mysql_query($sql40) or die('erreur insertion: '. $req);
	}
	else
	{
	// Récupération id_ff
	$sql50="select id_fichefrais from fichefrais 
	where id_vis= '".$sql21[0]."'
	and lib_annee= '".$d3."'
	and id_mois = '".$d."'"; 
	$resultat50=mysql_query($sql50) or die('erreur lecture: '. $sql50. ' '. mysql_error());
	$sql51=mysql_fetch_array($resultat50);
	
	// Récupération montantvalide
	$sql60="select montantvalide from fichefrais 
	where id_fichefrais= '".$sql51[0]."'"; 
	$resultat60=mysql_query($sql60) or die('erreur exec recet3');
	$sql61=mysql_fetch_array($resultat60);
	
	// Calcul nouveau montant valide
	$sql70=$sql61['montantvalide'] + $_POST['montvalid_lff'];  
	
	
	//Mise à jour de la fiche de frais
	$sql80=" update fichefrais set montantvalide='".$sql70."' where id_fichefrais='".$sql51[0]."'";
	mysql_query($sql80) or die('erreur exec recet5');
	$sql90=" update fichefrais set datemodif='".$d2."' where id_fichefrais='".$sql51[0]."'";
	mysql_query($sql90) or die('erreur exec recet6');
	}
	echo "<script>alert(\"Le frais a été traité avec succès et est désormais validé\");document.location.href = 'validerff.php';</script>";
	}
	else if(isset($_POST['trait_lff']) && !empty($_POST['trait_lff']) && ($_POST['trait_lff']) == true && $_POST['montvalid_lff']==0)
	{
	$sql4=" update lignefraisforfait set id_etatligne=3 where id_lff='".$_POST['reference']."'";
	mysql_query($sql4) or die('erreur exec recet6');
	echo "<script>alert(\"Le frais a été traité et est désormais refusé\");document.location.href = 'validerff.php';</script>";
	}
	else
	{
	$sql5=" update lignefraisforfait set id_etatligne=2 where id_lff='".$_POST['reference']."'";
	mysql_query($sql5) or die('erreur exec recet7');
	echo "<script>alert(\"Le frais a été traité et reste en statut non traité\");document.location.href = 'validerff.php';</script>";
	}
	
}

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