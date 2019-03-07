
<!DOCTYPE html>
<html lang=fr>

<head>
	<meta charset="utf-8"/>
	<title>Projet Web</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet" type="text/css">

</head>

<body>
	<div class="row">
		<div class="container">
			<div class="col-md-6 col-sm-6">
				<div class="img">
					<div class="img_logo col-md-6 col-sm-6">
						<div class="img_block">
							<img src="images/abstract.jpg" alt="bulle">
							<img id="logo_twitter" src="images/twitter_logo_blanc.png" alt="twitter">
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 col-sm-6">
				<div class="identification">
					<div class="col-sm-12 col-md-12">
						<h1>Inscription</h1>
						<form action="formulaire_inscription.php" method="post">
							<div class="input-group">
								<span class="input-group-addon col-md-1 col-sm-1"><i class="glyphicon glyphicon-user"></i></span>
								<input type ="text" class="form-control" id ="username" name ="username" placeholder="Pseudo">
								<div id="result_username"></div>
							</div>

							<div class="input-group col-sm-12 col-md-12">
								<span class="input-group-addon col-md-1 col-sm-1"><i class="glyphicon glyphicon-user"></i></span>
								<input type ="text" class="form-control" id ="lastname" name ="lastname" placeholder="Lastname">
								<div id="result_lastname"></div>
							
								<span class="input-group-addon col-md-1 col-sm-1"><i class="glyphicon glyphicon-user"></i></span>
								<input type ="text" class="form-control" id ="firstname" name="firstname" placeholder="Firstname">
								<div id="result_firstname"></div>
							</div>

							<div class="input-group">
								<span class="input-group-addon col-md-1 col-sm-1"><i class="glyphicon glyphicon-envelope"></i></span>
								<input type ="text" class="form-control" id ="email" name ="email" placeholder="Votre adresse mail">
								<div id="result_email"></div>
							</div>

							<div class="input-group">
								<span class="input-group-addon col-md-1 col-sm-1"><i class="glyphicon glyphicon-lock"></i></span>
								<input type ="password" class="form-control" id ="password" name ="password" placeholder="Votre mot de passe">
								<div id="result_password"></div>
							</div>

							<div class="input-group">
								<span class="input-group-addon col-md-1 col-sm-1"><i class="glyphicon glyphicon-lock"></i></span>
								<input type ="password" class="form-control" id ="password_confirm" name ="password_confirm" placeholder="Retapez votre mot de passe">
								<div id="result_password_confirm"></div>
							</div>
							
							<div id="affich_error"></div>

							<button type="submit" class="btn btn-primary col-sm-12 col-md-12 sub_insc" id="Submit">Submit</button>
						</form>
						<a href="formulaire_connexion.php" class="btn btn-primary col-sm-12 col-md-12">Connexion</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="javascript/jquery.js"></script>
	<script src="javascript/plugin_inscription.js"></script>
	<script>
		$(document).ready(function(){
			$(function(){
				$('#Submit').plugin_inscription();
			});
		});
	</script>
</body>
</html>