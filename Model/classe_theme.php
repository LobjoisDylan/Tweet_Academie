<?php

include('../Model/classe_member.php');

class themeAction
{
	public $user;
	public $bdd;

	public function __construct()
	{
		$this->user = new member("");
		$this->bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=utf8', 'root', '');
	}

	public function search_color()
	{
		$request = $this->bdd->prepare("SELECT theme FROM user WHERE email = :email");
		$request->bindValue(':email', $_SESSION['email']);
		$request->execute();
		$donnees = $request->fetch(PDO::FETCH_ASSOC);
		return $donnees['theme'];
	}

	public function replace_color()
	{
		$request = $this->bdd->prepare("UPDATE user SET theme = :theme WHERE email = :email");
		$request->bindValue(':theme', $_GET['color']);
		$request->bindValue(':email', $_SESSION['email']);
		$request->execute();
	}
}