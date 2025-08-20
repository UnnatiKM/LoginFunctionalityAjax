<?php
add_action( 'wp_ajax_ajax_login', 'ajax_login');
add_action( 'wp_ajax_nopriv_ajax_login', 'ajax_login');
function ajax_login()
{		
		$info = array();
        $info['user_login'] = $_POST['username'];
        $info['user_password'] = $_POST['password'];
       
			$user = get_user_by('email',$_POST['username']);
			$user_id = $user->ID;
	    	$user_status = get_user_meta($user_id,'activation',true);
			if ($user_status == 'approve') {
			   	$user_signon = wp_signon( $info, false );
			    if ( is_wp_error( $user_signon )) {
			        echo json_encode( array( 'loggedin'=>false, 'message'=>__( 'Wrong username or password!' )));
			    } else {
			        echo json_encode( array( 'loggedin'=>true, 'message'=>__('Login successful, redirecting...' ) , 'redirect'=>get_permalink(get_page_by_path('trade/trade-resources'))));
			    }    		
	    	}
	    	else{
	    		echo json_encode( array( 'loggedin'=>false, 'message'=>__( 'Your Account is Not Approved !' )));
	    	}
    die();
}
