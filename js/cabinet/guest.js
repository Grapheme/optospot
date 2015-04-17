/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

function validationForgot(_form){
	var error = 0;
	if($(_form).find('.input-email').val() != '') {
		var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
		if(pattern.test($(_form).find('.input-email').val())){
			cssErrorRm($(_form).find('.input-email'));
		}else{
			error++;
			cssError($(_form).find('.input-email'));
		}
	} else {
		error++;
		cssError($(_form).find('.input-email'));
	}
	if(error == 0){
		return true;
	}else{
		return false;
	}
}

$(function(){
	var mainOptions = {target: null,beforeSubmit: mt.ajaxBeforeSubmit,success: mt.ajaxSuccessSubmit,dataType:'json',type:'post'};
	$("#ChangeLang").change(function(){mt.redirect(mt.getBaseURL(mt.getLanguageURL()+'/change-site-language/'+$(this).val()));});
	
	$(".a-forgot-pass").click(function(){
		$(".div-signin").addClass('hidden');
		$(".div-forgot").removeClass('hidden');
	})
	
	$(".btn-forgot-submit").click(function(event){
		event.preventDefault();
		var _form = $(this).parents('form');
		if(validationForgot(_form) == true){
			$(_form).formSubmitInServer();
		}
	});
});