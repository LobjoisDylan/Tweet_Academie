<?php
	session_start();
?>
<!DOCTYPE html>
<html lang=fr>

<head>
	<title>Projet Web</title>
	<meta name="description" content="Des dernières actualités et des divertissements aux sports et à la politique, accédez à l'histoire complète avec tous les commentaires en direct.">
	<meta name="keywords" content="twitter, hashtag, twitte, retwitte, message, news, actualités, évênements, réseau social, wac, webacademie">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
	<link href="style.css" rel="stylesheet" type="text/css">

</head>

<body>
	<div class="row">
		<div class="container">
			<div class="col-md-6 col-sm-6">
				<div class="img_connexion">
					<div class="img_logo col-md-6 col-sm-6">
						<img src="images/twitter_logo_blanc.png" alt="twitter">
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="identification">
					<div class="col-sm-12 col-md-12">
					<h1>Connexion</h1>
					<form action="index.php" method="post">
						<div class="input-group">
					  	<span class="input-group-addon col-md-1 col-sm-1"><i class="glyphicon glyphicon-envelope"></i></span>
						<input type ="text" class="form-control" id ="mail" name ="mail" placeholder="Votre adresse mail">
						</div>

						<div class="input-group">
					  	<span class="input-group-addon col-md-1 col-sm-1"><i class="glyphicon glyphicon-lock"></i></span>
						<input type ="password" class="form-control" id ="password" name ="password" placeholder="Votre mot de passe">
						</div>

						<button type="submit" class="btn btn-primary col-sm-12 col-md-12">Submit</button>
					</form>
					<a href="formulaire_inscription.php" class="btn btn2 btn-primary col-sm-12 col-md-12">Inscription</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>