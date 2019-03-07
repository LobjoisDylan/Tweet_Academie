(function($)
{ 
	$.fn.plugin_modification_password=function()
	{
		$('#submit_password').click(function(event){

			event.preventDefault();
			$.post(
				'index.php?c=modifier_profil&a=verification_password',
				{
					ancien_password : $('#ancien_password').val(),
					nouveau_password : $('#nouveau_password').val(),
				},
				function(data){

					if(data == "OK")
					{
						$('#affich_error_password').html('Password changé<br/>');
					}

					if(data == "Champ vide")
					{
						$('#affich_error_password').html('Merci de remplir tous les champs<br/>');
					}

					if(data == "Ce n'est pas le bon mot de passe")
					{
						$('#affich_error_password').html('Incorrect password<br/>');
					}
				},
				'text'
				);
		});
	};

})(jQuery);