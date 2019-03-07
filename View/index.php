<?php
session_start();

$controler = $_GET['c'];
$actionner = $_GET['a'];

$classe_controler = "classe_controler_" . $controler;


if(isset($_GET['c']) && isset($_GET['a'])  && file_exists('../Controler/' . $classe_controler . '.php'))
{
	include( '../Controler/' .$classe_controler . '.php');
	$class = new $controler();

	if(method_exists($class, $actionner))
	{
		$class->$actionner();
	}
	else
	{
		session_destroy();
		header('Location: ../View/formulaire_connexion.php');
	}
}

else
{
	session_destroy();
	header('Location: ../View/formulaire_connexion.php');
}
?>