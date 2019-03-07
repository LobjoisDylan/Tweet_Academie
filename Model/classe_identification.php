<?php 

class identificationAction
{


	public function verification_mail_bdd($mail_send)
	{
		$booleen = true;
		$bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=utf8', 'root', '');
		$request = $bdd->prepare("SELECT email FROM user WHERE email = :mail");
		$request->bindValue(':mail', $mail_send);
		$request->execute();
		$donnees = $request->fetchAll();

		foreach($donnees as $key)
		{
			if($key['email'] == $mail_send)
			{
				$booleen = false;
			}
		}
		return $booleen;
	}

	public function verification_username_bdd($username_send)
	{
		$booleen = true;
		$bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=utf8', 'root', '');
		$request = $bdd->prepare("SELECT username FROM user WHERE username = :username");
		$request->bindValue(':username', $username_send);
		$request->execute();
		$donnees = $request->fetchAll();

		foreach($donnees as $key)
		{
			if($key['username'] == $username_send)
			{
				$booleen = false;
			}
		}
		return $booleen;
	}


}