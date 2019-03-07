<?php
include('../Model/classe_connexion.php');
class connexion
{

	public $email;
	public $password;

	public function __construct()
	{
		$this->email = $_POST['email'];
		$this->password = $_POST['password'];
	}

	public function verification_mail_bdd($mail_send)
	{
		$booleen = false;
		$request = new verifier_bdd();
		$donnees = $request->check_bdd($this->email);
		foreach($donnees as $key)
		{
			if($key['email'] == $mail_send)
			{
				$booleen = true;
			}
		}
		return $booleen;
	}

	public function verification_password($element)
	{
		$booleen = false;
		$request = new verifier_bdd();
		$donnees = $request->check_bdd($this->email);
		foreach($donnees as $key)
		{
			if($key['password'] == hash("ripemd160", $this->password, "si tu aimes la wac tape dans
				tes mains"))
			{
				$booleen = true;
			}
		}
		return $booleen;
	}

	public function verifications()
	{
		$mail = $this->verification_mail_bdd($this->email);
		$password = $this->verification_password($this->password);

		if($this->email != "" && $this->password != "")
		{
			if($mail == true && $password == true)
			{
				$_SESSION['email'] = $this->email;
				echo "OK";
			}

			if($mail == false && $password == false)
			{
				echo "infos incorrectes";
			}

			if($mail == false)
			{
				echo "mail inconnu";
			}

			if($password == false)
			{
				echo "password incorrect";
			}
		}
		else 
		{
			echo "champ vide";
		}
	}
}

?>