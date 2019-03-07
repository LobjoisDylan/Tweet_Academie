<?php

include('../Model/classe_modifier_profil.php');

class modifier_profil
{	
	public $password;
	public $email_good = '/^[a-z0-9.-]+@[a-z0-9.-]{2,}.[a-z]{2,4}$/'; 
	public $email;

	public function __construct()
	{
		$this->email = $_SESSION['email'];
		$this->recup_donnees();
	}

	public function recup_donnees()
	{
		$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
		$request = $bdd->prepare("SELECT * FROM user WHERE email = :email");
		$request->bindValue(':email', $this->email);
		$request->execute();
		$donnees = $request->fetch(PDO::FETCH_ASSOC);

		$this->username = $donnees['username'];
		$this->password = $donnees['password'];
	}

	public function verification_email_bdd($mail_send)
	{
		$booleen = true;
		$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
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

	public function verification_email_valid($element)
	{
		if(preg_match($this->email_good, $element) == 0)
		{
			return false;
		}
		if(preg_match($this->email_good, $element) == 1)
		{
			return true;
		}
	}

	public function verification_email()
	{
		$this->email_ancien = $_POST['ancien_email'];
		$this->email_modif = $_POST['nouvelle_email'];
		$mail_exist = $this->verification_email_bdd($this->email_modif);
		$mail_valid = $this->verification_email_valid($this->email_modif);

		if($this->email_ancien != "" && $this->email_modif != "")
		{
			if($mail_exist == true && $mail_valid == true)
			{
				if($this->email_ancien == $this->email)
				{	
					$this->email = $this->email_modif;
					$modif = new modifier_profilAction();
					$modif->modification_email($this->email_modif, $this->email_ancien);
					echo "OK";
				}

				else
				{
					echo "Ce n'est pas le bon mail";
				}
			}

			else if($mail_exist == false)
			{
				echo "Le mail existe";
			}

			else if($mail_valid == false)
			{
				echo "Le mail n'est pas valide";
			}
		}

		else
		{
			echo "Champ vide";
		}
	}

	public function verification_username_bdd($username_send)
	{
		$booleen = true;
		$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
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

	public function verification_username()
	{
		$this->username_ancien = $_POST['ancien_username'];
		$this->username_modif = $_POST['nouveau_username'];
		$username_exist = $this->verification_username_bdd($this->username_modif);

		if($this->username_ancien != "" && $this->username_modif != "")
		{
			if($username_exist == true)
			{
				if($this->username_ancien == $this->username)
				{
					$this->username = $this->username_modif;
					$modif = new modifier_profilAction();
					$modif->modification_username($this->username_modif, $this->username_ancien);
					echo "OK";
				}

				else
				{
					echo "Ce n'est pas le bon username";
				}
			}

			else if($username_exist == false)
			{
				echo "L'username existe déjà";
			}
		}

		else
		{
			echo "Champ vide";
		}
	}

	
	public function verification_password()
	{
		$this->password_ancien = hash("ripemd160", $_POST['ancien_password'], "si tu aimes la wac tape dans
			tes mains");
		$this->password_modif = hash("ripemd160", $_POST['nouveau_password'], "si tu aimes la wac tape dans
			tes mains");
		if($this->password_ancien != "" && $this->password_modif != "")
		{
			if($this->password_ancien == $this->password)
			{
				$this->password = $this->password_modif;
				$modif = new modifier_profilAction();
				$modif->modification_password($this->password_modif, $this->email);
				echo "OK";
			}

			else
			{
				echo "Ce n'est pas le bon mot de passe";
			}
		}

		else
		{
			echo "Champ vide";
		}
	}
}

?>