<?php

// On démarre la session
session_start();
$loginOK = false;  

// On n'effectue les traitement qu'à la condition que 
// les informations aient été effectivement postées
if ( isset($_POST) && (!empty($_POST['login'])) && (!empty($_POST['password'])) ) {

  extract($_POST);  // je vous renvoie à la doc de cette fonction
  
  //Connexion à la base
  mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
  mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');
  // On va chercher le mot de passe afférent à ce login
  $sql = "SELECT id_vis, login, mdp, prenom, type FROM visiteur WHERE login = '".addslashes($login)."'";
  $req = mysql_query($sql) or die('Erreur SQL : <br />'.$sql);
  
  // On vérifie que l'utilisateur existe bien
  if (mysql_num_rows($req) > 0) {
     $data = mysql_fetch_assoc($req);
    
    // On vérifie que son mot de passe est correct
    if ($password == $data['mdp']) {
      $loginOK = true;
    }
  }
}

// Si le login a été validé on met les données en sessions
if ($loginOK) {
  $_SESSION['id_vis'] = $data['id_vis'];
  $_SESSION['login'] = $data['login'];
   $_SESSION['mdp'] = $data['mdp'];
  $_SESSION['prenom'] = $data['prenom'];
  $_SESSION['type'] = $data['type'];
  
    if ($data['type']=='visiteur'){
  header('Location: menuvisiteur.php');      
} 
else if ($data['type']=='comptable'){
  header('Location: menucomptable.php'); 
  }
}
else {
  echo "<script>alert(\"Merci de vous authentifier \");
document.location.href = 'index.php';</script>";
}
?>