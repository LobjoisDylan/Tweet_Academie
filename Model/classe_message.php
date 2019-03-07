<?php
include('../Model/classe_member.php');
class message
{
	public $id_user;
	public $id_receiver;
	public $content_message;
	public $research;
	public $email;

	public function __construct($element)
	{
		$this->bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=utf8', 'root', '');
		$user = new member("");
		$this->email = $_SESSION['email'];
		$this->id_user = $user->get_id_user();
		$this->donnees($element);
	}

	public function donnees($element)
	{
		if($element != "")
		{
			$filtre = 'username = :filtre';
			$filtre_assoc = $element;
		}

		if($element == "")
		{
			$filtre = 'email = :filtre';
			$filtre_assoc = $this->email;
		}

		$request = $this->bdd->prepare("SELECT * FROM user WHERE $filtre");
		$request->bindValue(':filtre', $filtre_assoc);
		$request->execute();
		$donnees = $request->fetch(PDO::FETCH_ASSOC);

		$this->username = $donnees['username'];
		$this->avatar = $donnees['avatar'];
		$this->date_inscription = $donnees['register_date'];
		$this->theme = $donnees['theme'];
		$this->id_user = $donnees['id_user'];

		if(isset($_POST['conversation']))
		{
			$this->content_message = $_POST['conversation'];
		}
	}

	// GETTERS

	public function get_mail()
	{
		return $this->email;
	}

	public function get_id_receiver()
	{
		return $this->get_id_receiver;
	}

	public function get_content_message()
	{
		return $this->get_content_message;
	}

	// SETTERS

	public function set_mail($mail)
	{
		$this->mail = $mail;
	}

	public function set_id_receiver($id_receiver)
	{
		$this->id_receiver = $id_receiver;
	}

	public function set_content_message($content_message)
	{
		$this->content_message = $content_message;
	}


	public function catch_name()
	{
		if(isset($_POST['word_name']))
		{
			$this->research = $_POST['word_name'];
			$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
			$request = $bdd->prepare("SELECT id_user, username FROM user WHERE username LIKE :word_name");
			$request->bindValue(':word_name', $this->research);
			$request->execute();
			$donnees = $request->fetch();
			$_SESSION['id_receiver'] = $donnees['id_user'];
			$_SESSION['username'] = $donnees['username'];
			return $donnees;
		}
		elseif(isset($_POST['conversation']) AND isset($_SESSION['username']))
		{
			$this->research = $_SESSION['username'];
			$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
			$request = $bdd->prepare("SELECT id_user, username FROM user WHERE username LIKE :word_name");
			$request->bindValue(':word_name', $this->research);
			$request->execute();
			$donnees = $request->fetch();
			return $donnees;
		}
	}

	public function add_message()
	{
		if(empty($_POST['conversation']))
		{
			return null;
		}
		else{
			$id_receiver = $_SESSION['id_receiver'];
		}
		if(isset($_POST['conversation']) AND isset($id_receiver))
		{
			$this->content_message = $_POST['conversation'];
			$bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=UTF8', 'root', '');
			$request = $bdd->prepare("INSERT INTO message(id_sender, id_receiver, content_message) VALUES (:id_user, :id_receiver, :content_message)");
			$request->bindValue(':id_user', $this->id_user);
			$request->bindValue(':id_receiver', $id_receiver);
			$request->bindValue(':content_message', $this->content_message);
			$request->execute();
		}
		else
		{
			return null;
		}
	}

	public function catch_message()
	{
		if(isset($_POST['word_name']))
		{
			$id_receiver = $_SESSION['id_receiver'];
			$bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=UTF8', 'root', '');
			$request = $bdd->prepare("SELECT user.username, content_message, date_message FROM message LEFT JOIN user ON user.id_user = message.id_sender WHERE message.id_sender = :id_user AND message.id_receiver = :id_receiver OR message.id_receiver = :id_user AND message.id_sender = :id_receiver ORDER BY date_message ASC");
			$request->bindValue(':id_user', $this->id_user);
			$request->bindValue(':id_receiver', $id_receiver);
			$request->execute();
			$donnees = $request->fetchAll();

			return $donnees;
		}
		else if(isset($_POST['conversation']) AND isset($_SESSION['id_receiver']))
		{
			$id_receiver = $_SESSION['id_receiver'];
			$bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=UTF8', 'root', '');
			$request = $bdd->prepare("SELECT user.username, content_message, date_message FROM message LEFT JOIN user ON user.id_user = message.id_sender WHERE message.id_sender = :id_user AND message.id_receiver = :id_receiver OR message.id_receiver = :id_user AND message.id_sender = :id_receiver ORDER BY date_message ASC");
			$request->bindValue(':id_user', $this->id_user);
			$request->bindValue(':id_receiver', $id_receiver);
			$request->execute();
			$donnees = $request->fetchAll();
			return $donnees;
		}
		else if(!isset($_POST['word_name']))
		{
			$donnees = [];
			return $donnees;
		}
	}
}