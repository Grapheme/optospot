<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('banner'))
{
    function banner($lang)
    {
		echo '
		<div class="span18">
			<a class="main-promo" href="#">
				<img src="http://optospot.net/banners/banner_main.png" alt="Минимальный депозит всего 5$. Демо и профи-счет." />
			</a>
            <div class="row">
            	<div class="span9 flash-link-wrapper">
            		<a onclick="window.open(\'https://server.iad.liveperson.net/hc/55637638/?cmd=file&file=visitorWantsToChat&site=55637638&SV!skill=--Default%20Skill--&leInsId=5563763898628583812&skId=-1&leEngId=55637638_23984e41-338d-44c6-be65-735862271014&leEngTypeId=7&leEngName=OptoSpot%20EN_default&leRepAvState=3&referrer=(button%20dynamic-button:OptoSpot%20EN_default(optospot%20-%20Easy%20Money%20For%20Smart%20People))%20http%3A//www.optospot.com/home\', \'Live Chat\', \'width=475,height=400,resizable=yes\'); return false;" target="blank_" class="flash-link" href="#">Live Chat</a>
					<object width="350" height="130" classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
					    <param name="movie" value="http://optospot.net/banners/Chat_'.$lang.'.swf">
					    <param name="wmode" value="transparent">
					    <embed src="http://optospot.net/banners/Chat_'.$lang.'.swf" wmode="transparent" width="350" height="130" type="application/x-shockwave-flash">
					</object>                    		
            	</div>
            	<div class="span9 flash-link-wrapper">
            		<a target="blank_" class="flash-link" href="http://optospot.net/banners/trade_binery_options_'.$lang.'.pdf">Ebook</a>
            		<object wmode="transparent" width="350" height="130" classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
					    <param name="movie" value="http://optospot.net/banners/Book_'.$lang.'.swf">
					    <param name="wmode" value="transparent">
					    <embed src="http://optospot.net/banners/Book_'.$lang.'.swf" wmode="transparent" width="350" height="130" type="application/x-shockwave-flash">
					</object>
            	</div>
            </div>
		<!--</div>-->';
    }   
}

