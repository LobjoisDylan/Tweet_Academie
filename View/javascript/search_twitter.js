$(document).ready(function(){
	$('#search').keydown(function(event){
		if (event.keyCode == 13) {
			$.post(
				'index.php?c=tweet&a=redirection',
				{
					search : $('#search').val()
				},
				function(data){
					if(data == "ok")
					{
						document.location.href="search.php";
					}
				},
				'text'
				);
		}
	});
});
