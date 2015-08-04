<?php
session_start();
if (isset($_SESSION['login']) and isset($_SESSION['mdp']) and !empty($_SESSION['login']) and !empty($_SESSION['mdp']) and $_SESSION['type']=='comptable') {
?>
<?php
$j1=date("Y-m-d");
$a1= date('Y');
$d1= date('n')-1;
$d2= date('n')-2;
mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');
$sql=" update fichefrais set id_etat=2, datemodif='".$j1."' where lib_annee='".$a1."' and id_mois = '".$d1."'";
mysql_query($sql) or die('erreur lecture: '. $sql. ' '. mysql_error());
$sql2=" update fichefrais set id_etat=3, datemodif='".$j1."' where lib_annee='".$a1."' and id_mois = '".$d2."'";
mysql_query($sql2) or die('erreur lecture: '. $sql2. ' '. mysql_error());
echo "<script>alert(\"La cloture des fiches s'est correctement executee \");
document.location.href = 'menucomptable.php';</script>";
?>
<?php
}
else {
echo "<script>alert(\"Vous n'êtes pas autorisé à accéder à cette zone \");
document.location.href = 'index.php';</script>";
}
?>