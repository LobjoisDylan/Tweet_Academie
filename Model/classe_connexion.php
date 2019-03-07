<?php

class verifier_bdd
{
	public function check_bdd($mail_send)
	{

		$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
		$request = $bdd->prepare("SELECT * FROM user WHERE email = :mail");
		$request->bindValue(':mail', $mail_send);
		$request->execute();
		$donnees = $request->fetchAll();

		return $donnees;
	}
}