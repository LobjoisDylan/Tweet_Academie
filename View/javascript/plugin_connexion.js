(function($)
{ 
	$.fn.plugin_connexion=function()
	{
		$('#Connexion').click(function(event){
			event.preventDefault();
			$.post(
				'index.php?c=connexion&a=verifications',
				{
					email : $('#email').val(),
					password : $('#password').val(),
				},
				function(data){

					if(data == 'OK') {
						document.location.href="accueil.php";
					}

					if(data == "champ vide")
					{
						$('#affich_error').html('Merci de remplir tous les champs');
					}

					if(data == "infos incorrectes")
					{
						$('#affich_error').html('Infos incorrectes');
					}
					if(data == "mail inconnu")
					{
						$('#affich_error').html('Mail non reconnu ou invalide');
					}

					if(data == "password incorrect")
					{
						$('#affich_error').html('Mot de passe incorrect');
					}
				},
				'text'
				);
		});
	};
})(jQuery);