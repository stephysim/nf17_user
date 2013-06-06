<?php	
	if (isset($_POST['type'])) {
		$type=$_POST['type'];
		$titre=$_POST['title'];
		$ann=$_POST['annee'];
		}
	if (isset($type) && (strcmp($titre, "") OR strcmp($type, "tous") OR $ann != -1)) {
		$vSql = "tdocuments"; /* table de base a requeter */
		$complement = "";
		$complement2 = "echo '';";
		
		if(!strcmp($type, "vid")) { /* Document vidéo */
			/* requete de base : selection des documents videos */
			$vSql = "(SELECT pkcode, atitre, aediteur, fknomcat, fknommedia, fknomcol, adate_p, alangue, anb_exemp, aencodage, aduree, P.anom, P.aprenom FROM tpersonnes P, trealisateurs A, trealisation R, tdocvideos V, tdocuments D WHERE A.pkidcontri = P.pkid AND R.pkidreal = A.pkidcontri AND R.pkcodedoc = D.pkcode AND D.pkcode = V.pkcodedocv)";
			if (strcmp($_POST['realisateur'], "")) {
				$nom = $_POST['realisateur'];
				/* dans le cas ou le champs réalisateur est renseigné on va requeter nos documents vidéos pour n'en sortir que ceux qui correspondent à un réalisateur */
				$vSql = "(SELECT * FROM ".$vSql." SRREAL WHERE anom LIKE '%".$nom."%' OR aprenom LIKE '%".$nom."%')";
			}
			if (strcmp($_POST['format'], "tous")) {
				/* on va requeter nos resultats sur le champs aencodage en particulier */
				$vSql = "(SELECT * FROM ".$vSql." SRFORMAT WHERE aencodage ='".$_POST['format']."')";
			}
			switch ($_POST['duree']) {
				/* on va requeter nos resultats sur le champs aduree en particulier */
				case 1: $vSql = "(SELECT * FROM ".$vSql." SRDUREE WHERE date_part('hour', aduree) <= 1)";
					break;
				case 2: $vSql = "(SELECT * FROM ".$vSql." SRDUREE WHERE date_part('hour', aduree) >= 1 AND date_part('hour', aduree) <= 2)";
					break;
				case 3: $vSql = "(SELECT * FROM ".$vSql." SRDUREE WHERE date_part('hour', aduree) >= 2)";
					break;
				default: break;
			}
			$complement = "<th>Realisateur</th><th>Format vidéo</th><th>Durée</th>";
			$complement2 = '$res['."'aprenom'".']." ".$res['."'anom'".']';
			$complement2 = 'echo "<td>".'.$complement2.'."</td><td>".$res['."'aencodage'".']."</td><td>".$res['."'aduree'".']."</td>";';
		} else if(!strcmp($type, "son")) {
			$vSql = "(SELECT pkcode, atitre, aediteur, fknomcat, fknommedia, fknomcol, adate_p, alangue, anb_exemp FROM tdocsonores S, tdocuments D WHERE D.pkcode = S.pkcodedocs)";
			/* requete de base : selection des documents sonores */
			$vSql = "(SELECT pkcode, atitre, aediteur, fknomcat, fknommedia, fknomcol, adate_p, alangue, anb_exemp, aencodage, aduree, P.anom, P.aprenom FROM tpersonnes P, tinterpretes A, tinterpretation R, tdocsonores V, tdocuments D WHERE A.pkidcontri = P.pkid AND R.pkidint = A.pkidcontri AND R.pkcodedoc = D.pkcode AND D.pkcode = V.pkcodedocs)";
			if (strcmp($_POST['interprete'], "")) {
				$nom = $_POST['interprete'];
				/* dans le cas ou le champs interprete est renseigné on va requeter nos documents sonores pour n'en sortir que ceux qui correspondent à un interprete */
				$vSql = "(SELECT * FROM ".$vSql." SRREAL WHERE anom LIKE '%".$nom."%' OR aprenom LIKE '%".$nom."%')";
			}
			if (strcmp($_POST['format'], "tous")) {
				/* on va requeter nos resultats sur le champs aencodage en particulier */
				$vSql = "(SELECT * FROM ".$vSql." SRFORMAT WHERE aencodage ='".$_POST['format']."')";
			}
			switch ($_POST['duree']) {
				/* on va requeter nos resultats sur le champs aduree en particulier */
				case 1: $vSql = "(SELECT * FROM ".$vSql." SRDUREE WHERE date_part('minute', aduree) <= 3)";
					break;
				case 2: $vSql = "(SELECT * FROM ".$vSql." SRDUREE WHERE date_part('minute', aduree) >= 3 AND date_part('minute', aduree) <= 5)";
					break;
				case 3: $vSql = "(SELECT * FROM ".$vSql." SRDUREE WHERE date_part('minute', aduree) >= 5)";
					break;
				default: break;
			}
			$complement = "<th>Interprete</th><th>Format vidéo</th><th>Durée</th>";
			$complement2 = '$res['."'aprenom'".']." ".$res['."'anom'".']';
			$complement2 = 'echo "<td>".'.$complement2.'."</td><td>".$res['."'aencodage'".']."</td><td>".$res['."'aduree'".']."</td>";';
		} else if(!strcmp($type, "text")) {
			$vSql = "(SELECT pkcode, atitre, aediteur, fknomcat, fknommedia, fknomcol, adate_p, alangue, anb_exemp FROM tdoctextes T, tdocuments D WHERE D.pkcode = T.pkcodedoct)";
			if (strcmp($_POST['auteur'], "")) {
				$nom = $_POST['auteur'];
				$vSql = "(SELECT pkcode, atitre, aediteur, fknomcat, fknommedia, fknomcol, adate_p, alangue, anb_exemp, P.anom, P.aprenom FROM tauteurs A, tpersonnes P, tredaction R, ".$vSql." SRAUTEUR WHERE A.pkidcontri = P.pkid AND R.pkidaut = A.pkidcontri AND R.pkcodedoc = SRAUTEUR.pkcode AND (P.anom LIKE '%".$nom."%' OR P.aprenom LIKE '%".$nom."%'))";
				$complement = "<th>Auteur</th>";
				$complement2 = '$res['."'aprenom'".']." ".$res['."'anom'".']';
				$complement2 = 'echo "<td>".'.$complement2.'."</td>";';
			}
		} else {
			$vSql = "(SELECT pkcode, atitre, aediteur, fknomcat, fknommedia, fknomcol, adate_p, alangue, anb_exemp FROM tdocuments D)";
		}

		if($ann != -1) {
			$vSql = "(SELECT * FROM ".$vSql." SRDATE WHERE date_part('year', adate_p) = ".$ann.")";
		}
		
		if(strcmp($titre, "")) {
			$vSql = "(SELECT * FROM ".$vSql." SRTITRE WHERE atitre LIKE '%".$titre."%')" ;
		}
		$vSql = $vSql.";";
		echo "requete complete : ".$vSql;
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
					<?php echo $complement; ?>
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
					<?php eval($complement2); ?>
				</tr>
				<?php } // Fin du while ?> 		
			</table>
<?php 
	
	} // fin du IF
?>