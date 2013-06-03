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
		<script src="./recherche.js" type="text/javascript"></script>
	</head>
	<body>
		<?php include('header.php');
			$vSql = "SELECT distinct aencodage FROM tdocvideos;";
			$vQuery = pg_query($vConn,$vSql);
			$res = pg_fetch_array($vQuery);
			while($res = pg_fetch_array($vQuery)){
				if (isset($formatsV))
					$formatsV = $formatsV.','.$res['aencodage'];
				else
					$formatsV = $res['aencodage'];
			}
			
			$vSql = "SELECT distinct aencodage FROM tdocsonores;";
			$vQuery = pg_query($vConn,$vSql);
			$res = pg_fetch_array($vQuery);
			while($res = pg_fetch_array($vQuery)){
				if (isset($formatsA))
					$formatsA = $formatsA.','.$res['aencodage'];
				else
					$formatsA = $res['aencodage'];
			}
		?>
		<h1>RECHERCHE AVANCEE</h1>
		
		<form method="POST" action="recherche.php">
			<span>Titre : <input type="text" name="title" /></span><br/>
			<span>Type : 
				<label>Vidéo </label><input type="radio" name="type" value="vid" onFocus='changeVideo("suiteform", <?php echo '"'.$formatsV.'"'; ?>);'><br>
				<label>Sonore </label><input type="radio" name="type" value="son" onFocus='changeSonore("suiteform", <?php echo '"'.$formatsA.'"'; ?>);'><br>
				<label>Texte </label><input type="radio" name="type" value="text" onFocus='changeTexte("suiteform");'><br>
				<label>Tout type </label><input type="radio" name="type" value="tous" onFocus='resetDiv("suiteform");'>
			</span><br/> 	
		
			<span>Date de parution : </span>
			<select name="annee" />
				<option value="-1">Ne pas prendre en compte la date</option>			
				<?php 
					$vSql = "SELECT distinct date_part('year', adate_p) AS date FROM tdocuments ORDER BY date DESC;";
					$vQuery = pg_query($vConn,$vSql) ;
					while($res = pg_fetch_array($vQuery)){
					echo '<option value="'.$res['date'].'">'.$res['date'].'</option>';
				}?>
			</select><br>
			<div id="suiteform"></div>
			<br/><br/>
			<input type="submit" value="Rechercher"/>
		</form>
		
		<?php include('traitement.php');?>
			
		<p><a href="index.php">Retour</a></p>
	</body>
</html>
