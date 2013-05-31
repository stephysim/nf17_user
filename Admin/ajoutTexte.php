
<html>
	<head>
		<meta charset="utf-8" />
		<title>RealProjet5</title>
	</head>
	<body>
		<?php include('header.php') ;?>
		<h1>Ajout d'un document Texte</h1>
		
		<form method="POST" action="actionAjTexte.php">
			<span>Titre : <input type="text" name="title"/></span><br/><br/>
			<span>Auteur : <input type="text" name="inter"/></span><br/><br/>
			<span>Date de Parution : <input type="date" name="date_p"/></span><br/><br/>
			<span>Editeur : <input type="text" name="edit"/></span><br/><br/>
			<span>Nombre d'exemplaires : <input type="number" name="nb_exemp"/></span><br/><br/>
			<span>Langue : <select>
						<option value="fr">FR</option>
						<option value="it">IT</option>
						<option value="esp">ESP</option>
						<option value="all">ALL</option>
						<option value="am">USA</option>
						<option value="chin">CHI</option>
						<option value="ru">RU</option>
				       </select></span><br/><br/>
			<?php 
				$vSql = "SELECT pknom FROM tmediatheques ;" ;
				$vQuery = pg_query($vConn,$vSql) ;
			?>							
			<span>Médiathèque : <select>
						<?php while($res = pg_fetch_array($vQuery)) {?> 
						<option value="<?php echo $res['pknom'] ; ?>"><?php echo $res['pknom'] ; ?></option>
						<?php } ?>
					    </select></span><br/><br/>
			<span>Catalogue : </span><br/><br/>

			<?php 
				$vSql = "SELECT pknom FROM tcollections ;" ;
				$vQuery = pg_query($vConn,$vSql) ;
			?>
			<span>Collection : <select>
						<?php while($res = pg_fetch_array($vQuery)) {?> 
						<option value="<?php echo $res['pknom'] ; ?>"><?php echo $res['pknom'] ; ?></option>
						<?php } ?>
					    </select></span><br/><br/>
			
		</form>

	</body>
</html>
