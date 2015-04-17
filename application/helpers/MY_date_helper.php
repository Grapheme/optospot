<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
	
	function seconds2times($seconds){
		$times = array();
		$count_zero = false;
		$periods = array(60,3600,86400,31536000);
		for($i=3;$i>=0;$i--):
			$period = floor($seconds/$periods[$i]);
			if(($period > 0) || ($period == 0 && $count_zero)):
				$times[$i+1] = $period;
				$seconds -= $period * $periods[$i];
				$count_zero = true;
			endif;
		endfor;
		$times[0] = $seconds;
		return $times;
}
	
	function PluralNumber($count,$arg0,$arg1,$arg2,$arg3){
		
		//PluralNumber($days, ‘ д’, ‘ень’, ‘ня’, ‘ней’);
		//PluralNumber($hours, ‘ час’, ”, ‘а’, ‘ов’);
		//PluralNumber(mins, ‘ минут’, ‘у’, ‘ы’, ”);
		
		if($count == 0):
			return '';
		endif;
		$result = $arg0;
		$last_digit = $count%10;
		$last_two_digits = $count%100;
		if($last_digit == 1 && $last_two_digits != 11):
			$result .= $arg1;
			echo $result;echo '<br/>';
		elseif(($last_digit == 2 && $last_two_digits != 12) || ($last_digit == 3 && $last_two_digits != 13) || ($last_digit == 4 && $last_two_digits != 14)):
			$result .= $arg2;
		else:
			$result .= $arg3;
		endif;
		return $count.' '.$result;
	}
	
	function current_date($time = FALSE){
		
		if($time):
			return strtotime(date('Y-m-d H:i:s'));
		else:
			return strtotime(date('Y-m-d'));
		endif;
	}
	
	function yesterday($user_date){
		
		if(!$user_date):
			return FALSE;
		endif;
		
		$sub_date = strtotime(date_without_time($user_date))- mktime(0,0,0,date("m"),date("d")-1,date("Y"));
		if($sub_date == 0):
			return TRUE;
		else:
			return FALSE;
		endif;
	}
	
	function dialog_date($user_date){
		
		if(!$user_date):
			return '';
		endif;
		$date = strtotime(date_without_time($user_date));
		if($date == current_date()):
			return $string = 'cегодня в '.date_time($user_date);
		elseif(yesterday($user_date)):
			return $string = 'вчера в '.date_time($user_date);
		else:
			return $string = month_date_with_time($user_date);
		endif;
	}
	
	function dialog_time($user_date){
		
		if(!$user_date):
			return '';
		endif;
		
		$date = strtotime(date_without_time($user_date));
		if($date == current_date()):
			return $string = date_full_time($user_date);
		else:
			return $string = date("d.m.y",strtotime(swap_dot_date_without_time($user_date)));
		endif;
	}
	
	function month_date($field){
		
		$months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля","05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа","09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
		$list = explode("-",$field);
		$list[2] = (int)$list[2];
		$field = implode("-",$list);
		$nmonth = $months[$list[1]];
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5 $nmonth \$1";
		return preg_replace($pattern, $replacement,$field);
	}
	
	function month_date_with_time($field){
		
		$months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля","05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа","09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
		$list = explode("-",$field);
		$list[2] = (int)$list[2];
		$time = substr($field,11);
		$field = implode("-",$list).' '.$time;
		$nmonth = $months[$list[1]];
		$pattern = "/(\d+)(-)(\w+)(-)(\d+) (\d+)(:)(\d+)(:)(\d+)/i";
		$replacement = "\$5 $nmonth \$1 в \$6:\$8";
		return preg_replace($pattern, $replacement,$field);
	}
	
	function month_dot_date($field){
		
		$months = array("01"=>"янв","02"=>"фев","03"=>"мар","04"=>"апр","05"=>"мая","06"=>"июня","07"=>"июля","08"=>"авг","09"=>"сен","10"=>"окт","11"=>"ноя","12"=>"дек");
		$list = preg_split("/\./",$field);
		$nmonth = $months[$list[1]];
		$pattern = "/(\d+)(\.)(\w+)(\.)(\d+)/i";
		$replacement = "\$1 $nmonth \$5";
		return preg_replace($pattern, $replacement,$field);
	}
	
	function split_date($field){
	
		$list = preg_split("/-/",$field);
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5 $nmonth \$1"; 
		return preg_replace($pattern, $replacement,$field);
	}
	
	function date_without_time($field){
	
		$list = preg_split("/-/",$field);
		$pattern = "/(\d+)(-)(\w+)(-)(\d+) (\d+)(:)(\d+)(:)(\d+)/i";
		$replacement = "\$1-$3-\$5";
		return preg_replace($pattern, $replacement,$field);
	}
	
	function date_time($field){
	
		$list = preg_split("/-/",$field);
		$pattern = "/(\d+)(-)(\w+)(-)(\d+) (\d+)(:)(\d+)(:)(\d+)/i";
		$replacement = "\$6:\$8";
		return preg_replace($pattern, $replacement,$field);
	}
	
	function date_full_time($field){
	
		$list = preg_split("/-/",$field);
		$pattern = "/(\d+)(-)(\w+)(-)(\d+) (\d+)(:)(\d+)(:)(\d+)/i";
		$replacement = "\$6:\$8:\$10";
		return preg_replace($pattern, $replacement,$field);
	}
	
	function swap_dot_date($field){
		
		if($field != '0000-00-00'):
			$list = preg_split("/-/",$field);
			$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
			$replacement = "\$5.$3.\$1";
			return preg_replace($pattern, $replacement,$field);
		else:
			return '';
		endif;
		
	}
	
	function swap_dot_date_without_time($field){
			
		$list = preg_split("/-/",$field);
		$pattern = "/(\d+)(-)(\w+)(-)(\d+) (\d+)(:)(\d+)(:)(\d+)/i";
		$replacement = "\$5.$3.\$1";
		return preg_replace($pattern, $replacement,$field);
	}

	function swap_dot_date_with_time($field){
			
		$list = preg_split("/-/",$field);
		$pattern = "/(\d+)(-)(\w+)(-)(\d+) (\d+)(:)(\d+)(:)(\d+)/i";
		$replacement = "\$5.$3.\$1 в \$6:\$8";
		return preg_replace($pattern, $replacement,$field);
	}

	function future_days($days = 1,$date = NULL){
		
		if(is_null($date)):
			return (time()+($days*24*60*60));
		else:
			return (strtotime($date)+($days*24*60*60));
		endif;
	}
	
	function daysDiff($startDateTime,$endDateTime){
		
		$timeSting = '';
		$times_values = array('сек.','мин.','час.','д.','лет');
		$times = seconds2times($endDateTime-$startDateTime);
		for($i=count($times)-1;$i>=0;$i--):
			$timeSting .= $times[$i].' '.$times_values[$i].' ';
		endfor;
		return $timeSting;
	}

?>