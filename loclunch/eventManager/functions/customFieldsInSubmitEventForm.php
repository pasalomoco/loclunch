<?php

function function_custom_event_field( $fields ){
    $fields["event"]["event_online"] ["default"] = "yes";
    unset($fields["event"]["organizer"]);
    unset($fields["event"]["venue"]);
    return $fields;
}

function frontend_add_custom_field( $fields ) {
    $ambassadors = get_users( array( 'role__in' => array( 'ambassador') ) );
    $allAmbassadors = array();
    foreach ( $ambassadors as $user ) {
        if( !(get_current_user_id() ==  $user->ID )){   
            $allAmbassadors[$user->display_name] = ucwords($user->display_name);
        }
        
    }

      $fields['event']['event_coambassadors'] = array(
        'label'	=> __('Add another/s Co-Ambassadors to the event','wp-event-manager'),							      	
        'type'  => 'multiselect',
        'options'  =>  $allAmbassadors,
        'priority'    => 21,
        'required'=> false
      );
    unset($fields["event"]["organizer"]);
    unset($fields["event"]["venue"]);


    return $fields;
  }

  function admin_add_country_field( $fields ) {
    $ambassadors = get_users( array( 'role__in' => array( 'ambassador') ) );
    $allAmbassadors = array();
    foreach ( $ambassadors as $user ) {
        if( !(get_current_user_id() ==  $user->ID )){   
            $allAmbassadors[$user->display_name] = ucwords($user->display_name);
        }
        
    }

      $fields['event']['event_coambassadors'] = array(
        'label'	=> __('Add another/s Co-Ambassadors to the event','wp-event-manager'),							      	
        'type'  => 'multiselect',
        'options'  =>  $allAmbassadors,
        'priority'    => 21,
        'required'=> false
      );
  
    return $fields;
  }
	
  	
add_filter( 'event_manager_event_listing_data_fields', 'admin_add_country_field' , 1, 1);
add_filter( 'submit_event_form_fields', 'frontend_add_custom_field', 1, 1 );
add_filter( "submit_event_form_fields", "function_custom_event_field", 2 , 1);



?>