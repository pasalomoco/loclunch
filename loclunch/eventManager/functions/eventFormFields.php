<?php

function sent_email_template ($idEvent, $email, $name, $localization){
    $url = get_permalink($idEvent);
    $subject = "New event publish in your $localization ";
    $message = "<h2> You can see the event in this URL:</h2>";
    $message .= $url;
    $headers = array("From: testloclunch@gmail.com",
    "Reply-To: $email",
    "X-Mailer: PHP/" . PHP_VERSION
    );
    $headers = implode("\r\n", $headers);
    wp_mail($email,$subject,$message, $headers);  
}

function get_all_subscriptions_from_all_users_and_search_match ($idEvent, $currentAmbassadorLocalizations){
    $users = get_users( array( 'fields' => array( 'ID' ) ) );
    $match = false;
    foreach($users as $user){
      
        $subscription = get_user_meta( $user->ID, "subscriptions", false );
        if(!empty($subscription)){
            if(!empty($subscription[0]['city'])){
                foreach($subscription[0]['city'] as $value){

                    if($currentAmbassadorLocalizations[3] == $value){
                        $user_info = get_userdata($user->ID);
                        $email = $user_info->user_email;
                        sent_email_template($idEvent, $email, $value, "city");
                        $match = true;
                        break;
                    }
                }
            }
            if(!empty($subscription[0]['state'])){
                foreach($subscription[0]['state'] as $value){
                    if(!$match){
                        if($currentAmbassadorLocalizations[2] == $value){
                            $user_info = get_userdata($user->ID);
                            $email = $user_info->user_email;
                            sent_email_template($idEvent, $email, $value, "state");
                            $match = true;
                            break;
                        }
                    }
                   
                }
            }
            if(!empty($subscription[0]['country'])){
                foreach($subscription[0]['country'] as $value){
                    if(!$match){
                        if($currentAmbassadorLocalizations[1] == $value){
                            $user_info = get_userdata($user->ID);
                            $email = $user_info->user_email;
                            sent_email_template($idEvent, $email, $value, "country");
                            $match = true;
                            break;
                        }
                    }
                }
            }
            if(!empty($subscription[0]['continent'])){
                foreach($subscription[0]['continent'] as $value){
                    if(!$match){
                        if($currentAmbassadorLocalizations[0] == $value){
                            $user_info = get_userdata($user->ID);
                            $email = $user_info->user_email;
                            sent_email_template($idEvent, $email, $value, "continent");
                            $match = true;
                            break;
                        }
                    }
                }
            }
        }
    }

}


// Create a category (country) , tpye (countinent), taxonomy state / province and taxonomy city into post
function function_add_continent_and_country_to_event( $idEvent) {
    $user = wp_get_current_user();
    $meta = get_user_meta( $user->ID);
    if (!(empty( $meta["continent"][0]))) {
            $nameContinent = get_name_continent_country_state_city_by_id("continent", $meta["continent"][0]);
            $term = term_exists($nameContinent, "event_listing_type" );
            if ( $term !== 0 && $term !== null ) {
                $check = wp_set_object_terms( $idEvent, intval( $term["term_id"] ), 'event_listing_type' );
 
            }else{
                $idContinentType = wp_insert_term(
                    $nameContinent,   
                    'event_listing_type', 
                    array(
                        'description' =>  $meta["continent"][0],
                        'slug'        => $nameContinent,
                    )
                );
                $insertContinent = array($idContinentType["term_id"]); 
                wp_set_object_terms( $idEvent, $insertContinent, 'event_listing_type' ); 
                
            }
    }  
    if (!(empty( $meta["country"][0]))) {
        $nameCountry = get_name_continent_country_state_city_by_id("countries", $meta["country"][0]);
        $term = term_exists($nameCountry, "event_listing_category" );
        if ( $term !== 0 && $term !== null ) {
            $check = wp_set_object_terms( $idEvent, intval( $term["term_id"] ), 'event_listing_category' );
        }else{
            $idCountryCategory = wp_insert_term(
                $nameCountry,   
                'event_listing_category', 
                array(
                    'description' => $meta["country"][0],
                    'slug'        => $nameCountry,
                )
            );
            $insertCountry = array($idCountryCategory["term_id"]); 
            $check = wp_set_object_terms( $idEvent, $insertCountry, 'event_listing_category' ); 
        }
    } 
    if (!(empty( $meta["state_province"][0]))) {
        $nameState = get_name_continent_country_state_city_by_id("state", $meta["state_province"][0]);
        $term = term_exists($nameState, "state" );
        
        if ( $term !== 0 && $term !== null ) {
            $check = wp_set_object_terms( $idEvent, intval( $term["term_id"] ), 'state' );
        }else{
            $idStateTaxonomy = wp_insert_term(
                $nameState,   
                'state', 
                array(
                    'description' => $meta["state_province"][0],
                    'slug'        => $nameState,
                )
            );
            $insertState = array($idStateTaxonomy["term_id"]); 
            $check = wp_set_object_terms( $idEvent, $insertState, 'state' ); 
        }
    }
    if (!(empty( $meta["city"][0]))) {
        $nameCity = get_name_continent_country_state_city_by_id("city", $meta["city"][0]);
        $term = term_exists($nameCity, "city" );
        
        if ( $term !== 0 && $term !== null ) {
            $check = wp_set_object_terms( $idEvent, intval( $term["term_id"] ), 'city' );
        }else{
            $idCountryTaxonomy = wp_insert_term(
                $nameCity,   
                'city', 
                array(
                    'description' =>  $meta["city"][0],
                    'slug'        => $nameCity,
                )
            );
            $insertCity = array($idCountryTaxonomy["term_id"]); 
            $check = wp_set_object_terms( $idEvent, $insertCity, 'city' ); 
        }
    }
    $allLocalizations = [$meta["continent"][0], $meta["country"][0], $meta["state_province"][0], $meta["city"][0]];
 
    get_all_subscriptions_from_all_users_and_search_match($idEvent, $allLocalizations);
    
}

add_action("event_manager_event_submitted", "function_add_continent_and_country_to_event", 1);

// add_action( 'event_manager_update_event_data', $this->event_id, $values );

?>