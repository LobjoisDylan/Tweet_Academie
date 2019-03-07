<?php

include('../Model/classe_tweet.php');

class tweet
{
	public function add_new_tweet()
	{
		$new_tweet = new tweetAction();
		$new_tweet->add_new_tweetAction();
	}

		public function add_answer_tweet()
	{
		$new_tweet = new tweetAction();
		$_SESSION['id_tweet_for_comment'] = $_GET['id'];
		$new_tweet->add_answer_tweetAction();
	}

	public function redirection()
	{
		unset($_SESSION['for_search']);
		$_SESSION['for_search'] = $_POST['search'];
		echo "ok";
	}

	public function redirection_for_comment()
	{
		$_SESSION['for_comment'] = $_GET['id'];
		echo "hello";
	}
}