<!DOCTYPE html>
<html lang=fr>

<head>
	<title>Projet Web</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet" type="text/css">

</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				
			</div>
			<div class="col-md-5">
				<div class="identification">
					<form action="index.php" method="post">
						<p>
							<input type ="text" class="form-control" id ="pseudo" name ="pseudo" placeholder="Pseudo"> 
							<input type ="text" class="form-control" id ="mail" name ="mail" placeholder="Votre adresse mail">
							<input type ="password" class="form-control" id ="password" name ="password" placeholder="Votre mot de passe">
							<input type ="password" class="form-control" id ="re_password" name ="re_password" placeholder="Retapez votre mot de passe">
							<button type="submit" class="btn btn-primary">Submit</button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>