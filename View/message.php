<?php
session_start();
if(empty($_SESSION)):
	header('Location: formulaire_connexion.php');
	exit;
endif;

include('../Model/classe_message.php');
$message = new message("");
$username = $message->catch_name();
$message->add_message();
$catch = $message->catch_message();
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
	<link href="css/message.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header>
		<?php include('header.php'); ?>
	</header>

	<div class="container accueil">
		<div class="row">
			<div class="col-sm-12 col-md-3 col-lg-3">
				<div class="conversations">
					<h1>Parler avec</h1>

					<form class="form_convers" action="message.php" method="post">
						<label for="word_name">Nom</label>
						<input class="form_convers_input" type="text" name="word_name" id="word_name">
						<input class="messagie-submit" type="submit" name="submit">
					</form>
				</div>
			</div>

			<div class="col-sm-12 col-md-8 col-lg-8">
				<div class="container-messagerie">
					<div class="entete">
						<h2><?= $username['username']; ?></h2>
					</div>
					<div class="contents">
						<div class="content-message">
							<?php foreach($catch as $values): ?>
							<div class="content_message_all">
								<p class="content_message_p"><?= $values['username']." : ". $values['content_message']; ?></p>
							</div>
						<?php endforeach;?>
						</div>

					</div>
					<div class="text">
						<form class="form_messagerie" action="message.php" method="post">
							<input class="messagerie_input" type="text" name="conversation">
							<button class="picture">
								<span class="glyphicon glyphicon-picture"></span>
							</button>
							<input class="messagie-submit" type="submit" name="submit" value="envoyer">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="javascript/jquery.js"></script>
	<script src="javascript/menu.js"></script>
	<script src="javascript/search_twitter.js"></script>
</body>
</html>