/* Author: Grapheme Group
 * http://grapheme.ru/
 */

$(function(){
	$("input.select-profile-age").datepicker({
		minDate: "01.01.1948",
		yearRange: '1950:2004',
		changeMonth: true,
		changeYear: true
	});
	$("input.select-financial-report-period-begin").datepicker({
		minDate: "01.04.2013",
		maxDate: '0D',
		defaultDate: "-2w",
		changeMonth: true,
		onClose: function(selectedDate){
			$("input.select-financial-report-period-end").datepicker("option","minDate",selectedDate);
		}
	});
	$("input.select-financial-report-period-end").datepicker({
		defaultDate: "0D",
		changeMonth: true,
		minDate: "01.04.2013",
		maxDate: '0D',
		onClose: function(selectedDate){
			$("input.select-financial-report-period-begin").datepicker("option","maxDate",selectedDate);
		}
	});
	
	$("input.select-period-begin").datepicker({
		minDate: "01.04.2013",
		maxDate: '0D',
		defaultDate: "-1m",
		changeMonth: true,
		onClose: function(selectedDate){
			$("input.select-period-end").datepicker("option","minDate",selectedDate);
		}
	});
	$("input.select-period-end").datepicker({
		defaultDate: "0D",
		changeMonth: true,
		minDate: "01.04.2013",
		maxDate: '0D',
		onClose: function(selectedDate){
			$("input.select-period-begin").datepicker("option","maxDate",selectedDate);
		}
	});
});