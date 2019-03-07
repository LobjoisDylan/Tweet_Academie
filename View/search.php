<?php
session_start();
if(empty($_SESSION)):
	header('Location: formulaire_connexion.php');
	exit;
endif;
include('../Model/classe_tweet.php');
include('parser.php');

$other_member = new member($_SESSION['for_search']);
$user = new member("");

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
	<meta name="keywords" content="twitter, hashtag, twitte, retwitte, message, news, actualités, évênements, réseau social, wac, webacademie">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
	<link href="css/header.css" rel="stylesheet" type="text/css">
	<link href="css/search.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header>
		<?php include('header.php'); ?>
	</header>

	<div class="container accueil">
		<div class="row">
			<div class="col-sm-12 col-md-3 col-lg-3">
				<?php
				$donnees_members = $other_member->search_member();
				$i = 0;
				foreach($donnees_members as $value)
				{
					$_SESSION['for_followed'. $i] = $value['id_user'];
					?>
					<div class="row">
						<div class="profil_accueil">
							<div class="block">
								<img src="images/smoke.jpg" alt="image de fond">
							</div>
							<div class="img_profil">
								<img src="images/profil.jpg" alt="profil">
							</div>
							<div class="pseudo">
								<h1><a href="profil.php?p=<?= $value['username']; ?>"><?php echo $value['username'];  ?></a></h1>

							</div>
							<div class="block_profil_accueil">
								<div class="follow">
									<button type="button" class="follow_a" id="follow_a<?php echo $i; ?>" value="<?= $_SESSION['for_followed' . $i]; ?>">Follow</button>
								</div>
							</div>
						</div>
					</div>
					<?php
				$i++;
				}
				?>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-6 logo">
				<div class="wall_tweet">
					<?php 
					if(isset($_GET['search']))
					{
						$donnees = $tweets->search_tweet_by_tag_get($_GET['search']);
					}
					if(!isset($_GET['search']))
					{
						$donnees = $tweets->search_in_twitter();
					}
					foreach($donnees as $info)
					{
						?>
						<div class="your_tweeter">
							<?php
							?>
							<div class="your_tweeter_img">
								<?php $user->affichage_avatar($info['avatar']); ?>
							</div>
							<div class="informations">
								<h3><a href="profil.php?p=<?= $info['username']; ?>"><?= $info['username']; ?></a></h3>
								<h4><?php $tweets->affichage_date_tweet($info['date_tweet']); ?></h4>
							</div>

							<div class="post_tweet">
								<p><?php parser_tweet($info['content_tweet']); ?></p>
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

				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="row">
						<div class="tendances">
							<div class="header_tendances">
								<h2 class="col-sm-12 col-md-12 col-lg-12">Tendances pour vous</h2>
							</div>

							<div class="hashtag_tendances_block">
								<?php foreach($tendances as $tendance): ?>
									<h3 class="hashtag_tendances"><?php parser_hashtag($tendance['name_hashtag']); ?></h3>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12 col-md-12 col-lg-12">
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
	<script src="javascript/jquery.js"></script>
	<script src="javascript/menu.js"></script>
	<script src="javascript/follow.js"></script>
	<script src="javascript/search_twitter.js"></script>
</body>
</html>