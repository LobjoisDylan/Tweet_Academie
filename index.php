<?php
session_start();

$controler = ucfirst($_GET['c']) . "Controler";
$actionner = ucfirst($_GET['a']) . "Action";



if(isset($_GET['c']) && isset($_GET['a'])  && file_exists($controler . '.php'))
{
	include($controler . '.php');

	$class = new test();
	if(method_exists($class, $actionner))
	{
		$class->$actionner();
	}
	else
	{
		session_destroy()
		header('Location: formulaire_connexion.php');
	}
}

else
{
	session_destroy();
	header('Location: formulaire_connexion.php');
}
?>