<?php

function search_hashtag($element)
{
	$table;  
	preg_match_all("/(#\w+)/u", $element, $find);  
	if ($find) {
		$table_temp = array_count_values($find[0]);
		$table = array_keys($table_temp);
	}
	return $table;
}

function search_name($element)
{
	$table;  
	preg_match_all("/(@\w+)/u", $element, $find);  
	if ($find) {
		$table_temp = array_count_values($find[0]);
		$table = array_keys($table_temp);
	}
	return $table;
}


function parser_hashtag($element)
{
	$replace = preg_replace("/(#\w+)/u", '<a href="search.php?search=$1">+$1</a>', $element);
	$replace = preg_replace("/#/", "", $replace);
	$replace = str_replace("+", "#", $replace);
	echo $replace;
}	

function parser_name($element)
{
	$replace = preg_replace("/(@\w+)/u", '<a href="profil.php?p=$1">+$1</a>', $element);
	$replace = preg_replace("/@/", "", $replace);
	$replace = str_replace("+", "@", $replace);
	echo  $replace;
}

function parser_tweet($element)
{
	$table_hashtag = search_hashtag($element);
	$table_name = search_name($element);
	if(sizeof($table_name) != 0 && sizeof($table_hashtag) != 0)
	{
		$replace = preg_replace("/(#\w+)/u", '<a href="search.php?search=$1">+$1</a>', $element);
		$replace = preg_replace("/#/", "", $replace);
		$replace = str_replace("+", "#", $replace);
		$replace = preg_replace("/(@\w+)/u", '<a href="profil.php?p=$1">+$1</a>', $replace);
		$replace = preg_replace("/@/", "", $replace);
		$replace = str_replace("+", "@", $replace);
		echo $replace;
	}

	elseif(sizeof($table_name) == 0 && sizeof($table_hashtag) == 0)
	{
		echo $element;
	}
	elseif(sizeof($table_hashtag) >0)
	{
		parser_hashtag($element);
	}
	elseif(sizeof($table_name) >0)
	{
		parser_name($element);

	}
	
}

