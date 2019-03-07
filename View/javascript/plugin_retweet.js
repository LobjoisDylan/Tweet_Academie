$(document).ready(function(){
	var table = document.getElementsByClassName("glyphicon glyphicon-retweet");
	var i = 0;
	for(i; i < table.length; i +=1)
	{
		var element = table[i];
		var number = i;

		$(table[i]).click(function(event){
			var element = this;
			$.post(
				'index.php?c=tweet&a=add_the_retweet&rt=' + $('.value_tweet').attr("value"),
				{

				},
				
				);
		})
	}
});
