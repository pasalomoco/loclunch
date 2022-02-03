<?php

// https://stackoverflow.com/questions/64558220/programatically-add-form-title-to-all-contact-form-7-forms
// Insert ID in Contact Form 7 DataBase
function function_get_user_id($hidden){
	$user = get_current_user_id();
	$form = wpcf7_get_current_contact_form();
	$hidden['user_id'] = $user; 
	$hidden['approve_ambassador'] = "PENDING"; 
	return $hidden;
}

function function_add_role_ambassador_form_already_sent($form_id){
	global $wpdb;
	$table_name = $wpdb->prefix . 'db7_forms';
	$user_id = apply_filters( 'determine_current_user', false );
	wp_set_current_user( $user_id );
	$u = new WP_User( $user_id );  
    $u->add_role(  'ambassadorformalreadysent' );
	$resultado = $wpdb->query( "UPDATE $table_name SET user_id = '$user_id' WHERE form_id='$form_id' " );
	
}

add_action("cfdb7_after_save_data", "function_add_role_ambassador_form_already_sent");
   
add_filter('wpcf7_form_hidden_fields', 'function_get_user_id');


?>