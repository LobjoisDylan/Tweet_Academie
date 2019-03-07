<?php
session_start();
if(empty($_SESSION)):
	header('Location: formulaire_connexion.php');
	exit;
endif;

include('../Model/classe_tweet.php');
include('parser.php');
$user = new member("");
$_SESSION['my_id'] = $user->get_id_user();
$tweets = new tweetAction();
$tendances = $tweets->tendance_tweet();

include('../Model/classe_suggestion.php');
$suggestion = new suggestions();
$sugg = $suggestion->suggestion();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8"/>
	<title>Twitter</title>
	<meta name="description" content="Des dernières actualités et des divertissements aux sports et à la politique, accédez à l'histoire complète avec tous les commentaires en direct.">
	<META HTTP-EQUIV="Refresh" CONTENT="60; URL=accueil.php">
	<meta name="keywords" content="twitter, hashtag, twitte, retwitte, message, news, actualités, évênements, réseau social, wac, webacademie">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
	<link href="css/header.css" rel="stylesheet" type="text/css">
	<link href="css/accueil.css" rel="stylesheet" type="text/css">
	<link href="css/modal.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header>
		<?php include('header.php'); ?>
	</header>

	<div class="container accueil">
		<div class="row">
			<div class="col-sm-12 col-md-3 col-lg-3">
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
						</div>
						<div class="block_profil_accueil">
							<div class="col-sm-4 col-md-4 col-lg-4">
								<a href="profil.php">Tweets</a>
								<div class="number_profils">
									<h2 class="number"><?= $user->get_number_tweet(); ?></h2>
								</div>
							</div>
							<div class="col-sm-4 col-md-4 col-lg-4">
								<a class="a_abonnements" href="following.php">Abonnements</a>
								<div class="number_profils">
									<h2 class="number number_abo"><?= $user->get_number_following(); ?></h2>
								</div>
							</div>
							<div class="col-sm-4 col-md-4 col-lg-4">
								<a href="followers.php">Abonnés</a>
								<div class="number_profils">
									<h2 class="number"><?= $user->get_number_follower(); ?></h2>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12 col-md-3 col-lg-3">
						<div class="row">
							<div class="tendances">
								<div class="header_tendances">
									<h2 class="col-sm-12 col-md-12 col-lg-12">Tendances pour vous</h2>
								</div>

								<div class="hashtag_tendances_block">
									<?php foreach($tendances as $tendance): 
										?>
										<h3 class="hashtag_tendances"><?= parser_hashtag($tendance['name_hashtag']); ?> </h3>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-6 logo">
				<div class="accueil_tweet">
					<div class="your_tweet">
						<div class="your_tweet_img">
							<img src="images/profil.jpg" alt="profil">
						</div>
						<form action="index.php?c=tweet&a=add_new_tweet" method="post">
							<input class="form_tweet" type="text" name="send_tweet" id="send_tweet">
							<span class="glyphicon glyphicon-picture picture"></span>
							<input class="submit" type="submit" name="submit" id="submit" value="Tweeter">
						</form>
					</div>
				</div>
				<div class="wall_tweet">
					<?php 
					
					$donnees = $tweets->default_search_tweet();
					$i = 0;
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

							<div class="post_tweet">
								<p><?= parser_tweet($info['content_tweet']); ?></p>
							</div>
							<div class="post_tweet retweet">
								<span class="glyphicon glyphicon-comment comment">
									<input class="value_tweet<?= $i; ?>" type="hidden" value="<?= $info['id_tweet'];?>"/>
								</span> 
								<span class="count_comment" id="comment_<?= $i; ?>"><?= $tweets->count_comment_tweet($info['id_tweet']); ?></span>
								<span class="glyphicon glyphicon-retweet"></span>
								<span ><?= $tweets->count_retweet($info['id_tweet']); ?></span>
								<span class="glyphicon glyphicon-heart"></span>
								<span class="glyphicon glyphicon-envelope"></span>
								<input class="value_tweet" type="hidden" value="<?= $info['id_tweet'];?>"/>
							</div>
						</div>
						<?php
						$i++;
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


	<div id="myModal" class="modal">
		<span class="close">&times;</span>
		<div class="modal-content">
			<div id="tweet_to_comment">
			</div>
			<div class="your_tweet">
				<div class="your_tweet_img">
					<img src="images/profil.jpg" alt="profil">
				</div>
				<form  method="post" id="form_comment">
					<input class="form_tweet" type="text" name="send_tweet" id="send_tweet">
					<input type="hidden" id="value_hidden">
					<span class="glyphicon glyphicon-picture picture"></span>
					<input class="submit" type="submit" name="submit" id="submit_comment" value="Tweeter">
				</form>
			</div>
		</div>
	</div>

	<script src="javascript/jquery.js"></script>
	<script src="javascript/menu.js"></script>
	<script src="javascript/search_twitter.js"></script>
	<script src="javascript/comment_tweet.js"></script>
	<script src="javascript/plugin_retweet.js"></script>

</body>
</html>