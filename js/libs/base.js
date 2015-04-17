/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

var mt = mt || {};

//configuration
mt.baseURL = window.location.protocol + '//' + window.location.hostname + '/';
mt.currentURL = window.location.href;
mt.languageSegment = 1;
mt.tooltipPlacementDefault = 'bottom'; // Возможные значения top | bottom | left | right | auto
mt.tooltipPlacement = mt.tooltipPlacementDefault;
//end configuration
mt.getBaseURL = function(url) {
	return mt.baseURL + url;
}
mt.getLanguageURL = function() {
	var segments = window.location.pathname.split('/');
	if (segments[mt.languageSegment]) {
		return segments[mt.languageSegment];
	} else {
		return 'ru';
	}
};
mt.currentLenguage = mt.getLanguageURL();
mt.isValidEmailAddress = function(emailAddress) {
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	if (emailAddress == '') {
		return false;
	} else {
		return pattern.test(emailAddress);
	}
};
mt.isValidPhone = function(phoneNumber) {
	var pattern = new RegExp(/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/i);
	if (phoneNumber == '') {
		return false;
	} else {
		return pattern.test(phoneNumber);
	}
};
mt.textLineFilter = function(string) {
	return string.replace(/[&,=]/, ' ');
}
mt.setJsonRequest = function(request, functionName) {
	$.each(request, function(index, value) {
		$("#"+index)[functionName](value);
	});
}
mt.formSerialize = function(objects) {
	var data = '';
	$(objects).each(function(i, element) {
		var value = mt.textLineFilter($(element).val());
		$(element).val(value);
		var name = $(element).attr('name');
		if (data === '') {
			data = name + "=" + value;
		} else {
			data = data + "&" + name + "=" + value;
		}
	});
	return data;
};
mt.matchesParameters = function(parameter1, parameter2) {
	var param1 = new String(parameter1);
	var param2 = new String(parameter2);
	if (param1.toString() == param2.toString()) {
		return true;
	}
	return false;
};
mt.exist_email = function(emailInput) {
	var user_email = $(emailInput).val();
	$(emailInput).hideToolTip();
	if (user_email != '') {
		if (!mt.isValidEmailAddress(user_email)) {
			$(emailInput).showToolTip(Localize[mt.currentLenguage]['valid_email']);
		} else {
			$.post(mt.baseURL + "valid/exist-email", {
				'parametr' : user_email
			}, function(data) {
				if (!data.status) {
					$(emailInput).showToolTip(Localize[mt.currentLenguage]['exist_email']);
				}
			}, "json");
		}
	}
};
mt.redirect = function(path) {
	window.location = path;
}
mt.minLength = function(string, Len) {
	if (string != '') {
		if (string.length < Len) {
			return false
		}
	}
	return true
}
mt.FieldsIsNotNumeric = function(formObject) {
	var result = {};
	var num = 0;
	$(formObject).nextAll("input.digital").each(function(i, element) {
		if (!$.isNumeric($(element).val())) {
			result[num] = $(element).attr('id');
			num++;
		}
	});
	$(formObject).nextAll("input.numeric-float").each(function(i, element) {
		if (!$.isNumeric($(element).val())) {
			result[num] = $(element).attr('id');
			num++;
		}
	});
	if ($.isEmptyObject(result)) {
		return false;
	} else {
		return result;
	}
}
mt.noValidEmails = function(elements) {
	var user_email = '';
	var errors = false;
	$(elements).each(function(i, element) {
		user_email = $(element).val().trim();
		if (!mt.isValidEmailAddress(user_email)) {
			$(element).setValidationErrorStatus(Localize[mt.currentLenguage]['valid_email']);
			errors = true;
		}
	});
	return errors;
}
mt.validation = function(jqForm) {
	var errors = false;
	$(jqForm).defaultValidationErrorStatus();
	$(jqForm).find(".valid-required:visible").each(function(i, element) {
		if ($(this).emptyValue()) {
			$(this).setValidationErrorStatus(Localize[mt.currentLenguage]['empty_field']);
			errors = true;
		}
	});
	if ($(jqForm).find(".valid-email:visible").length > 0) {
		if (mt.noValidEmails($(jqForm).find("input.valid-email"))) {
			errors = true;
		}
	}
	if ($(jqForm).find(".valid-phone-number:visible").length == 1) {
		var phoneInput = $(jqForm).find("input.valid-phone-number")
		if (!mt.isValidPhone($(phoneInput).val().trim())) {
			if ($(phoneInput).emptyValue() == false) {
				$(phoneInput).setValidationErrorStatus(Localize[mt.currentLenguage]['valid_phone']);
			}
			errors = true;
		}
	}
	if ($(jqForm).find("input[type='password']").length >= 2) {
		var newPassword = $(jqForm).find("input.input-new-password").val();
		var confirmPassword = $(jqForm).find("input.input-confirm-password").val();
		if (!mt.matchesParameters(newPassword, confirmPassword)) {
			$("input.input-confirm-password").setValidationErrorStatus(Localize[mt.currentLenguage]['match_pass']);
			errors = true;
		}
		if (!mt.minLength(newPassword, 6)) {
			$("input.input-new-password").setValidationErrorStatus(Localize[mt.currentLenguage]['pass_length']);
			errors = true;
		}
	}
	if (errors) {
		return false;
	} else {
		return true;
	}
}
mt.setExclamationTabPane = function(tabPane) {
	var exam = $("a[href='#" + $(tabPane).attr('id') + "']").find("i");
	if ($(exam).hasClass('icon-exclamation-sign') === false) {
		$(exam).addClass('icon-exclamation-sign');
	}
}
mt.tabValidation = function(jForm) {
	var errors = false;
	$("p.valid-messages").addClass('hidden');
	$("i.icon-exclamation-sign").removeClass('icon-exclamation-sign');
	$(jForm).find('div.tab-pane').each(function(i, element) {
		$(element).find(".valid-required").each(function(j, e) {
			if ($(e).val().trim() == '') {
				mt.setExclamationTabPane(element);
				$(e).nextAll('p.valid-messages').removeClass('hidden');
				errors = true;
			}
		});
	});
	if (errors == true) {
		return false;
	} else {
		return true;
	}
}
mt.ajaxBeforeSubmit = function(formData, jqForm, options) {

	if ($("div.msg-alert").exists() == true) {
		$("div.msg-alert").remove();
	}
	if (mt.validation(jqForm) == false) {
		$("button.btn-loading").removeClass('loading');
		return false;
	} else {
		return true;
	}
}
mt.ajaxSuccessSubmit = function(responseText, statusText, xhr, jqForm) {
	$("button.btn-loading").removeClass('loading');
}

$.fn.formSubmitInServer = function() {
	var _form = this;
	var options = {
		target : null,
		dataType : 'json',
		type : 'post',
		beforeSubmit : mt.ajaxBeforeSubmit,
		success : function(response, status, xhr, jqForm) {
			mt.ajaxSuccessSubmit(response, status, xhr, jqForm);
			if (response.status == true) {
				if (response.responseText != '') {
					$(_form).find("div.div-form-operation").after('<div class="msg-alert">' + response.responseText + '</div>');
				}
			} else {
				$(_form).find("div.div-form-operation").after('<div class="msg-alert error">' + response.responseText + '</div>');
			}
		}
	}
	setTimeout(function() {
		$(_form).ajaxSubmit(options);
	}, 2000);
}

$.fn.formSubmitNoValid = function() {
	var _form = this;
	var buttontext = $(_form).find(".btn-locked").html();
	var options = {
		target : null,
		dataType : 'json',
		type : 'post',
		beforeSubmit : function(formData, jqForm, options) {
			$(_form).find(".btn-locked").html(Localize[mt.currentLenguage]['wait']).attr('disabled', 'disabled');
			if($("div.msg-alert").exists() == true){$("div.msg-alert").remove();}
			return true;
		},
		success : function(response, status, xhr, jqForm) {
			if (response.status == true) {
				$(_form).find(".reg-normal").fadeOut('fast', function() {
					$(_form).find(".reg-success").fadeIn('fast');
				});
				if (response.redirect !== false) {
					setTimeout(function() {
						mt.redirect(response.redirect)
					}, 3000);
				}
			} else {
				$(_form).find(".btn-locked").removeAttr('disabled').html(buttontext);
				$(_form).find(".reg-normal").fadeOut('fast', function() {
					$(_form).find(".reg-error p.normal-text").html(response.responseText);
					$(_form).find(".reg-error").fadeIn('fast');
				});
				
				$(_form).find(".login-normal").fadeOut('fast', function() {
					$(_form).find(".login-error p.normal-text").html(response.responseText);
					$(_form).find(".login-error").fadeIn('fast');
				});
				
				$(_form).find(".try-again").click(function() {
					$(_form).find(".reg-error").fadeOut('fast', function() {
						$(_form).find(".reg-normal").fadeIn('fast');
					});
					$(_form).find(".login-error").fadeOut('fast', function() {
						$(_form).find(".login-normal").fadeIn('fast');
					});
					return false;
				});
			}
		}
	}
	$(_form).ajaxSubmit(options);
	return false;
}

$.fn.formSubmitNoValidReg = function() {
	var _form = this;
	var buttontext = $(_form).find(".btn-locked").html();
	$(_form).find(".reg-block-in .div-form-operation").html(Localize[mt.currentLenguage]['wait']);
	var options = {
		target : null,
		dataType : 'json',
		type : 'post',
		beforeSubmit : function(formData, jqForm, options) {
			if ($("div.msg-alert").exists() == true) {
				$("div.msg-alert").remove();
			}
			return true
		},
		success : function(response, status, xhr, jqForm) {
			if (response.status == true) {
					$('#reg-1 .reg-blocked').fadeIn();
					$('#reg-2 .reg-blocked').fadeIn();
					$(_form).find(".reg-block-in .div-form-operation").html('');
					$(_form).find(".reg-normal").fadeOut('fast', function() {
						$(_form).find(".reg-success").fadeIn('fast');
					});
					$('#circle-3').fadeOut(function() {
						$('#reg-3').fadeIn();
					});
					$('#button-2').fadeOut();
					if ($('.acc-radio[value=1]').is(':checked')) {
						$('.reg-desc').slideDown();
						$('.reg-desc-2').slideUp();
					} else {
						$('.reg-desc').slideUp();
						$('.reg-desc-2').slideDown();
					}

			} else {
				$(_form).find(".reg-block-in .div-form-operation").html('');
				$(_form).find(".btn-locked").removeAttr('disabled').html(buttontext);
				$(_form).find(".reg-block-in .div-form-operation").after('<div class="msg-alert error">' + response.responseText + '</div>');
				$(_form).find(".reg-normal").fadeOut('fast', function() {
					$(_form).find(".reg-email").fadeIn('fast');
				});
				$(_form).find(".try-again").click(function() {
					$(_form).find(".reg-email").fadeOut('fast', function() {
						$(_form).find(".reg-normal").fadeIn('fast');
					});
					$(_form).find(".login-error").fadeOut('fast', function() {
						$(_form).find(".login-normal").fadeIn('fast');
					});
					return false;
				});
				$(_form).find(".login-normal").fadeOut('fast', function() {
					$(_form).find(".login-error").fadeIn('fast');
				});
			}
		}
	}
	$(_form).ajaxSubmit(options);
}

$.fn.exists = function() {
	if ($(this).length > 0) {
		return true;
	} else {
		return false;
	}
}
$.fn.emptyValue = function() {
	if ($(this).val().trim() == '') {
		return true;
	} else {
		return false;
	}
}
$.fn.ForceNumericOnly = function() {
	return this.each(function() {
		$(this).keydown(function(e) {
			var key = e.charCode || e.keyCode || 0;
			return (key == 8 || key == 9 || key == 46 || (key >= 37 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
		});
	});
};
$.fn.setValidationErrorStatus = function(text) {
	if($(this).hasClass('tooltip-place')){
		var tooltipPlace = mt.tooltipPlacement;
		mt.tooltipPlacement = $(this).attr('data-tooltip-place');
	}else{
		mt.tooltipPlacement = mt.tooltipPlacementDefault;
	}
	$(this).attr('role', 'tooltip').showToolTip(text);
}
$.fn.defaultValidationErrorStatus = function() {
	$(this).find(":input[role='tooltip']").hideToolTip();
	$(this).find("div.msg-alert").remove();
}
$.fn.showToolTip = function(ToolTipText) {
	if (ToolTipText == '') {
		ToolTipText = Localize[mt.currentLenguage]['empty_field'];
	}
	var config = {
		placement : mt.tooltipPlacement,
		trigger : 'hover',
		title : ToolTipText
	}
	return this.each(function() {
		$(this).tooltip(config).tooltip('show');
	});
}
$.fn.hideToolTip = function() {
	return this.each(function() {
		if ($(this).is("[role='tooltip']") == true) {
			$(this).removeAttr('role').tooltip('destroy');
		}
	});
}
$(function() {
	$(".no-clickable").click(function(event) {
		event.preventDefault();
		event.stopPropagation();
	});
	$(":input.unique-email").blur(function() {
		mt.exist_email(this);
	});
	$("input.valid-numeric").ForceNumericOnly();
	$("input[type='text']").blur(function() {
		var value = $(this).val().trim();
		$(this).val(value);
	});
	$(":input").keydown(function() {
		$(this).hideToolTip();
	})
	$(":input").change(function() {
		$(this).hideToolTip();
	})
}); 