<?php
include('connect.php');

	if(isset($_POST['search'])&&!empty($_POST['search']))
	{
		$search=mysql_real_escape_string(htmlentities($_POST['search']));//securisation injection mysql et html
		
		$query=mysql_query("SELECT * from visiteur WHERE prenom LIKE '$search%' or nom LIKE '$search%'") or die(mysql_error());
		
		while($rows=mysql_fetch_assoc($query))
		{
		
			echo"<li><a href='#' id='".$rows['id_vis']."'>".$rows['nom']." ".$rows['prenom']."</a></li>";

	
		}
	}

?>