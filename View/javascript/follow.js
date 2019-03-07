$(document).ready(function(){
	var table = document.getElementsByClassName("follow_a");
	var i = 0;
	for(i; i < table.length; i +=1)
	{
		var element = table[i];
		var number = i;
		$(table[i]).click(function(event){
			var element = this;
			$.post(
				'index.php?c=follow&a=what_do&t=' + $(element).val(),
				{

				},
				function(data){
					if(data == "follow")
					{
						$(element).html('Unfollow');
					}
					if(data == "unfollow")
					{
						$(element).html('Follow');
					}
				},
				'text'
				);
		})
	}
});
