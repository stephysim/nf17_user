<?php
	$login = $_POST['login'] ;
	$mdp = $_POST['mdp'] ;

	if(!isset($login) or !isset($mdp)) header('location: index.php?erreur=NoEntry') ;
	else if(!strcmp("admin,$login") and !strcmp($mdp,"admin")) header('location: admin.php') ;
	else header('location: index.php?erreur=falseEntry') ;


?>
