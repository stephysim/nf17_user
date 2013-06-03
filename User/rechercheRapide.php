<?php	
	session_start() ;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>RealProjet5</title>
		<link href="css/index.css" rel="stylesheet" type="text/css">
		<link href="css/header.css" rel="stylesheet" type="text/css">
		<link href="css/rechercheRapide.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		
		<?php 
			include('header.php') ; 
			$typeRech = $_POST['selectRech'] ;
			$nom = $_POST['rech'] ;
			
			if(!isset($nom))  header('Location: index.php?erreur=NoEntry') ;
			else {
				if($typeRech=="auteur") {
					$vSql = "SELECT D.atitre, D.aediteur, D.fknomcat, D.fknommedia, D.fknomcol, D.adate_p, D.alangue, D.anb_exemp, P.anom, P.aprenom FROM tauteurs A, tpersonnes P, tredaction R, tdocuments D WHERE A.pkidcontri = P.pkid AND R.pkidaut = A.pkidcontri AND R.pkcodedoc = D.pkcode AND (P.anom LIKE '%".$nom."%' OR P.aprenom LIKE '%".$nom."');" ;
					$complement = "<th>Auteur</th>";
					$complement2 = '$res['."'aprenom'".']." ".$res['."'anom'".']';
					$complement2 = 'echo "<td>".'.$complement2.'."</td>";';
				}
				else if($typeRech=="realisateur") {
					$vSql = "SELECT D.atitre, D.aediteur, D.fknomcat, D.fknommedia, D.fknomcol, D.adate_p, D.alangue, D.anb_exemp, V.aduree, V.aencodage, P.anom, P.aprenom FROM trealisateurs A, tpersonnes P, trealisation R, tdocuments D, tdocvideos V WHERE A.pkidcontri = P.pkid AND R.pkidreal = A.pkidcontri AND R.pkcodedoc = D.pkcode AND V.pkcodedocv = D.pkcode AND (P.anom LIKE '%Nom%' OR P.aprenom LIKE '%Nom%');" ;
					$complement = "<th>Format vidéo</th><th>Durée</th><th>Realisateur</th>";
					$complement2 = '$res['."'aprenom'".']." ".$res['."'anom'".']';
					$complement2 = 'echo "<td>".$res['.'"aencodage"'.']."</td><td>".$res['.'"aduree"'.']."</td><td>".'.$complement2.'."</td>";';
				}
				else if($typeRech=="interprete") {
					$vSql = "SELECT D.atitre, D.aediteur, D.fknomcat, D.fknommedia, D.fknomcol, D.adate_p, D.alangue, D.anb_exemp, S.aduree, S.aencodage, P.anom, P.aprenom FROM tinterpretes A, tpersonnes P, tinterpretation I, tdocuments D, tdocsonores S WHERE A.pkidcontri = P.pkid AND I.pkidint = A.pkidcontri AND I.pkcodedoc = D.pkcode AND S.pkcodedocs = D.pkcode AND (P.anom LIKE '%Nom%' OR P.aprenom LIKE '%Nom%');" ;
					$complement = "<th>Format audio</th><th>Durée</th><th>Interprete</th>";
					$complement2 = '$res['."'aprenom'".']." ".$res['."'anom'".']';
					$complement2 = 'echo "<td>".$res['.'"aencodage"'.']."</td><td>".$res['.'"aduree"'.']."</td><td>".'.$complement2.'."</td>";';
				}
				else if($typeRech=="acteur") {
					$vSql = "SELECT D.atitre, D.aediteur, D.fknomcat, D.fknommedia, D.fknomcol, D.adate_p, D.alangue, D.anb_exemp, V.aduree, V.aencodage, P.anom, P.aprenom, R.pkrole FROM tacteurs A, tpersonnes P, troles R, tdocuments D, tdocvideos V WHERE A.pkidcontri = P.pkid AND R.pkidact = A.pkidcontri AND R.pkcodedoc = D.pkcode AND V.pkcodedocv = D.pkcode AND (P.anom LIKE '%Nom%' OR P.aprenom LIKE '%Nom%');" ;
					$complement = "<th>Format vidéo</th><th>Durée</th><th>Acteur</th><th>Rôle</th>";
					$complement2 = '$res['."'aprenom'".']." ".$res['."'anom'".']';
					$complement2 = 'echo "<td>".$res['.'"aencodage"'.']."</td><td>".$res['.'"aduree"'.']."</td><td>".'.$complement2.'."</td><td>".$res['.'"pkrole"'.']."</td>";';
				}
				else {
					$vSql = "SELECT atitre, aediteur, fknomcat, fknommedia, fknomcol, adate_p, alangue, anb_exemp FROM tdocuments WHERE atitre LIKE '%".$nom."%' ;" ;
					$complement = "";
					$complement2 = "echo '';";
				}
				$vQuery = pg_query($vConn,$vSql) ;
			?> 
			<br/>
			<span>Résultats de la recherche :</span>		
			<table>
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
			<?php } // Fin else if ?>	
	</body>
</html>
