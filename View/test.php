	<?php
function recup_id_tag($element)
	{
		$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
		$id_tag;
		$request = $bdd->prepare("SELECT *  FROM hashtag WHERE name_hashtag = :hashtag");
		$request->bindValue(':hashtag', $element);
		$request->execute();
		$donnees = $request->fetch(PDO::FETCH_ASSOC);
		var_dump($donnees);
		$id_tag = $donnees['id_hashtag'];

		return $id_tag;

	}

	echo recup_id_tag("#try");