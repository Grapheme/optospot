<?php 
if($this->language == 3):
	$chat_lang = "ru";
else:
    $chat_lang = "en";
endif;
?>
<script>
	(function(){
	// your widget ID
	var widget_id = 654946;
	_shcp =[{widget_id : widget_id}];
	// set default language
	var lang =("<?=$chat_lang;?>")
	.substr(0,2).toLowerCase();
	// script url
	var url ="widget.siteheart.com/widget/sh/"+ widget_id +"/"+ lang +"/widget.js";
	var hcc = document.createElement("script");
	hcc.type ="text/javascript";
	hcc.async = true;
	hcc.src =("https:"== document.location.protocol ?"https":"http")
	+"://"+ url;
	var s = document.getElementsByTagName("script")[0];
	s.parentNode.insertBefore(hcc, s.nextSibling);
	})();
</script>