(function($)
{ 
	$.fn.plugin_modification_email=function()
	{
		$('#submit_email').click(function(event){

			event.preventDefault();
			$.post(
				'index.php?c=modifier_profil&a=verification_email',
				{
					ancien_email : $('#ancien_email').val(),
					nouvelle_email : $('#nouvelle_email').val(),
				},
				function(data){

					if(data == "OK")
					{
						$('#affich_error_email').html('Mail changé<br/>');
					}

					if(data == "Champ vide")
					{
						$('#affich_error_email').html('Merci de remplir tous les champs<br/>');
					}

					if(data == "Le mail existe et n'est pas valide")
					{
						$('#affich_error_email').html('Mail existant et pas correct<br/>');
					}

					if(data == "Le mail existe")
					{
						$('#affich_error_email').html('Mail existant<br/>');
					}

					if(data == "Le mail n'est pas valide")
					{
						$('#affich_error_email').html('Mail incorrect<br/>');
					}
				},
				'text'
				);
		});
	};
})(jQuery);