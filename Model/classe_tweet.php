<?php 
include('../Model/classe_member.php');
class tweetAction
{
	public $bdd;
	public $id_user; 
	public $avatar; 
	public $content;
	public $new_content;
	public $research;

	public function __construct()
	{
		$this->bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=utf8', 'root', '');
		$user = new member("");
		$this->id_user = $user->get_id_user();
		$this->avatar = $user->get_avatar();
		$this->username = $user->get_username();
	}

	public function default_search_tweet()
	{
		$request = $this->bdd->query("SELECT * FROM tweet AS t 
			LEFT JOIN user AS u 
			ON t.id_user = u.id_user 
			ORDER BY t.date_tweet DESC");
		$donnees = $request->fetchAll(PDO::FETCH_ASSOC);
		return $donnees;
	}

	public function profil_search_tweet($element)
	{
		if($element == "")
		{
			$filtre1 = "email";
			$filtre2 = $_SESSION['email'];
		}
		if($element != "")
		{
			$filtre1 = "username";
			$filtre2 = $element;
		}
		$request = $this->bdd->prepare("SELECT * FROM tweet AS t 
			LEFT JOIN user AS u 
			ON t.id_user = u.id_user 
			WHERE $filtre1 = :filtre
			ORDER BY t.date_tweet DESC");
		$request->bindValue( ':filtre', $filtre2);
		$request->execute();
		$donnees = $request->fetchAll(PDO::FETCH_ASSOC);
		return $donnees;
	}

	public function search_tweet_by_tag()
	{
		$request = $this->bdd->prepare("SELECT * FROM tweet AS t 
			LEFT JOIN user AS u ON t.id_user = u.id_user 
			LEFT JOIN tweet_to_tag AS ttt ON t.id_tweet = ttt.id_tweet 
			LEFT JOIN hashtag AS h ON h.id_hashtag = ttt.id_tag 
			WHERE h.name_hashtag = :hashtag
			ORDER BY t.date_tweet DESC");
		$request->bindValue(':hashtag', $_POST['search']);
		$request->execute();
		$_SESSION['result_tweet'] = $request->fetchAll(PDO::FETCH_ASSOC);
		return $_SESSION['result_tweet'];
	}

	public function search_tweet_by_tag_get($element)
	{
		$request = $this->bdd->prepare("SELECT * FROM tweet AS t 
			LEFT JOIN user AS u ON t.id_user = u.id_user 
			LEFT JOIN tweet_to_tag AS ttt ON t.id_tweet = ttt.id_tweet 
			LEFT JOIN hashtag AS h ON h.id_hashtag = ttt.id_tag 
			WHERE h.name_hashtag = :hashtag
			ORDER BY t.date_tweet DESC");
		$request->bindValue(':hashtag', '#' . $element);
		$request->execute();
		return $request->fetchAll(PDO::FETCH_ASSOC);
	}

	public function redirection()
	{
		$_SESSION['for_search'] = $_POST['search'];
		echo "ok";
	}

	public function search_in_twitter()
	{
		if(isset($_POST['search']))
		{
			$this->research = $_POST['search'];
		}
		else
		{
			$this->research = $_SESSION['for_search'];
		}
		$request = $this->bdd->prepare("SELECT DISTINCT * FROM tweet AS t 
			LEFT JOIN user AS u ON t.id_user = u.id_user 
			LEFT JOIN tweet_to_tag AS ttt ON t.id_tweet = ttt.id_tweet 
			LEFT JOIN hashtag AS h ON h.id_hashtag = ttt.id_tag 
			WHERE h.name_hashtag = :hashtag
			OR  u.username LIKE :username
			OR t.content_tweet LIKE :content
			GROUP BY t.id_tweet
			ORDER BY t.date_tweet DESC");
		$request->bindValue(':hashtag', $this->research);
		$request->bindValue(':username', "%" . $this->research . "%");
		$request->bindValue(':content', "%" . $this->research . "%");
		$request->execute();
		$donnees = $request->fetchAll(PDO::FETCH_ASSOC);
		return $donnees;
	}

	public function affichage_date_tweet($element)
	{
		$datetime1 = date_create($element);
		$datetime2  = new DateTime();
		$datetime2->add(new DateInterval('PT02H'));

		$interval = date_diff($datetime1, $datetime2);

		if( $interval->format('%d') >= 1 )
		{
			echo date_format(date_create($element), "d M");
		}
		else if( $interval->format('%h') > 0)
		{
			echo  $interval->format('%h hour');
		}

		else if( $interval->format('%h') == 0)
		{
			echo  $interval->format('%i min');
		}
	}

	public function search_hashtag_in_content($element)
	{
		$table;  
		preg_match_all("/(#\w+)/u", $element, $find);  
		if ($find) {
			$table_temp = array_count_values($find[0]);
			$table = array_keys($table_temp);
		}
		return $table;
	}

	public function search_hashtag_in_bdd($element)
	{
		$booleen = true;
		$request = $this->bdd->prepare("SELECT * FROM hashtag WHERE name_hashtag = :hashtag");
		$request->bindValue(':hashtag', $element);
		$request->execute();	
		$donnees =  $request->fetch(PDO::FETCH_ASSOC);

		if($donnees['name_hashtag'] == $element)
		{
			$booleen = false;
		}

		if($booleen == true)
		{
			$this->add_new_hashtag($element);
		}
	}
	
	public function add_new_hashtag($element)
	{
		$request = $this->bdd->prepare("INSERT INTO hashtag (name_hashtag) VALUES (:new_hashtag)");
		$request->bindValue(':new_hashtag', $element);
		$request->execute();
	}

	public function count_retweet($element)
	{
		$id_new_retweet = 0;
		$request = $this->bdd->query("SELECT COUNT(*) AS 'count'  FROM retweet");
		$donnees = $request->fetch(PDO::FETCH_ASSOC);
		foreach($donnees as $value)
		{
			$id_new_retweet = $value;
		}
		return $id_new_retweet;
	}

	public function count_tweet()
	{
		$id_new_tweet;
		$request = $this->bdd->query("SELECT COUNT(*) as 'count'  FROM tweet");
		$donnees = $request->fetch(PDO::FETCH_ASSOC);
		foreach($donnees as $key => $value)
		{
			$id_new_tweet = $value;
		}
		return $id_new_tweet;
	}

	public function recup_id_tag($element)
	{
		$id_tag;
		$request = $this->bdd->prepare("SELECT *  FROM hashtag WHERE name_hashtag = :hashtag");
		$request->bindValue(':hashtag', $element);
		$request->execute();
		$donnees = $request->fetch(PDO::FETCH_ASSOC);
		$id_tag = $donnees['id_hashtag'];
		return $id_tag;
	}

	public function add_new_ttt($element)
	{
		$id_new_tweet = $this->count_tweet();
		$id_tag = $this->recup_id_tag($element);

		$request = $this->bdd->prepare("INSERT INTO tweet_to_tag (id_tweet, id_tag) VALUES (:id_tweet, :id_tag)");
		$request->bindValue(':id_tweet', $id_new_tweet);
		$request->bindValue(':id_tag', $id_tag);
		$request->execute();
	}

	public function add_tweet()
	{
		$this->new_content = $_POST['send_tweet'];
		if($this->new_content != "")
		{
			$request = $this->bdd->prepare("INSERT INTO tweet (id_user, content_tweet) VALUES (:id_user, :content_tweet)");
			$request->bindValue(':id_user', $this->id_user);
			$request->bindValue(':content_tweet', $this->new_content);
			$request->execute();

			$table = $this->search_hashtag_in_content($this->new_content);
			foreach($table as $key => $value)
			{
				$this->search_hashtag_in_bdd($value);
				$this->add_new_ttt($value);
			}
		}
	}
	
	public function add_new_tweetAction()
	{
		$this->add_tweet();
		header('Location:accueil.php');
	}

	public function add_answer_tweetAction()
	{
		$this->new_content = $_POST['send_tweet'];
		$id_tweet = $_GET['id'];
		if($this->new_content != "")
		{
			$request = $this->bdd->prepare("INSERT INTO comment (id_user, id_tweet, content_comment) VALUES (:id_user, :id_tweet, :content_comment)");
			$request->bindValue(':id_user', $this->id_user);
			$request->bindValue(':id_tweet', $id_tweet);
			$request->bindValue(':content_comment', $this->new_content);
			$request->execute();

			$table = $this->search_hashtag_in_content($this->new_content);
			foreach($table as $key => $value)
			{
				$this->search_hashtag_in_bdd($value);
				$this->add_new_ttt($value);
			}
		}
		
		header('Location:accueil.php');
	}

	public function tendance_tweet()
	{
		$request = $this->bdd->prepare("SELECT name_hashtag FROM hashtag LEFT JOIN tweet_to_tag ON tweet_to_tag.id_tag = hashtag.id_hashtag GROUP BY name_hashtag ORDER BY COUNT('id_tag') DESC LIMIT 10");
		$request->execute();
		$donnees = $request->fetchAll();
		return $donnees;
	}

	public function count_comment_tweet($element)
	{
		$request = $this->bdd->prepare("SELECT COUNT(*) as count FROM comment WHERE id_tweet = $element");
		$request->execute();
		$donnees = $request->fetch();
		return $donnees['count'];
	}

	public function search_comment_tweet()
	{
		$id_tweet = $_SESSION['for_comment'];
		$request = $this->bdd->prepare("SELECT * FROM comment AS t 
			LEFT JOIN user AS u 
			ON t.id_user = u.id_user
			WHERE id_tweet = $id_tweet");
		$request->execute();
		$donnees = $request->fetchAll(PDO::FETCH_ASSOC);
		return $donnees;
	}
}
