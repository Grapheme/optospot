/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

$(function(){

    $("#show-astropay-form").click(function(){
        $(this).addClass('hidden');
        $("#show-dengionline-form").removeClass('hidden');

        $(".form-withdraw-astropay").removeClass('hidden');
        $(".form-withdraw-dengionline").addClass('hidden');
    });
    $("#show-dengionline-form").click(function(){
        $(this).addClass('hidden');
        $("#show-astropay-form").removeClass('hidden');

        $(".form-withdraw-astropay").addClass('hidden');
        $(".form-withdraw-dengionline").removeClass('hidden');
    });

	$('.js-confirm').click(function(){
		return confirm('Continue?');
	});

	$(".js-confirm-modal").click(function(){
		$("#form-delete-document").attr('action',$(this).data('action'));
	});
    $("#payment-currency").val($("#select-paysystems option:selected").data('currency-id'));
    $("#payment-currency-title").html($("#select-paysystems option:selected").data('currency-title'));

	if($('select[name=payment]').val() == '9'){
        $('.expiry-div').show();
        $('.name-div').show();
	}else if($('select[name=payment]').val() == '2'){
        $('input[name=account]').attr('placeholder', '9045003243');
        $('.expiry-div').hide();
        $('.name-div').hide();
	}else{
        $('input[name=account]').attr('placeholder', '');
    }
	
	$('select[name=payment]').change(function(){
        $("#payment-currency").val($("#select-paysystems option:selected").data('currency-id'));
        $("#payment-currency-title").html($("#select-paysystems option:selected").data('currency-title'));
		if($('select[name=payment]').val() == '9') {
            $('.expiry-div').fadeIn();
            $('.name-div').fadeIn();
			$('input[name=account]').attr('placeholder', '1234123412341234');
		} else if($('select[name=payment]').val() == '2') {
			$('input[name=account]').attr('placeholder', '9045003243');
			$('.expiry-div').fadeOut();
			$('.name-div').fadeOut();
		} else {
            $('input[name=account]').attr('placeholder', '');
			$('.expiry-div').fadeOut();
			$('.name-div').fadeOut();
		}
	});
	
	var mainOptions = {target: null,beforeSubmit: mt.ajaxBeforeSubmit,success: mt.ajaxSuccessSubmit,dataType:'json',type:'post'};
	$("button.btn-edit-user").click(function(event){
		var _form = $("form.form-edit-user");
		if(mt.validation(_form) === false){
			event.preventDefault();
		}
	})
	$("button.btn-edit-settings").click(function(event){
		var _form = $("form.form-edit-settings");
		if(mt.validation(_form) === false){
			event.preventDefault();
		}
	})
	$("button.btn-language-insert").click(function(event){
		var _form = $("form.form-language-insert");
		if(mt.validation(_form) === false){
			event.preventDefault();
		}
	})
	$("button.btn-lang-property").click(function(event){
		var _form = $("form.form-lang-property");
		if(mt.validation(_form) === false){
			event.preventDefault();
		}
	})
	$("button.btn-category-insert").click(function(event){
		var _form = $("form.form-category-insert");
		if(mt.validation(_form) === false){
			event.preventDefault();
		}
	})
	$("button.btn-category-update").click(function(event){
		var _form = $("form.form-category-update");
		if(mt.validation(_form) === false){
			event.preventDefault();
		}
	})
	$("button.btn-insert-page").click(function(event){
		var _form = $("form.form-insert-page");
		if(mt.validation(_form) === false){
			event.preventDefault();
		}
	})
	$("button.btn-home-page").click(function(event){
		var _form = $("form.form-home-page");
		if(mt.validation(_form) === false){
			event.preventDefault();
		}
	});
	$(".search-form-view").click(function(){
		$(".div-search-form").slideToggle();
	});
	$("#msgeclose").click(function(){$("#msgdealert").fadeOut(1000,function(){$(this).remove();});});
	$("#msgsclose").click(function(){$("#msgdsalert").fadeOut(1000,function(){$(this).remove();});});
});