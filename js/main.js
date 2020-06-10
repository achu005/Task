function user_register(){
    jQuery('field_error').html('');
    var name=jQuery("#name").val();
    var email=jQuery("#email").val();
    var password=jQuery("#password").val();
    var is_error='';

    if(name==""){
        jQuery('#name_error').html('please enter name');
        is_error='yes';
    }
    if(email==""){
        jQuery('#email_error').html('please enter email');
        is_error='yes';
    }
    if(password==""){
        jQuery('#password_error').html('please enter password');
        is_error='yes';
    }
    if(is_error==''){
        jQuery.ajax({
            url:'register_submit.php',
            type:'post',
            data:'name='+name+'&email='+email+'&password='+password,
            success:function(result){
                if(result=='success'){
                    window.location.href='login.php';

                }
            }
        });
    }
}


function user_login(){
	jQuery('.field_error').html('');
	var email=jQuery("#login_email").val();
	var password=jQuery("#login_password").val();
	var is_error='';
	if(email==""){
		jQuery('#login_email_error').html('Please enter email');
		is_error='yes';
	}if(password==""){
		jQuery('#login_password_error').html('Please enter password');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'login_submit.php',
			type:'post',
			data:'email='+email+'&password='+password,
			success:function(result){
				if(result=='valid'){
					window.location.href='home.php';
				}
			}	
		});
	}	
}