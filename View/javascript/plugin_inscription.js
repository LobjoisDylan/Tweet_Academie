(function($)
{ 
	$.fn.plugin_inscription=function()
	{
		$('#Submit').click(function(event){
			event.preventDefault();
			$.post(
				'index.php?c=identification&a=verifications',
				{
					username : $('#username').val(),
					lastname : $('#lastname').val(),
					firstname : $('#firstname').val(),
					email : $('#email').val(),
					password : $('#password').val(),
					password_confirm : $('#password_confirm').val(),
				},
				function(data){

					if(data == "OK")
					{
						document.location.href="formulaire_connexion.php";
					}

					if(data == "champ vide")
					{
						$('#affich_error').html('Merci de remplir tous les champs<br/>');
					}

					if(data == "username, mail existant et password non correspondant")
					{
						$('#affich_error').html('Pseudo déjà existant<br/>');
						$('#affich_error').append('Mail déjà existant<br/>');
						$('#affich_error').append('Les mots de passe ne correspondent pas<br/>');
					}

					if(data == "username existant, mail invalide et password non correspondant")
					{
						$('#affich_error').html('Pseudo déjà existant<br/>');
						$('#affich_error').append('Mail invalide<br/>');
						$('#affich_error').append('Les mots de passe ne correspondent pas<br/>');
					}

					if(data == "mail existant et password non correspondant")
					{
						$('#affich_error').html('Mail déjà existant<br/>');
						$('#affich_error').append('Les mots de passe ne correspondent pas<br/>');
					}

					if(data == "mail invalide et password non correspondant")
					{
						$('#affich_error').html('Mail invalide<br/>');
						$('#affich_error').append('Les mots de passe ne correspondent pas<br/>');
					}

					if(data == "username existant et password non correspondant")
					{
						$('#affich_error').html('Pseudo déjà existant<br/>');
						$('#affich_error').append('Les mots de passe ne correspondent pas<br/>');
					}

					if(data == "mail invalide et password non correspondant")
					{
						$('#affich_error').html('Mail invalide<br/>');
						$('#affich_error').append('Les mots de passe ne correspondent pas<br/>');
					}

					if(data == "mail invalide et username existant")
					{
						$('#affich_error').html('Mail invalide<br/>');
						$('#affich_error').append('Pseudo déjà existant<br/>');
					}


					if(data == "mail existant et username existant")
					{
						$('#affich_error').html('Mail invalide<br/>');
						$('#affich_error').append('Pseudo déjà existant<br/>');
					}

					if(data == "username existant")
					{
						$('#affich_error').html('Pseudo déjà existant<br/>');
					}

					if(data == "mail invalide")
					{
						$('#affich_error').html('Mail invalide<br/>');
					}

					if(data == "mail existant")
					{
						$('#affich_error').html('Mail déjà existant<br/>');
					}

					if(data == "password non correspondant")
					{
						$('#affich_error').html('Les mots de passe ne correspondent pas<br/>');
					}
				},
				'text'
				);

});
};
})(jQuery);