<?php

class modifier_profilAction
{
	public function modification_email($element1, $element2)
	{
		$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
		$request = $bdd->prepare("UPDATE user SET email = :email_modif WHERE email = :email_ancien");
		$request->bindValue(':email_modif', $element1);
		$request->bindValue(':email_ancien', $element2);
		$request->execute();
	}

	public function modification_username($element1, $element2)
	{
		$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
		$request = $bdd->prepare("UPDATE user SET username = :username_modif WHERE username = :username_ancien");
		$request->bindValue(':username_modif', $element1);
		$request->bindValue(':username_ancien', $element2);
		$request->execute();
	}

	public function modification_password($element1, $element2)
	{
		$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
		$request = $bdd->prepare("UPDATE user SET password = :password_modif WHERE email = :email");
		$request->bindValue(':password_modif', $element1);
		$request->bindValue(':email', $element2);
		$request->execute();
	}
}