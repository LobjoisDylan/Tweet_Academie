(function($)
{ 
	$.fn.plugin_modification_username=function()
	{
		$('#submit_username').click(function(event){

			event.preventDefault();
			$.post(
				'index.php?c=modifier_profil&a=verification_username',
				{
					ancien_username : $('#ancien_username').val(),
					nouveau_username : $('#nouveau_username').val(),
				},
				function(data){

					if(data == "OK")
					{
						$('#affich_error_username').html('Username changé<br/>');
					}

					if(data == "Champ vide")
					{
						$('#affich_error_username').html('Merci de remplir tous les champs<br/>');
					}

					if(data == "L'username existe déjà")
					{
						$('#affich_error_username').html('Username existant<br/>');
					}

					if(data == "Ce n'est pas le bon username")
					{
						$('#affich_error_username').html('Mauvais Username<br/>');
					}
				},
				'text'
				);
		});
	};
})(jQuery)