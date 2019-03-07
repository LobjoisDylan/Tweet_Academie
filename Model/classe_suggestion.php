<?php 
class suggestions
{
	public function count_id()
	{
		$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
		$request = $bdd->prepare("SELECT COUNT(id_user) FROM user");
		$request->execute();
		$donnees = $request->fetch(PDO::FETCH_ASSOC);
		return $donnees;
	}

	public function suggestion()
	{
		$count_id = $this->count_id();
		$count_id = (int)$count_id;

		for($i = 0; $i <= $count_id; $i++)
		{
			$rand = rand(1, $count_id[$i]);
		}
		$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
		$request = $bdd->prepare("SELECT username FROM user ORDER BY RAND(:count_id) ASC LIMIT 5");
		$request->bindValue(':count_id', $rand);
		$request->execute();
		$donnees = $request->fetchAll(PDO::FETCH_ASSOC);
		return $donnees;
	}
}