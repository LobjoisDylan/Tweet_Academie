<?php
include('../Model/classe_theme.php');

class theme
{
	public $user;

	public function __construct()
	{
	}

	public function change_theme()
	{
		$theme = new themeAction();
		$color = $theme->search_color();
		$files = scandir('../View/css');
		var_dump($files);
		foreach($files as $file)
		{

			if(strlen($file) > 2)
			{
				$file_open = fopen('../View/css/'.$file, 'r+');
				$content = file_get_contents('../View/css/' . $file);
				$new_content = str_replace($color, $_GET['color'], $content);
				fclose($file_open);

				$file_open = fopen('../View/css/'.$file, 'r+');
				fwrite($file_open, $new_content);
				fclose($file_open);
			}
		}
		$theme->replace_color();
		echo "ok";
	}






}