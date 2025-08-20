# JS Code -
jQuery('form#login').on('submit',function(event){
	event.preventDefault();
   	jQuery('form#login span.error-msg').remove();
   	var data = {};
	var fieldName = '';
	var popMsg = '';
	var popError = false;
var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var letters = /([A-Za-z0-9])*([A-Z])*([a-z])*([0-9])/g;
var passfilter = /^.*(?=.{6,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z](?=.*[@#$%&]).*$/;
var numbers = /^[0-9]*(?:\.\d{1,2})?$/;
var formTag = jQuery('form#login');
 
jQuery('form#login').find('input').each(function(i, field) {
 
	data[field.name] = field.value;
	fieldName = field.name;
	fieldName = fieldName.replace(/_/gi, " ");
	fieldName = fieldName.toLowerCase().replace(/\b[a-z]/g,	 		function(letter) {
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
	
}
});
 
			if(popError == true){
				formTag.addClass('invalid');
				jQuery(".error-message").show();
				 return false;
			}  else {
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
							jQuery('.login-msg').empty().append('<span 							class="error-msg">'+responseData.message+'</span>');
							return false;
						}
						else {
							jQuery('.login-msg').empty().append('<span 						class="success-msg">'+responseData.message+'</span>');
							window.location.href = responseData.redirect;
						}
					},
					error:function(){
						alert("Error: There is some issue please try again.")
					}
				});	
			}
	});
 
# Function file Code
Ajax action for login.
add_action( 'wp_ajax_ajax_login', 'ajax_login'); //for login user
add_action( 'wp_ajax_nopriv_ajax_login', 'ajax_login'); // for guest user
 Function ajax_login(){
Code for ajax login ----
}
 
 
l  We have also use Ajax for Loading more blocks in news,events,portfolio,blog etc.
# JS code.
var isPreviousEventComplete = true;
var isDataAvailable = true;
jQuery(window).scroll(function () {
var postlength = jQuery('.count').length;
var windowHeight = jQuery(window).height();
var windowwidth = jQuery(window).width();
var documentHeight = jQuery(document).height();
var footerHeight = jQuery(".site-footer").innerHeight();
var lastDivHeight = jQuery(".case-studies-list .col-sm-6:eq(-4)").outerHeight();
var bottomHeight = lastDivHeight+footerHeight;
 
        if (jQuery(window).scrollTop() >= lastDivHeight) {
            if (isPreviousEventComplete && isDataAvailable) {
                isPreviousEventComplete = false;
                jQuery(".loadmore").show();
                pageNumber++;
                var data = { "action": "morepostss"};
                data = "pageNumber=" + pageNumber + "&perpage=" + perpage +  "&postlength=" + postlength  + "&" + jQuery.param(data);;
                jQuery.ajax({
                    type: "POST",
                    dataType: "html",
                    url: ajaxurl,
                    data: data,
                    success: function (data) {
                        var $data = jQuery(data);
                        if ($data.length) {
                            jQuery("#ajax-posts").append($data);
                            var postlenghtafter = jQuery('.count').length;
var found_posts = jQuery('#found_value').val();
     if (postlenghtafter == found_posts ) {
      	isDataAvailable = false;
        jQuery(".loadmore").hide();
      } else {
        isPreviousEventComplete = true;
      }
}
                        else{
                            return false;
                        }
                    },
                });
            }
        }
        }
        return false;
    });
 
 
