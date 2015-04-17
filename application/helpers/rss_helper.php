<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('getRSS')){
	function getRSS($q, $count = 9,$class = FALSE){
		$xml=($q);
		$xmlDoc = new DOMDocument();
		$xmlDoc->load($xml);
		//get elements from "<channel>"
		
		/*
			$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
			$channel_title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
			$channel_link = $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
			$channel_desc = $channel->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
		*/
		
		//output elements from "<channel>"
		//echo("<h2 class=\"news-title\"><a target=\"_blank\" href='" . $channel_link  . "'>" . str_replace('РБК daily от 11.04.2007', 'РБК Daily', $channel_title ) . "</a></h2>");
		//echo("<p class=\"news-desc\">" . str_replace('РБК Daily № 134 - среда от 11.04.2007', 'Последние мировые новости от РБК', $channel_desc) . "</p>");
		
		//get and output "<item>" elements
		$x=$xmlDoc->getElementsByTagName('item');
		for ($i=0; $i<=$count; $i++){
			$item_title=$x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
			$item_link=$x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
			//$item_desc=$x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
			if($class == FALSE):
				echo ('<a target="_blank" href="'.$item_link.'">'.$item_title.'</a>');
			else:
				echo ('<a class="'.$class.'" target="_blank" href="'.$item_link.'">'.$item_title.'</a>');
			endif;
		}
	}
}

