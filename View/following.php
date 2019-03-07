<?php
session_start();
if(empty($_SESSION)):
	header('Location: formulaire_connexion.php');
	exit;
endif;
include('../Model/classe_member.php');
if(isset($_GET['p']))
{
	$user = new member($_GET['p']);
}
if(!isset($_GET['p']))
{
	$user = new member("");	
}
$donnees = $user->show_following();
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
	<link href="css/following.css" rel="stylesheet" type="text/css">
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
				<div class="row">
					<div class="col-sm-12 col-md-3 col-lg-3">
						<div id="profil_edit">
							<h3 class="h3_edit">Changer le thème</h3>
							<div class="block_carre">
								<div class="carre" id="blue"></div>
								<div class="carre" id="pink"></div>
								<div class="carre" id="green"></div>
								<div class="carre" id="yellow"></div>
								<div class="carre" id="orange"></div>
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
					<div class="col-sm-12 col-md-9 col-lg-9">
						<?php 
						$i = 0;
						foreach($donnees as $donnee): 
							$_SESSION['for_followed' . $i] = $donnee['id_followed'];
							?>
							<div class="col-sm-12 col-md-4 col-lg-4">
								<div class="row">
									<div class="profil_following">
										<div class="block_following">
											<img src="images/smoke.jpg" alt="image de fond">
										</div>
										<div class="img_following">
											<img src="images/profil.jpg" alt="profil">
										</div>
										<div class="pseudo">
											<h1 class="h1_following"><a href="profil.php?p=<?= $donnee['username']; ?>"><?= $donnee['username']; ?></a></h1>
										</div>
										<div class="block_profil_following">
											<div class="follow">
												<button type="button" class="follow_a" id="follow_a<?php echo $i; ?>" value="<?= $_SESSION['for_followed' . $i]; ?>">Unfollow</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php 
							$i++;
						endforeach; ?>
						<div class="col-sm-12 col-md-4 col-lg-4">
							<div class="row">
								<div class="header_tendances">
									<h2 class="col-sm-12 col-md-12 col-lg-12">Suggestions</h2>
								</div>
								<div class="suggestions">
									<div class="suggestions_block">
										<?php foreach($sugg as $value): ?>
											<h3 class="hashtag_tendances"><?= $value['username']; ?></h3>
										<?php endforeach; ?>									</div>
								</div>
							</div>
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
	</div>
	<script src="javascript/jquery.js"></script>
	<script src="javascript/menu.js"></script>
	<script src="javascript/search_twitter.js"></script>
	<script src="javascript/profil_edit.js"></script>
	<script src="javascript/follow.js"></script>
</body>
</html>