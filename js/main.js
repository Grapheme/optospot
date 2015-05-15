$(function() {
	
	$('#screen-2').css('display', 'none');
	$('#screen-3').css('display', 'none');
	
	$("select").selectify({maxItems:3});
	$(".lang-div .option").click(function(){
		$("#ChangeLang").change();
	});
	
	$('.acc-radio').prop('checked', false);
	
	$('.option[data-id=0]').addClass('hidden');
	
	$('.payment').change(function(){
		alert('123');
	});
});

function arrow_top() {
	var $int = parseInt($('.trade-banner-price span').html());
	if($int < 1000) {
		$int++;
		$('.trade-banner-price span').html($int);
	}
}

function arrow_down() {
	var $int = parseInt($('.trade-banner-price span').html());
	if($int > 5) {
		$int--;
		$('.trade-banner-price span').html($int);
	}
}

$('#price-change .money-arrow-top').mousedown(function(){
	arrow_top();
	interval = setInterval(function() {arrow_top(); }, 150);
	return false;
});

$('#price-change .money-arrow-down').mousedown(function(){
	arrow_down();
	interval = setInterval(function() {arrow_down(); }, 150);
	return false;
});

$('#price-change .money-arrow-top').mouseup(function(){
	clearInterval(interval);
	return false;
});

$('#price-change .money-arrow-down').mouseup(function(){
	clearInterval(interval);
	return false;
});

$('.money-arrow-top').click(function(){
	return false;
});

$('.money-arrow-down').click(function(){
	return false;
});


/********/

$('.trade-banner-pull').click(function(){
	$('.trade-banner-put').fadeOut();
});

$('.trade-banner-put').click(function(){
	$('.trade-banner-pull').fadeOut();
});


/*********/



$('.right-banner').click(function(){
	$('#sh_button').click();
	return false;
});

function login() {
	$('.login-popup').fadeIn();
	$('.dark-screen').fadeIn();
}

function loginClose() {
	$('.login-popup').fadeOut();
	$('.dark-screen').fadeOut();
}

function cssError(item) {
	$(item).css({'background' : '#ffeeee'});
}

function cssErrorRm(item) {
	$(item).css({'background' : '#ffffff'});
}

function validationTop(_form) {
	var error = 0;
	if($(_form).find('.input-fname').val().length < 3) {
		cssError($(_form).find('.input-fname'));
		error++;
	}else{
		cssErrorRm($(_form).find('.input-fname'));
	}
	if($(_form).find('.input-lname').val().length < 3) {
		cssError($(_form).find('.input-lname'));
		error++;
	} else {
		cssErrorRm($(_form).find('.input-lname'));
	}
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
	if($(_form).find('.input-country').val() == '0') {
		cssError($(_form).find('.country-div .selectify .header'));
		error++;
	} else {
		cssErrorRm($(_form).find('.country-div .selectify .header'));
	}
	if($(_form).find('.input-account').val() == '0'){
		cssError($(_form).find('.account-div .selectify .header'));
		error++;
	} else {
		cssErrorRm($(_form).find('.account-div .selectify .header'));
	}
	if(error == 0){
		return true;
	}else{
		return false;
	}
}

function validationReg() {
	var error = 0;
	if($('#reg-form #name').val().length < 3) {
		cssError('#reg-form #name');
		error++;
	} else {
		cssErrorRm('#reg-form #name');
	}
	if($('#reg-form #lastname').val().length < 3) {
		cssError('#reg-form #lastname');
		error++;
	} else {
		cssErrorRm('#reg-form #lastname');
	}
	if($('#reg-form #email').val() != '') {
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        if(pattern.test($('#reg-form #email').val())){
            cssErrorRm('#reg-form #email');
        } else {
        	error++;
            cssError('#reg-form #email');
        }
    } else {
    	error++;
        cssError('#reg-form #email');
    }
    if($('#reg-form #country').val() == '0') {
		cssError('#reg-form #country-div .selectify .header');
		error++;
	} else {
		cssErrorRm('#reg-form #country-div .selectify .header');
	}
	if($('#reg-form #account').val() == '0') {
		cssError('#reg-form #account-div .selectify .header');
		error++;
	} else {
		cssErrorRm('#reg-form #account-div .selectify .header');
	}
	if(error == 0) {
	alert('it works!');
	}
}

function validationOne(next) {
	var error = 0;
	if($('#name').val().length < 3) {
		cssError('#name');
		error++;
	} else {
		cssErrorRm('#name');
	}
	if($('#lastname').val().length < 3) {
		cssError('#lastname');
		error++;
	} else {
		cssErrorRm('#lastname');
	}
	if($('#email').val() != '') {
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        if(pattern.test($('#email').val())){
            cssErrorRm('#email');
        } else {
        	error++;
            cssError('#email');
        }
    } else {
    	error++;
        cssError('#email');
    }
    if($('#country').val() == '0') {
		cssError('#country-div .selectify .header');
		error++;
	} else {
		cssErrorRm('#country-div .selectify .header');
	}
	if(error == 0) {
		if(next == true){
			$('#circle-2').fadeOut(function(){
				$('#reg-2').fadeIn();
			});
			$('#button-1').fadeOut();
		}
		return true;
	}else{
		return false;
	}
}

function validationTwo(next) {
	if($('.acc-radio').is(':checked')) {
	/*
		if(next == true){
			$('#circle-3').fadeOut(function(){
				$('#reg-3').fadeIn();
			});
			$('#button-2').fadeOut();
			if($('.acc-radio[value=1]').is(':checked'))
	        {
	        	$('.reg-desc').slideDown();
	        	$('.reg-desc-2').slideUp();
	        } else {
	        	$('.reg-desc').slideUp();
	        	$('.reg-desc-2').slideDown();
	        }
		}*/
		return true;
	}else{
		return false;
	}
}

function scoreClick(color) {
	if(color == 'green') {
		/*$('.score.green').css('background','#467850');
		$('.score.blue').css('background','#3179CB');*/
		$('.acc-radio[value=2]').prop('checked', true);
	}
	if(color == 'blue') {
		/*$('.score.green').css('background','#5E9C6B');
		$('.score.blue').css('background','#1858a0');*/
		$('.acc-radio[value=1]').prop('checked', true);
	}
	return false;
}

function validationAuth() {
	var error = 0;
	if($('#auth-name').val().length < 3) {
		cssError('#auth-name');
		error++;
	}else{
		cssErrorRm('#auth-name');
	}
	if($('#auth-pass').val().length < 3) {
		cssError('#auth-pass');
		error++;
	}else{
		cssErrorRm('#auth-pass');
	}
	if(error == 0){
		return true;
	}else{
		return false;
	}
}

function screenTwo() {
	$('#screen-1').hide();
	$('#screen-3').hide(function(){
		$('#screen-2').fadeIn();
	});
	$('#control-3').removeClass('active');
	$('#control-1').removeClass('active');
	$('#control-2').addClass('active');
	$('.begin-container').css('background-image', 'url(../img/slide_2.jpg)');
}

function screenOne() {
	$('#screen-2').hide();
	$('#screen-3').hide(function(){
		$('#screen-1').fadeIn();
	});
	$('#control-3').removeClass('active');
	$('#control-2').removeClass('active');
	$('#control-1').addClass('active');
	$('.begin-container').css('background-image', 'url(../img/back.png)');
}

function screenThree() {
	$('#screen-1').hide();
	$('#screen-2').hide(function(){
		$('#screen-3').fadeIn();
	});
	$('#control-2').removeClass('active');
	$('#control-1').removeClass('active');
	$('#control-3').addClass('active');
	$('.begin-container').css('background-image', 'url(../img/screen-3.jpg)');
}

var count = 1;

function screenChange() {
	if(count == 1) {
		screenTwo();
		count = 2;
	} else if(count == 2) {
		screenThree();
		count = 3;
	}
	 else if(count == 3) {
		screenOne();
		count = 1;
	}
}

var screenInt = setInterval(screenChange, 7000);

$('.control-line#control-3').click(function(event){
	screenThree();
	clearInterval(screenInt);
});

$('.control-line#control-2').click(function(event){
	screenTwo();
	clearInterval(screenInt);
});

$('.control-line#control-1').click(function(event){
	screenOne();
	clearInterval(screenInt);
});

$('.control-line#control-3').click(function(event){
	$('#screen-1').hide();
	$('#screen-2').hide(function(){
		$('#screen-3').fadeIn();
	});
	$('#control-1').removeClass('active');
	$('#control-2').removeClass('active');
	$('#control-3').addClass('active');
});

$('.signup-submit').click(function(event){
	event.preventDefault();
	var _form = $(this).parents('form');
	if(validationTop(_form) == true){
		if ($("#policy").prop('checked')) {
			$(_form).formSubmitNoValid();
		}else{
			$("#policy").addClass('policy-error');
		}
	}
});

$('#reg-enter').click(function(event){
	event.preventDefault();
	validationReg();
});

$('#auth-enter').click(function(event){
	event.preventDefault();
	if(validationAuth() == true){
		$(this).parents('form').formSubmitNoValid();
	}
});

$('#button-3').click(function(event){
	/*event.preventDefault();
	if(validationOne()){
		validationTwo(true);
	}*/
});

$('.score.green').click(function(event){
	event.preventDefault();
	scoreClick('green');
	validationTwo(true);
	if(validationOne(false) && validationTwo(false)){
		$(this).parents('form').formSubmitNoValidReg();
	}
});

$('.score.blue').click(function(event){
	event.preventDefault();
	scoreClick('blue');
	validationTwo(true);
	if(validationOne(false) && validationTwo(false)){
		$(this).parents('form').formSubmitNoValidReg();
	}
});

$('#button-1').click(function(event) {
	event.preventDefault();
	validationOne(true);
});

$('#enter').click(function(event){
	event.preventDefault();
	$(".msg-alert").remove();
	$(".div-signin").removeClass('hidden');
	$(".div-forgot").addClass('hidden');
	login();
});

$('.green-enter').click(function(event){
	event.preventDefault();
	$(".msg-alert").remove();
	$(".div-signin").removeClass('hidden');
	$(".div-forgot").addClass('hidden');
	login();
});

$('.green-enter').click(function(event){
	event.preventDefault();
	$(".msg-alert").remove();
	$(".div-signin").removeClass('hidden');
	$(".div-forgot").addClass('hidden');
	login();
});

$('.dark-screen').click(function(){
	loginClose();
});

$(".js-dropdownlist-link").click(function(){
    $(".trading-popup").hide();
    $(this).siblings(".trading-popup").fadeIn();
	return false;
});
$(document).click(function(){
    $(".trading-popup").hide();
});