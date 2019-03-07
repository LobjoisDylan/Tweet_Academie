<?php


class test
{
	public function YoloAction()
	{
		echo "bon bah... ça marche !";
		$options = "si tu aimes la wac tape dans
tes mains";
		echo hash("ripemd160", "bonjour", $options);
	}
}

?>