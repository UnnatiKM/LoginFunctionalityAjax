jQuery('form#login').on('submit',function(event){
		event.preventDefault();
   		jQuery('form#login span.error-msg').remove();
   		var data = {};
		var fieldName = '';
		var popMsg = '';
		var popError = false;
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var letters = /([A-Za-z0-9])*([A-Z])*([a-z])*([0-9])/g;
		//var passfilter = (/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$/);
		var passfilter = /^.*(?=.{6,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z](?=.*[@#$%&]).*$/;
		var numbers = /^[0-9]*(?:\.\d{1,2})?$/;
		var formTag = jQuery('form#login');

			jQuery('form#login').find('input').each(function(i, field) {

				data[field.name] = field.value;
				fieldName = field.name;
				fieldName = fieldName.replace(/_/gi, " ");
				fieldName = fieldName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				}); 

				if (field.name == 'username'){
					if(field.value == ''){
						formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Please enter email address.</span>');
						if(popError == false)
							popError = true;
					} else if (!filter.test(field.value)) {
						formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Please enter a valid email.</span>');
						if(popError == false)
							popError = true;
					} 
						
				}  else if (field.name == 'password'){
					if(field.value == ''){
						formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Please enter password.</span>');	
						if(popError == false)
							popError = true;
					} 		
				}  

			});

			if(popError == true){
				formTag.addClass('invalid');
				jQuery(".error-message").show();
				 return false;
			}  else {
				// console.log('success');
				jQuery('body').addClass('ajax-loader');
				formTag.removeClass('invalid');
				jQuery(".error-message").hide();	
				var form = jQuery('#login').serialize();
				jQuery.ajax({
					type: 'POST',
					url: adminurl,
					data: form,					
					beforeSend:function(){ },					
					success:function(data){
						jQuery('body').removeClass('ajax-loader');
						
						var responseData = JSON.parse(data);
						if(responseData.loggedin == false){
							jQuery('.login-msg').empty().append('<span class="error-msg">'+responseData.message+'</span>');
							return false;
						} 
						else {
							jQuery('.login-msg').empty().append('<span class="success-msg">'+responseData.message+'</span>');
							window.location.href = responseData.redirect;
						}
					},
					error:function(){
						alert("Error: There is some issue please try again.")
					}
				});	
			}
	});

