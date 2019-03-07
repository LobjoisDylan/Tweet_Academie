<?php

class member
{
	public $bdd;
	public $pseudo;
	public $utilisateur;
	public $mail;
	public $password;
	public $following;


	public function __construct($bdd, $element)
	{
		$this->bdd = $bdd;

		$donnees = $this->recup_donnees($element);
		$this->pseudo = $donnees['...'];
		$this->utilisateur = $donnees['...'];
		$this->mail = $donnees['...'];
		$this->password = $donnees['...'];
	}

	public function recup_donnees($element)
	{
		$request = $this->bdd->query("SELECT * FROM ... WHERE ... = '$element'");
		$donnees = $request->fetchAll();
		return $donnees;
	}

	public function who_follow_me()
	{
		$request = $this->bdd->query("SELECT ... FROM ... WHERE ... = '$this->mail")
		$donnees = $request->fetchAll();
		return $donnees;
	}

/*----------------- GETTERS -------------------*/
	public function get_pseudo()
	{
		return $this->pseudo;
	}

		public function get_utilisateur()
	{
		return $this->utilisateur;
	}

		public function get_mail()
	{
		return $this->mail;
	}

		public function get_password()
	{
		return $this->password;
	}



/*----------------- SETTERS -------------------*/
	public function set_pseudo($pseudo)
	{
		 $this->pseudo = $pseudo;
	}

		public function set_utilisateur($utilisateur)
	{
		$this->utilisateur = $utilisateur;
	}

		public function set_mail($mail)
	{
		$this->mail = $mail;
	}

		public function set_password($password)
	{
		$this->password = $password;
	}

}


?>