<?php
session_start();
if(empty($_SESSION)):
	header('Location: formulaire_connexion.php');
	exit;
endif;
include('../Model/classe_tweet.php');
include('parser.php');
if(isset($_GET['p']))
{
	$user = new member($_GET['p']);
}
if(!isset($_GET['p']))
{
	$user = new member("");
}

include('../Model/classe_suggestion.php');
$suggestion = new suggestions();
$sugg = $suggestion->suggestion();
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
	<link href="css/profil.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header>
		<?php include('header.php'); ?>
	</header>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="row">
				<div class="profil_accueil">
					<div class="block">
						<img src="images/smoke.jpg" alt="image de fond">
					</div>
					<div class="img_profil">
						<img src="images/profil.jpg" alt="profil">
					</div>
					<div class="pseudo">
						<h1><?php echo $user->get_username(); ?></h1>
						<p class="registrer">Inscrit en <?php 
						$date_inscription = date_create($user->get_date_inscription());
						echo date_format($date_inscription, "F Y"); ?></p>
					</div>

					<div class="container">
						<div class="col-sm-4 col-md-4 col-lg-4">
							<?php 
							if($user->get_id_user() == $_SESSION['my_id'])
							{
								?>
								<div class="edit">
									<button class="edit_a" id="submit_change">Editer le profil</button>
								</div>
								<?php
							}
							if($user->get_id_user() != $_SESSION['my_id'])
							{
								?>
								<div class="follow">
									<button type="button" class="follow_a" id="follow_a0" value="<?= $user->get_id_user(); ?>">Follow</button>
								</div>
								<?php
							}
							?>
						</div>
						<div class="col-sm-4 col-md-4 col-lg-4">
							<div class="block_profil_accueil">
								<div class="col-sm-4 col-md-4 col-lg-4">
									<?php
									if(isset($_GET['p']))
									{
										?>
										<a href="profil.php?p=<?= $user->get_username(); ?>">Tweets</a>
										<?php
									}
									if(!isset($_GET['p']))
									{
										?>
										<a href="profil.php">Tweets</a>
										<?php
									}
									?>
									<div class="number_profils">
										<h2 class="number"><?= $user->get_number_tweet(); ?></h2>
									</div>
								</div>
								<div class="col-sm-4 col-md-4 col-lg-4">
									<?php
									if(isset($_GET['p']))
									{
										?>
										<a class="a_abonnements" href="following.php?p=<?= $user->get_username(); ?>">Abonnements</a>
										<?php
									}
									if(!isset($_GET['p']))
									{
										?>
										<a class="a_abonnements" href="following.php">Abonnements</a>
										<?php
									}
									?>
									<div class="number_profils">
										<h2 class="number number_abo"><?= $user->get_number_following(); ?></h2>
									</div>
								</div>
								<div class="col-sm-4 col-md-4 col-lg-4">
									<?php
									if(isset($_GET['p']))
									{
										?>
										<a href="followers.php?p=<?= $user->get_username(); ?>">Abonnés</a>
										<?php
									}
									if(!isset($_GET['p']))
									{
										?>
										<a href="followers.php">Abonnés</a>
										<?php
									}
									?>
									<div class="number_profils">
										<h2 class="number"><?= $user->get_number_follower(); ?></h2>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-4 col-md-4 col-lg-4"></div>
					</div>
				</div>
			</div>
			<div class="container accueil">
				<div class="col-sm-12 col-md-3 col-lg-3">
					<div id="profil_edit">
						<h3 class="h3_edit">Changer le thème</h3>
						<div class="block_carre">
							<button class="carre" id="blue" value="29, 161, 242"></button>
							<button class="carre" id="pink" value="252, 79, 109"></button>
							<button class="carre" id="green" value="59, 230, 59"></button>
							<button class="carre" id="yellow" value="252, 252, 60"></button>
							<button class="carre" id="orange" value="255, 177, 35"></button>
						</div>
						<h3 class="h3_edit">Changer la photo de profil</h3>
						<form class="form_edit" method="post">
							<input class="input_edit" type="file" name="file">
							<h3 class="h3_edit">Changer la photo de bannière</h3>
							<input class="input_edit" type="file" name="file">
							<input class="edit_submit" type="submit" name="submit" value="Enregistrer les modifications">
						</form>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6 logo">
					<div class="accueil_tweet">
						<div class="your_tweet">
							<div class="your_tweet_img">
								<img src="images/profil.jpg" alt="profil">
							</div>
							<form action="#" method="post">
								<input class="form_tweet" type="text" name="tweet">
								<span class="glyphicon glyphicon-picture picture"></span>
								<input class="submit" type="submit" name="submit" id="submit" value="Tweeter">
							</form>
						</div>
					</div>
					<div class="wall_tweet">
						<?php 
						$tweets = new tweetAction();
						if(isset($_GET['p']))
						{
							$donnees = $tweets->profil_search_tweet($_GET['p']);
						}
						if(!isset($_GET['p']))
						{
							$donnees = $tweets->profil_search_tweet("");
						}
						foreach($donnees as $info)
						{
							?>
							<div class="your_tweeter">
								<div class="your_tweeter_img">
									<?php $user->affichage_avatar($info['avatar']); ?>
								</div>
								<div class="informations">
									<h3><a href="profil.php?p=<?= $info['username']; ?>"><?= $info['username']; ?></a></h3>
									<h4><?php $tweets->affichage_date_tweet($info['date_tweet']); ?></h4>
								</div>
								<span class="glyphicon glyphicon-option-vertical"></span>

								<div class="post_tweet">
									<p><?= parser_tweet($info['content_tweet']); ?></p>
								</div>
								<div class="post_tweet retweet">
									<span class="glyphicon glyphicon-comment comment"></span>
									<span class="glyphicon glyphicon-retweet"></span>
									<span class="glyphicon glyphicon-heart"></span>
									<span class="glyphicon glyphicon-envelope"></span>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
				<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="header_tendances">
						<h2 class="col-sm-12 col-md-12 col-lg-12">Suggestions</h2>
					</div>
					<div class="suggestions">
						<div class="suggestions_block">
							<?php foreach($sugg as $value): ?>
								<h3 class="hashtag_tendances"><?= $value['username']; ?></h3>
							<?php endforeach; ?>
						</div>
					</div>

					<div class="col-sm-12 col-md-3 col-lg-3">
						<div class="row">
							<div class="footer">
								<footer>
									<?php include('footer.php'); ?>
								</footer>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="javascript/jquery.js"></script>
	<script src="javascript/search_twitter.js"></script>
	<script src="javascript/menu.js"></script>
	<script src="javascript/profil_edit.js"></script>
	<script src="javascript/comment_tweet.js"></script>
</body>
</html>