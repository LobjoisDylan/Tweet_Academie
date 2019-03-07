<?php
session_start();
if(empty($_SESSION)):
	header('Location: formulaire_connexion.php');
	exit;
endif;
include('../Model/classe_member.php');
$user = new member("");
$_SESSION['my_id'] = $user->get_id_user();
$_SESSION['id_tweet'] = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8"/>
	<title>Twitter</title>
	<meta name="description" content="Des dernières actualités et des divertissements aux sports et à la politique, accédez à l'histoire complète avec tous les commentaires en direct.">
	<meta name="keywords" content="twitter, hashtag, twitte, retwitte, message, news, actualités, évênements, réseau social, wac, webacademie">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
	<link href="css/header.css" rel="stylesheet" type="text/css">
	<link href="css/accueil.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div class="your_tweet">
		<div class="your_tweet_img">
			<img src="images/profil.jpg" alt="profil">
		</div>
		<form action="index.php?c=tweet&a=add_answer_tweet" method="post">
			<input class="form_tweet" type="text" name="send_tweet" id="send_tweet">
			<span class="glyphicon glyphicon-picture picture"></span>
			<input class="submit" type="submit" name="submit" id="submit" value="Tweeter">
		</form>
	</div>
	<script src="javascript/jquery.js"></script>
	<script src="javascript/comment_tweet.js"></script>
</body>
</html>