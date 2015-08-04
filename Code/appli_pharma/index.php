<html>
 <head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Bienvenue</title>
 </head>
<body>
 <div class="champ1">  
   <form method="post" action="verifLogin.php">
<fieldset>
					<legend>Déjà inscrit</legend>
					<p><input type="text" name="login" placeholder="Login"></p>
					<p><input type="password" name="password" placeholder="Password"></p>
					<input type="submit"  name="submit" value="Valider" />
				</fieldset>
			</form>
		</div>  
		
<div class="champ2">     
			<form action="index.php" method="POST">
				<fieldset>
					<legend>Ajouter un visiteur</legend>
					<p><input type="text" name="nom" id="nom" placeholder="Nom"required/></p>
					<p><input type="text" name="prenom" id="prenom"placeholder="Prénom" required/></p>
					<p><input type="text" name="login" id="login" placeholder="Login"required/></p>
					<p><input type="password" name="mdp" id="mdp" placeholder="Mot de passe"required/></p>
					<p><input type="text" name="adresse" id="adresse" placeholder="Adresse"required/></p>
					<p><input type="text" name="cp" id="cp" placeholder="Code postal"required/></p>
					<p><input type="text" name="ville" id="ville" placeholder="Ville"required/></p>
					<p><span class="embauche">Date d'embauche</span><br><input type="date" name="date_embauche" id="date_embauche" placeholder="Date d'embauche" required/></p>
					<input type="submit"  value="Valider" />
					<?php
					
					
					if(isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['login']) and isset($_POST['mdp']) and isset($_POST['adresse'])and isset($_POST['cp'])and isset($_POST['ville']) and isset($_POST['date_embauche']))
					{
						if(!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['login']) and !empty($_POST['mdp']) and !empty($_POST['adresse'])and !empty($_POST['cp'])and !empty($_POST['ville']) and !empty($_POST['date_embauche']))
						{
							 mysql_connect('localhost','root','root') or die('Impossible d\'acceder au serveur');
							 mysql_select_db('appli_pharma') or die('Impossible d\'acceder à la base');
							$sql1="select * from visiteur where adresse='".$_POST['adresse']."'"; 
							$resultat=mysql_query($sql1) or die('erreur exec recet');
							if(mysql_num_rows($resultat)==0)
							{
								$sql2="insert into visiteur values('','".$_POST['nom']."','".$_POST['prenom']."','".$_POST['login']."','".$_POST['mdp']."','".$_POST['adresse']."','".$_POST['cp']."','".$_POST['ville']."','".$_POST['date_embauche']."','visiteur')";
								mysql_query($sql2);
								echo "<script> alert('Le visiteur est ajouté avec succès '); document.location.href = 'index.php';</script>";
								mysql_close();
							}
							else
							{
								echo "<script>alert(\"Visiteur déjà existant \");document.location.href = 'index.php';</script>";
							}
						}
						else
						{	
							echo "<script>alert(\"Les champs sont vides \"); document.location.href = 'index.php';</script>";
						}
					}
					else{}
					//alerte('Les variables non existants');
					?>
				</fieldset>
			</form>
		</div>  
 </body>
</html>