<?php
include('connect.php');

if(isset($_POST['lien'])&&!empty($_POST['lien']))
{

	$lien=($_POST['lien']);

	$result=mysql_query("	select 	*
							from 	lignefraisforfait, fraisforfait, etatligne, visiteur, annee, mois
							where 	visiteur.id_vis=lignefraisforfait.id_vis
									and fraisforfait.id_ff=lignefraisforfait.id_ff
									and lignefraisforfait.id_etatligne=etatligne.id_etatligne
									and lignefraisforfait.lib_annee=annee.lib_annee
									and lignefraisforfait.id_mois=mois.id_mois
									and visiteur.id_vis='$lien'") or die(mysql_error());

			echo "<center> <b>".mysql_num_rows($result)." Frais Forfait saisis sur cette période</b></center>";

		?>

			<center>
				<table class="table1">
				<tr>
					<th>Nom du salarié</th>
					<th>Prénom du salarié</th>
					<th>Libellé du frais</th>
					<th>Quantité</th>
					<th>Montant total</th>
					<th>Montant valide</th>
					<th>Date du traitement</th>
					<th>Etat</th>
				</tr>
				<?php
				while($enreg=mysql_fetch_array($result))
				{//debut de while
				?>
				<tr>
					<td><?php echo $enreg['nom']?></td>
					<td><?php echo $enreg['prenom']?></td>
					<td><?php echo $enreg['lib_ff']; ?></td>
					<td><?php echo $enreg['quantite_lff']; ?></td>
					<td><?php echo $enreg['montanttotal_lff']; ?></td>
					<td><?php echo $enreg['montvalid_lff']; ?></td>
					<td><?php echo $enreg['datetrait_lff']; ?></td>
					<td><?php echo $enreg['lib_etatligne']; ?></td>
				</tr>
				<?php
				} // fin de while

				?>
				</table>
			</center>
		<?php
		$result1=mysql_query("	select 	*
								from 	lignefraishorsforfait, etatligne, visiteur, annee, mois
								where 	visiteur.id_vis=lignefraishorsforfait.id_vis
										and lignefraishorsforfait.id_etatligne=etatligne.id_etatligne
										and lignefraishorsforfait.lib_annee=annee.lib_annee
										and lignefraishorsforfait.id_mois=mois.id_mois
										and visiteur.id_vis='$lien'") or die(mysql_error());
		

		echo "<center><br/> <b>".mysql_num_rows($result1)." Frais Hors Forfait saisis sur cette période</b></center>";
		?>
			<center>
				<table border="1">
				<tr bgcolor="#99FF33">
					<th>Nom du salarié</th>
					<th>Prénom du salarié</th>
					<th>Libellé du frais</th>
					<th>Montant Total</th>
					<th>Montant valide</th>
					<th>Date du traitement</th>
					<th>Etat</th>
				</tr>
				<?php
				while($resa=mysql_fetch_array($result1))
				{//debut de while
				?>
				<tr>
					<td><?php echo $resa['nom']?></td>
					<td><?php echo $resa['prenom']?></td>
					<td><?php echo $resa['lib_lfhf']; ?></td>
					<td><?php echo $resa['mont_lfhf']; ?></td>
					<td><?php echo $resa['montvalid_lfhf']; ?></td>
					<td><?php echo $resa['datetrait_lfhf']; ?></td>
					<td><?php echo $resa['lib_etatligne']; ?></td>
				</tr>
				<?php
				} // fin de while

				?>
				</table>
			</center>


	<?php	

}



?>