$(function(){
	
	var $ticker = 0;
	$('.ticker-item').each(function(){
		$ticker++;
		$(this).attr('data-id', $ticker);
	});
	
	var $curlopen = false;
	
	timeInt = setInterval(function(){
		timeBack();
	}, 1000);
	
	function coupleChange() {
		$('.money-select option').click(function(){
			var ccf = $(this).data('ccf');
			var ccs = $(this).data('ccs');
			$('.ticker-item').data('ccf', ccf);
			$('.ticker-item').data('ccs', ccs);
		});
	}
	
	function timeBack() {
		if($curlopen) {
			$(".ticker-item").each(function(){
				var $thistime = $(this).find('.exp').data('time');
				$(this).find('.exp').html(toTime($thistime-1));
				$(this).find('.exp').data('time', $thistime-1);
				if($thistime-1 < 0) {
					clearInterval(timeInt);
				}
			});
		}
	}
	
	function toTime(timeF) {
	    var sec_num = parseInt(timeF, 10);
	    var hours   = Math.floor(sec_num / 3600);
	    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
	    var seconds = sec_num - (hours * 3600) - (minutes * 60);
	
	    if (hours   < 10) {hours   = "0"+hours;}
	    if (minutes < 10) {minutes = "0"+minutes;}
	    if (seconds < 10) {seconds = "0"+seconds;}
	    var time    = hours+':'+minutes+':'+seconds;
	    return time;
	}
	
	var $ccf;
	var $ccs;

	var $i = 0;

	function tickerPost() {
		var $currentId = 0;
		var $idJson = "";
		$('.ticker-item').each(function(){
			$currentId++;
			$ccf = $(this).attr('data-ccf');
			$ccs = $(this).attr('data-ccs');
			$idJson += '"' + $currentId + '":{"cc1":"' + $ccf + '","cc2":"' + $ccs + '"}';
			if($currentId != $ticker) {
				$idJson += ',';
			}
		});
		
		var $dataoff = "{"+ $idJson +"}";
		
		$.ajax({
			url: "ticker-curl", 
			data: { postdata: $dataoff },
			type: 'post'
			
			}).done(function(data) {
				var $thisTicker;
				var $responce = jQuery.parseJSON(data);
				$.each($responce, function(){
					var $thisTicker = $('.ticker-item[data-id=' + this.id + ']');
					$thisTicker.find('.bid').html(this.bid);
					$thisTicker.find('.payout').html(this.payout+"%");
					$thisTicker.find('.winmax').html("$"+this.winmax);
					$thisTicker.find('.winmin').html("$"+this.winmin);
					if($thisTicker.find('.exp').hasClass('closed')) 
					{
						return false;
					} else {					
						$thisTicker.find('.exp').addClass('closed');
						$thisTicker.find('.exp').html(toTime(this.exp));
						$thisTicker.find('.exp').attr('data-time', this.exp);
					}
					if(!$curlopen) {
						$curlopen = true;
					}
				});
			});

		setTimeout(function(){tickerPost();}, 5000);	
	}
	
	timeBack();
	tickerPost();
	/*setInterval(function(){
		tickerPost();
	}, 5000);*/
	
	$('.money-couple-select').click(function(){
		$(this).find('.money-coupe-down').slideToggle('fast');
	});
	
	$('.money-couple-option').not('.option-active').click(function(){
		var activeOpt = $(this).parent().parent().find('.option-active');
	
		var beforeF = $(this).attr('data-ccf');
		var beforeS = $(this).attr('data-ccs');
		var afterF = $(this).parent().parent().find('.option-active').attr('data-ccf');
		var afterS = $(this).parent().parent().find('.option-active').attr('data-ccs');
		var thisHTML = $(this).html();
		
		$(this).parent().parent().parent().parent().attr('data-ccf', beforeF);
		$(this).parent().parent().parent().parent().attr('data-ccs', beforeS);
		
		$(this).attr('data-ccf', afterF);
		$(this).attr('data-ccs', afterS);
		$(this).html(activeOpt.html());
		
		$(this).parent().parent().find('.option-active').attr('data-ccf', beforeF);
		$(this).parent().parent().find('.option-active').attr('data-ccs', beforeS);
		$(this).parent().parent().find('.option-active').html(thisHTML);

		tickerPost();
	});

});