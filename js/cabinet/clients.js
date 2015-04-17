/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

$(function(){
	var mainOptions = {target: null,beforeSubmit: mt.ajaxBeforeSubmit,success: mt.ajaxSuccessSubmit,dataType:'json',type:'post'};
    $("#ChangeLang").change(function(){mt.redirect(mt.getBaseURL(mt.getLanguageURL()+'/change-site-language/'+$(this).val()));});

    $("#select-pay-system").change(function(){
        var paymentID = $(this).val();
        $("form.form-withdraw").clearForm();
        $(this).val(paymentID);
        $(".withdraw-input").addClass('hidden').each(function(index){
            if($(this).data('paysystem-id') == paymentID)
                $(this).removeClass('hidden');
        });
    });

    $("button.btn-withdrawal").click(function(){
        var _this = this;
        var options = mainOptions;
        var thisDefaultTextValue = $(this).html();
        $(this).html(Localize[mt.currentLenguage]['wait']).attr('disabled','disabled');
        options.beforeSubmit = function(formData,jqForm,options){
            $.each(formData,function(index,value){
                if(value['value'] == '')
                    delete formData[index];
            });
            if(mt.validation(jqForm) === false){
                $(_this).html(thisDefaultTextValue).removeAttr('disabled');
                return false;
            }else{
                return true;
            }
        },
        options.success = function(response,status,xhr,jqForm){
            mt.ajaxSuccessSubmit(response,status,xhr,jqForm);
            if(response.status){
                $(jqForm).find('input[type="text"]').val('');
                $(_this).html(thisDefaultTextValue).removeAttr('disabled');
                alert(response.responseText);
            }else{
                $(_this).html(thisDefaultTextValue).removeAttr('disabled');
                alert(response.responseText);
            }
        }
        $("form.form-withdraw").ajaxSubmit(options);
        return false;
    });


	$("button.btn-account-create").click(function(){
		var _this = this;
		var options = mainOptions;
		var thisDefaultTextValue = $(this).html();
		$(this).html(Localize[mt.currentLenguage]['wait']);
		options.beforeSubmit = function(formData,jqForm,options){
            $(_this).attr('disabled','disabled');
			if(mt.validation(jqForm) === false){
				$(_this).html(thisDefaultTextValue).removeAttr('disabled');
				return false;
			}else{
				return true;
			}
		},
		options.success = function(response,status,xhr,jqForm){
			mt.ajaxSuccessSubmit(response,status,xhr,jqForm);
			if(response.status){
				mt.redirect(response.redirect);
			}else{
				$(_this).html(thisDefaultTextValue).removeAttr('disabled');
				alert(response.responseText);
			}
		}
		$("form.form-signup").ajaxSubmit(options);
		return false;
	});
	$("button.btn-edit-user").click(function(event){
		var _form = $("form.form-edit-user");
		if(mt.validation(_form) === false){
			event.preventDefault();
		}
	});
	$("#msgeclose").click(function(){$("#msgdealert").fadeOut(1000,function(){$(this).remove();});});
	$("#msgsclose").click(function(){$("#msgdsalert").fadeOut(1000,function(){$(this).remove();});});
	$("#set_deposit_value").click(function(){
		var summa = parseFloat($("#deposit_value").val().trim());
		if(summa > 0){
			$("#deposit_value").val(summa).css({'background' : '#fff'});
			$("#div_deposit_value").fadeOut('fast',function(){
				$("form input[name='amount']").val(summa);
				$("form input[name='PAYMENT_AMOUNT']").val(summa);
				$("#deposit_system").fadeIn('fast');
			});
		}else{
			$("#deposit_value").val(50).css({'background' : '#ffeeee'}).focus();
		}
	});
	$("#submit_deposit_form_cancel").click(function(){
		$("#deposit_system").fadeOut('fast',function(){
			$("#div_deposit_value").fadeIn('fast');
		});
	});
	$(".submit_deposit_form").click(function(){
        var form_id = $(this).attr('data-form-id');
		var _form = document.getElementById(form_id);
        if(form_id == 'form_perfectmoney'){
            if($(_form).find('input[name="PAYMENT_AMOUNT"]').val().trim() > 0){
                $(_form).submit();
            }
        }else{
            if($(_form).find('input[name="amount"]').val().trim() > 0){
                $(_form).submit();
            }
        }

	});
});