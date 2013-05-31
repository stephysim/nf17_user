<?php
		$vHost = "tuxa.sme.utc" ;
		$vDbname = "dbnf17p011" ;
		$vPort = "5432" ;
		$vUser = "nf17p011" ;
		$vPassword = "xub3EmKX" ;
		$vConn = pg_connect("host=$vHost port=$vPort dbname=$vDbname user=$vUser password=$vPassword") ;
?>
<div id="header">
	<div id="title">
		<h1 style="text-align : center ;">Environnement Administrateur</h1>
	</div>
	<hr/>
	<div id="mainMenu">
		<a href="ajoutAudio.php">Ajouter un document audio</a><br/>
		<a href="ajoutVideo.php">Ajouter un document vidéo</a><br/>
		<a href="ajoutTexte.php">Ajouter un document texte</a><br/>
		<a href="ajoutCatalogue.php">Ajouter un catalogue</a><br/>
		<a href="ajoutCollection.php">Ajouter une collection</a><br/>
	</div>
	<hr/>
	<br/>
</div>
