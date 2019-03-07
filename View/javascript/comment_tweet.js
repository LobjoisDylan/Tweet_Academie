$(document).ready(function(){
	var table = document.getElementsByClassName("glyphicon glyphicon-comment comment");
	var table_assoc = document.getElementsByClassName("your_tweeter");
	var span = document.getElementsByClassName("close")[0];
	var modal = document.getElementById('myModal');
	var i = 0;

	for(i; i < table.length; i +=1)
	{
		$(table[i]).click(function(event){
			var element = this;

			var temp = $(element).parent("div");
			var temp2 = $(temp).parent("div");
			$('#tweet_to_comment').html(temp2);
			for(i; i < table.length; i +=1)
			{
				var attribute_value = $("span .value_tweet").attr("value");
			}
			$('#value_hidden').attr("value", attribute_value);
			$('#form_comment').attr("action", 'index.php?c=tweet&a=add_answer_tweet&id=' + $('#value_hidden').attr("value"));
			modal.style.display = "block";

			
		})
	}

	span.onclick = function() {
		modal.style.display = "none";
	}

	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	};
});
