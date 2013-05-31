<?php
	session_start() ;
	$login = $_POST['login'] ;
	$mdp = $_POST['mdp'] ;
	if(!isset($login) or !strcmp($login,'') or !isset($mdp) or !strcmp($mdp,''))  header('Location: index.php?erreur=noLog') ;
	else {
		$vHost = "tuxa.sme.utc" ;
		$vDbname = "dbnf17p011" ;
		$vPort = "5432" ;
		$vUser = "nf17p011" ;
		$vPassword = "xub3EmKX" ;
		$vConn = pg_connect("host=$vHost port=$vPort dbname=$vDbname user=$vUser password=$vPassword") ;
		//$vSql = "SELECT pklogin, amdp FROM tadherents WHERE pklogin = '".$login."' AND amdp = '".$mdp."' ;" ;
		$vSql = "SELECT anom, aprenom FROM tpersonnes,tadherents WHERE fkidpers = pkid AND pklogin = '".$login."'
			 AND amdp = '".	$mdp."' ;" ;
		$vQuery = pg_query($vConn,$vSql) ; 
		if ($res = pg_fetch_array($vQuery, null, PGSQL_ASSOC)) {
			$_SESSION['login'] = $login ;
			$_SESSION['nom'] = $res['anom'] ;
			$_SESSION['prenom'] = $res['aprenom'] ;
			
			header('Location: index.php?log='.$login.'') ;
		}
		else header('Location: index.php?erreur=falseLog') ;	
	}
?>
