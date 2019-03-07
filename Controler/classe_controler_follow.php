<?php
include('../Model/classe_member.php');

class follow
{
	public $user;
	public $followed;

	public function __construct()
	{
		$this->followed = new member($_GET['t']);
		$this->user = new member("");
	}

	public function follow_or_not()
	{
		$booleen = 0;
		$donnees = $this->user->search_follow($this->followed->get_id_user());
		foreach($donnees as $value)
		{
			if($value['status_follow'] == 1)
			{
			$booleen += 1;
			}
		}
		return $booleen;
	}

	public function what_affich()
	{
		$booleen = $this->follow_or_not();
		if($booleen >= 1)
		{
			echo "follow existant";
		}

		if($booleen == 0)
		{
			echo "follow non existant";
		}
	}

	public function what_do()
	{
		$donnees = $this->user->search_follow($this->followed->get_id_user());
		if(isset($donnees[0]['status_follow']) && $donnees[0]['status_follow'] == 1)
		{
			$this->unfollow();
		}
		if(isset($donnees[0]['status_follow']) && $donnees[0]['status_follow'] == 0)
		{
			$this->re_follow();
		}
		if(!isset($donnees[0]['status_follow']))
		{
			$this->follow();
		}
	}

	public function unfollow()
	{
		$this->user->button_supp_follow($this->followed->get_id_user());
		echo "unfollow";
	}

	public function follow()
	{

		$this->user->button_add_follow($this->followed->get_id_user());
		echo "follow";
	}	

		public function re_follow()
	{

		$this->user->button_re_add_follow($this->followed->get_id_user());
		echo "follow";
	}	

}