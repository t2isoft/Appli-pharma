<?php
// On appelle la session
session_start();

// On affiche une phrase résumant les infos sur l'utilisateur courant
echo 
	
	'Login : ',$_SESSION['login'],'<br />
	 ID : ',$_SESSION['id_vis'],'<br />
	 Prénom : ',$_SESSION['prenom'],'<br />
     Type : ',$_SESSION['type'],'<br />';
     
?>
<A href="logout.php">Deconnexion</a> 