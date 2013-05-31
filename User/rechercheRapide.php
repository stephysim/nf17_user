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
			else if($typeRech=="aTitre") {
				$vSql = "SELECT atitre, aediteur, fknomcat, fknommedia, fknomcol, adate_p, alangue, anb_exemp
					 FROM tdocuments WHERE atitre = '".$nom."' ;" ;
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
				<?php } ?> <!-- Fin du while --> 		
			</table>
			<?php } ?> <!--Fin else if -->	
	</body>
</html>
