<?php
session_start();
if(empty($_SESSION)):
	header('Location: formulaire_connexion.php');
	exit;
endif;
include('../Model/classe_member.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Twitter</title>
	<meta charset="utf-8">
	<meta name="description" content="Des dernières actualités et des divertissements aux sports et à la politique, accédez à l'histoire complète avec tous les commentaires en direct.">
	<meta name="keywords" content="twitter, hashtag, twitte, retwitte, message, news, actualités, évênements, réseau social, wac, webacademie">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
	<link href="css/header.css" rel="stylesheet" type="text/css">
	<link href="css/accueil.css" rel="stylesheet" type="text/css">
	<link href="css/parameter.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header>
		<?php include('header.php'); ?>
	</header>
	<div class="row">
		<div class="container-fluid">
			<div class="container">
				<article class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="border">
						<h2>Username</h2>
						<form action="parameter.php" method="post">
							<div class="row">
								<div class="mb-4">
									<input type ="text" class="form-control" id ="ancien_username" name ="ancien_username" placeholder="Ancien username">
								</div>
							</div>

							<div class="row">
								<div class="mb-4">
									<input type ="text" class="form-control" id ="nouveau_username" name ="nouveau_username" placeholder="Nouveau username">
								</div>
							</div>

							<div class="row">
								<div class="mb-4">
									<input type ="submit" class="form-control" id ="submit_username" name ="submit_username">
								</div>
								<div class="blanc">
									<div id="affich_error_username"></div>
								</div>
							</div>
						</form>
					</div>
				</article>

				<article class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="border">
						<h2>Email</h2>
						<form action="parameter.php" method="post">
							<div class="row">
								<div class="mb-4">
									<input type ="text" class="form-control" id ="ancien_email" name ="ancien_email" placeholder="Ancien email">
								</div>
							</div>

							<div class="row">
								<div class="mb-4">
									<input type ="text" class="form-control" id ="nouvelle_email" name ="nouvelle_email" placeholder="Nouvelle email">
								</div>
							</div>

							<div class="row">
								<div class="mb-4">
									<input type ="submit" class="form-control" id ="submit_email" name ="submit_email">
								</div>
								<div class="blanc">
									<div id="affich_error_email"></div>
								</div>
							</div>
						</form>
					</div>
				</article>

				<article class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="border">
						<h2>Password</h2>
						<form action="parameter.php" method="post">
							<div class="row">
								<div class="mb-4">
									<input type ="password" class="form-control" id ="ancien_password" name ="ancien_password" placeholder="Ancien mot de passe">
								</div>
							</div>

							<div class="row">
								<div class="mb-4">
									<input type ="password" class="form-control" id ="nouveau_password" name ="nouveau_password" placeholder="Nouveau mot de passe">
								</div>
							</div>

							<div class="row">
								<div class="mb-4">
									<input type ="submit" class="form-control" id ="submit_password" name ="submit_password">
								</div>
								<div class="blanc">
									<div id="affich_error_password"></div>
								</div>
							</div>
						</form>
					</div>
				</article>
			</div>
		</div>
	</div>

	<div class="footer">
		<footer>
			<?php include('footer.php'); ?>
		</footer>
	</div>

	<script src="javascript/jquery.js"></script>
	<script src="javascript/menu.js"></script>
	<script src="javascript/search_twitter.js"></script>
	<script src="javascript/plugin_modification_email.js"></script>
	<script>
		$(document).ready(function(){
			$(function(){
				$('#submit_email').plugin_modification_email();
			});
		});
	</script>

	<script src="javascript/plugin_modification_username.js"></script>
	<script>
		$(document).ready(function(){
			$(function(){
				$('#submit_username').plugin_modification_username();
			});
		});
	</script>

	<script src="javascript/plugin_modification_password.js"></script>
	<script>
		$(document).ready(function(){
			$(function(){
				$('#submit_password').plugin_modification_password();
			});
		});
	</script>
</body>
</html>