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
	</head>
	<body>
		<?php include('header.php') ?>
		<h1>RECHERCHE AVANCEE</h1>
		
		<form method="POST" action="recherche.php">
			<span>Titre : <input type="text" name=title /></span><br/>
			<span>Type : <select>
   					<option value="DocVideo">Document Vidéo</option>
   					<option value="DocAudio">Document Audio</option>
   					<option value="DocTexte">Document Texte</option>
				     </select>
			</span><br/> 	
		
			<span>Date d'apparition : <input type="date" name=date /><br/><br/>
			<input type="submit" value="Rechercher"/>
		</form>
			
		<p><a href="index.php">Retour</a></p>
	</body>
</html>
