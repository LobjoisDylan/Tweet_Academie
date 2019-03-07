<?php 
include('../Model/classe_identification.php');

class identification
{
	public $firstname;
	public $lastname;
	public $username;
	public $email;
	public $password;
	public $password_confirm;
	public $email_good = '/^[a-z0-9.-]+@[a-z0-9.-]{2,}.[a-z]{2,4}$/'; 

	public function __construct()
	{
		$this->lastname = $_POST['lastname'];
		$this->firstname = $_POST['firstname'];
		$this->username = $_POST['username'];
		$this->email = $_POST['email'];
		$this->password = $_POST['password'];
		$this->password_confirm = $_POST['password_confirm'];
	}

	public function verification_mail_valid($element)
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

	public function verification_password($element1, $element2)
	{
		if($element1 != $element2)
		{
			return false;
		}
		if($element1 == $element2)
		{
			return true;
		}
	}


	public function verifications()
	{
		$verif = new identificationAction();
		$username_exist = $verif->verification_username_bdd($this->username);
		$mail_exist = $verif->verification_mail_bdd($this->email);
		$mail_valide = $this->verification_mail_valid($this->email);
		$password = $this->verification_password($this->password, $this->password_confirm);
		if($this->username != "" && $this->email != "" && $this->firstname != "" && $this->lastname != "" && $this->password != "" && $this->password_confirm != "")
		{
			if($username_exist == true && $mail_exist == true && $mail_valide == true && $password == true)
			{
				$this->inscription();
				echo "OK";
			}

			else if($username_exist == false && $mail_exist == false && $password == false)
			{
				echo "username, mail existant et password non correspondant";
			}

			else if($username_exist == false && $mail_valide == false && $password == false)
			{
				echo "username existant, mail invalide et password non correspondant";
			}

			else if($mail_exist == false && $password == false)
			{
				echo "mail existant et password non correspondant";
			}

			else if($mail_valide == false && $username_exist == false) 
			{
				echo "mail invalide et username existant"; 
			}

			else if($username_exist == false && $password == false)
			{
				echo "username existant et password non correspondant"; 
			}

			else if($mail_valide == false && $password == false)
			{
				echo "mail invalide et password non correspondant"; 
			}

			else if($mail_exist == false && $username_exist == false) 
			{
				echo "mail existant et username existant";
			}

			else if($username_exist == false) 
			{
				echo "username existant";
			}

			else if($mail_exist == false)
			{
				echo "mail existant";
			}

			else if($mail_valide == false)
			{
				echo "mail invalide";
			}
			else if($password == false)
			{
				echo "password non correspondant";
			}
		}
		else 
		{
			echo "champ vide";
		}
	}
	public function inscription()
	{
		$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
		$request = $bdd->prepare("INSERT INTO user (username, email, lastname, firstname, password) VALUES (:username, :email, :lastname, :firstname, :password)");
		$request->bindValue(':username', $this->username);
		$request->bindValue(':email', $this->email);
		$request->bindValue(':lastname', $this->lastname);
		$request->bindValue(':firstname', $this->firstname);
		$request->bindValue(':password', hash("ripemd160", $this->password, "si tu aimes la wac tape dans
			tes mains"));
		$request->execute();
	}
	
}
