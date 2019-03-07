<?php

class member
{
	public $bdd;
	public $username;
	public $lastname;
	public $firstname;
	public $email;
	public $mail_other;
	public $avatar;
	public $password;
	public $date_inscription;
	public $theme;
	public $email_modif;
	public $email_ancien;
	public $email_good = '/^[a-z0-9.-]+@[a-z0-9.-]{2,}.[a-z]{2,4}$/'; 
	public $id_user;
	public $following;
	public $number_tweets;
	public $number_following;
	public $number_follower;


	public function __construct($element)
	{
		$this->bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=UTF8', 'root', '');
		$this->email = $_SESSION['email'];
		$this->recup_donnees($element);
		$this->number_tweets();
		$this->number_following();
		$this->number_follower();
	}

	public function recup_donnees($element)
	{

		if($element != "")
		{
			$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
			$request = $bdd->prepare("SELECT * FROM user WHERE username LIKE :filtre OR id_user = :filtre2");
			$request->bindValue(':filtre', "%" . $element . "%");
			$request->bindValue(':filtre2', $element);
			$request->execute();
			$donnees = $request->fetch(PDO::FETCH_ASSOC);
		}

		if($element == "")
		{
			$bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=UTF8', 'root', '');
			$request = $bdd->prepare("SELECT * FROM user WHERE email = :filtre");
			$request->bindValue(':filtre', $this->email);
			$request->execute();
			$donnees = $request->fetch(PDO::FETCH_ASSOC);
		}
		$this->username = $donnees['username'];
		$this->lastname = $donnees['lastname'];
		$this->firstname = $donnees['firstname'];
		$this->avatar = $donnees['avatar'];
		$this->date_inscription = $donnees['register_date'];
		$this->theme = $donnees['theme'];
		$this->id_user = $donnees['id_user'];
	}

	/*----------------- GETTERS -------------------*/
	public function get_username()
	{
		return $this->username;
	}

	public function get_mail()
	{
		return $this->email;
	}

	public function get_lastname()
	{
		return $this->lastname;
	}

	public function get_firstname()
	{
		return $this->firstname;
	}

	public function get_password()
	{
		return $this->password;
	}

	public function get_date_inscription()
	{
		return $this->date_inscription;
	}

	public function get_avatar()
	{
		return $this->avatar;
	}

	public function get_theme()
	{
		return $this->theme;
	}

	public function get_email_ancien()
	{
		return $this->email_ancien;
	}

	public function get_email_modif()
	{
		return $this->email_modif;
	}

	public function get_id_user()
	{
		return $this->id_user;
	}

	public function get_number_tweet()
	{
		return $this->number_tweets;
	}

	public function get_number_following()
	{
		return $this->number_following;
	}

	public function get_number_follower()
	{
		return $this->number_follower;
	}

	/*----------------- SETTERS -------------------*/
	public function set_pseudo($pseudo)
	{
		$this->pseudo = $pseudo;
	}

	public function set_mail($mail)
	{
		$this->mail = $mail;
	}

	public function set_lastname($lastname)
	{
		$this->lastname = $lastname;
	}

	public function set_firstname($firstname)
	{
		$this->firstname = $firstname;
	}

	public function set_password($password)
	{
		$this->password = $password;
	}

	public function set_date_inscription($date_inscription)
	{
		$this->date_inscription = $date_inscription;
	}

	public function set_avatar($avatar)
	{
		$this->avatar = $avatar;
	}

	public function set_theme($theme)
	{
		$this->theme = $theme;
	}

	public function set_email_ancien($email_ancien)
	{
		$this->email_ancien = $email_ancien;
	}

	public function set_email_modif($email_modif)
	{
		$this->email_modif = $email_modif;
	}

	public function set_id_user($id_user)
	{
		$this->id_user = $id_user;
	}

		public function affichage_avatar($element)
	{
		if($element == null)
		{
			echo '<img src="images/profil.jpg" alt="profil">';
		}
		else
		{
			echo '<img src="' . $element . '" alt="profil">';
		}
	}

	public function search_member()
	{
		$research = $_SESSION['for_search'];
		$request = $this->bdd->prepare("SELECT * FROM user AS u
			WHERE u.username LIKE :username");
		$request->bindValue(':username', "%" . $research . "%");
		$request->execute();
		$donnees = $request->fetchAll(PDO::FETCH_ASSOC);
		return $donnees;
	}

	public function show_following()
	{
		$request = $this->bdd->prepare("SELECT u.username, id_followed FROM follow 
			LEFT JOIN user AS u ON u.id_user = follow.id_followed 
			WHERE follow.status_follow = 1 AND id_follower = :id_user");
		$request->bindValue(':id_user', $this->id_user);
		$request->execute();
		return $request->fetchAll(PDO::FETCH_ASSOC);
		
	}

	public function show_follower()
	{
		$request = $this->bdd->prepare("SELECT u.username, id_follower FROM follow 
			LEFT JOIN user AS u ON u.id_user = follow.id_follower 
			WHERE follow.status_follow = 1 AND id_followed = :id_user");
		$request->bindValue(':id_user', $this->id_user);
		$request->execute();
		return $request->fetchAll(PDO::FETCH_ASSOC);
	}

	public function button_add_follow($element)
	{
		$request = $this->bdd->prepare("INSERT INTO follow (id_followed, id_follower) VALUES (:id_followed, :id_follower)");
		$request->bindValue(':id_followed', $element);
		$request->bindValue(':id_follower', $this->id_user);
		$request->execute();
	}

	public function button_re_add_follow($element)
	{
		$request = $this->bdd->prepare("UPDATE follow SET status_follow = '1' WHERE id_followed = :id_followed AND id_follower = :id_follower");
		$request->bindValue(':id_followed', $element);
		$request->bindValue(':id_follower', $this->id_user);
		$request->execute();
	}

	public function button_supp_follow($element)
	{
		$request = $this->bdd->prepare("UPDATE follow SET status_follow = '0' WHERE id_followed = :id_followed AND id_follower = :id_follower");
		$request->bindValue(':id_followed', $element);
		$request->bindValue(':id_follower', $this->id_user);
		$request->execute();
	}

	public function search_follow($element)
	{
		$request = $this->bdd->prepare("SELECT * FROM follow WHERE id_follower = :id_follower AND id_followed = :id_followed");
		$request->bindValue(':id_followed', $element);
		$request->bindValue(':id_follower', $this->id_user);
		$request->execute();
		return $request->fetchAll();
	}

	public function number_tweets()
	{
		$request = $this->bdd->prepare("SELECT COUNT(id_tweet) as 'count' FROM tweet WHERE id_user = :id_user");
		$request->bindValue(':id_user', $this->id_user);
		$request->execute();
		$donnees = $request->fetch();

		$this->number_tweets = $donnees['count'];
	}

	public function number_following()
	{
		$request = $this->bdd->prepare("SELECT COUNT(id_followed) as 'count' FROM follow WHERE id_follower = :id_user AND status_follow = 1");
		$request->bindValue(':id_user', $this->id_user);
		$request->execute();
		$donnees = $request->fetch();

		$this->number_following = $donnees['count'];
	}

	public function number_follower()
	{
		$request = $this->bdd->prepare("SELECT COUNT(id_follower) as 'count' FROM follow WHERE id_followed = :id_user AND status_follow = 1");
		$request->bindValue(':id_user', $this->id_user);
		$request->execute();
		$donnees = $request->fetch();

		$this->number_follower = $donnees['count'];
	}


}