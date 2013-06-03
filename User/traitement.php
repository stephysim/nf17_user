<?php	
	if (isset($_POST['type'])) {
		$type=$_POST['type'];
		$titre=$_POST['title'];
		$ann=$_POST['annee'];
		}
	if (isset($type) && (strcmp($titre, "") OR strcmp($type, "tous") OR $ann != -1)) {
		$vSql = "tdocuments";
		if(!strcmp($type, "vid")) {
			$vSql = "(SELECT atitre, aediteur, fknomcat, fknommedia, fknomcol, adate_p, alangue, anb_exemp FROM tdocvideos V, tdocuments D WHERE D.pkcode = V.pkcodedocv)";
		} else if(!strcmp($type, "son")) {
			$vSql = "(SELECT atitre, aediteur, fknomcat, fknommedia, fknomcol, adate_p, alangue, anb_exemp FROM tdocsonores S, tdocuments D WHERE D.pkcode = S.pkcodedocs)";
		} else {
			$vSql = "(SELECT atitre, aediteur, fknomcat, fknommedia, fknomcol, adate_p, alangue, anb_exemp FROM tdoctextes T, tdocuments D WHERE D.pkcode = T.pkcodedoct)";
		}  

		if($ann != -1) {
			$vSql = "(SELECT atitre, aediteur, fknomcat, fknommedia, fknomcol, adate_p, alangue, anb_exemp FROM ".$vSql." SR WHERE date_part('year', adate_p) = ".$ann.")";
		}
		
		if(strcmp($titre, "")) {
			$vSql = "(SELECT atitre, aediteur, fknomcat, fknommedia, fknomcol, adate_p, alangue, anb_exemp FROM ".$vSql." SR1 WHERE atitre LIKE '%".$titre."%')" ;
		}
		$vSql = $vSql.";";
		$vQuery = pg_query($vConn,$vSql) ;
?>
		
		<span>Résultats de la recherche :</span>		
			<table border="1">
				<tr>
					<th>Titre</th>
					<th>Catalogue</th>
					<th>Médiathèque</th>
					<th>Collection</th>
					<th>Editeur</th>
					<th>Date de parution</th>
					<th>Langue</th>
					<th>Nombre d'exemplaires</th>
				</tr>
				<?php while ($res = pg_fetch_array($vQuery)) { ?>
				<tr>	
					<td><?php echo $res['atitre'] ;?></td>
					<td><?php echo $res['fknomcat'] ;?></td>
					<td><?php echo $res['fknommedia'] ;?></td>
					<td><?php echo $res['fknomcol'] ;?></td>
					<td><?php echo $res['aediteur'] ;?></td>
					<td><?php echo $res['adate_p'] ;?></td>
					<td><?php echo $res['alangue'] ;?></td>
					<td><?php echo $res['anb_exemp'] ;?></td>
				</tr>
				<?php } // Fin du while ?> 		
			</table>
<?php 
	
	}
?>