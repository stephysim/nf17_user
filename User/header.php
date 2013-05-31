<?php
	$vHost = "tuxa.sme.utc" ;
	$vDbname = "dbnf17p011" ;
	$vPort = "5432" ;
	$vUser = "nf17p011" ;
	$vPassword = "xub3EmKX" ;
	$vConn = pg_connect("host=$vHost port=$vPort dbname=$vDbname user=$vUser password=$vPassword") ;
	$login = $_SESSION['login'] ;
?>
<div id="header">
	<div id="title">
		<h1>Realisation du Projet :</h1>
		<h2>Gestion d'une librairie de m&eacute;diath&egrave;ques</h2>
	</div>
	<hr/>
	<div id="mainMenu">
		<div id="recherche" class="inline">
			<p style="text-decoration : underline ;">Recherche Rapide</p>
			<form method="post" action="rechercheRapide.php">
				<label for="selectRech">Recherche par</label>
				<select name="selectRech">
					<option value="aTitre">Titre</option>
					<option value="auteur">Auteur</option>
					<option value="realisateur">Réalisateur</option>
					<option value="interprete">Interprète</option>
					<option value="acteur">Acteur</option>
				</select>
				<input type="text" name="rech" placeholder="Entrer la recherche...">
				<input type="submit" value="Rechercher">
			</form>
			<p><a href="recherche.php">Recherche avancée</a></p>	
		</div>
		<?php if(!isset($login) or !strcmp($login,"")) { ?> 
		<div id="loginBox" class="inline">
			<p style="text-decoration : underline ;">Connexion</p>
			<form method="POST" action="login.php">			
				<span>Login : <input type="text" name="login"></span><br/>
				<span>Mot de passe : <input type="password" name="mdp" /><br/><br/>
				<input type="submit" value="Connexion" />
			</form>
		</div>
		<?php } else { ?>
		<div id="loginBox" class="inline">
			<p> Bonjour <?php echo $_SESSION['nom'] ; echo " " ; echo $_SESSION['prenom'] ; ?> ! </p>
			<p><a href="deconnexion.php">Déconnexion</a></p>
		</div>
		<?php } ?>
		
	</div>
	<br/>
</div>
