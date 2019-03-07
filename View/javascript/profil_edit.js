$(document).ready(function(){
var table = document.getElementsByClassName("carre");

	var i = 0;
	for(i; i < table.length; i +=1)
	{
		var element = table[i];
		var number = i;
		$(table[i]).click(function(event){
			var element = this;;
			$.post(
				'index.php?c=theme&a=change_theme&color=' + $(element).attr("value"),
				{

				},
				function(data){
					if(data == "ok")
					{
						document.reload();
					}
				},
				'text'
				);
		})
	}

	$('#submit_change').click(function(event){
		var x = document.getElementById("profil_edit");
		if(x.style.display === "block"){
			x.style.display = "none";
		} 
		else {
			x.style.display = "block";
		}
	});
});