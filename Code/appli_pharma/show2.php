<?php
include('connect.php');

if(isset($_POST['lien'])&&!empty($_POST['lien']))
{

	$lien=($_POST['lien']);

	$result=mysql_query("	select 	*
							from 	fichefrais, etat, annee, mois, visiteur
							where fichefrais.id_etat=etat.id_etat
							and fichefrais.lib_annee=annee.lib_annee
							and fichefrais.id_vis=visiteur.id_vis
							and fichefrais.id_mois=mois.id_mois
							and visiteur.id_vis='$lien'") or die(mysql_error());

			echo "<center> <b>".mysql_num_rows($result)." Fiche de frais pour cette personne</b></center>";

		?>

			<center>
				<table class="table1">
				<tr>
					<th>Annéee de la fiche</th><th>Mois de la fiche</th><th>Dernière date de modification</th><th>Montant validé</th><th>Etat</th>
				</tr>
				<?php
				while($enreg=mysql_fetch_array($result))
				{//debut de while
				?>
				<tr><td><?php echo $enreg['lib_annee']?></td>
				<td><?php echo $enreg['lib_mois']?></td>
				<td><?php echo $enreg['datemodif']?></td>
				<td><?php echo $enreg['montantvalide']; ?></td>
				<td><?php echo $enreg['lib_etat']; ?></td>
				</tr>
				<?php
				} // fin de while

				?>
				</table>
			</center>
		


	<?php	

}



?>