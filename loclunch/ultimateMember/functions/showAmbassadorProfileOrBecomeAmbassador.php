<?php

function function_become_ambassador($user) {
    $ambasadorStatus = get_user_meta($user->ID, "ambassador_status");
    if ( in_array( 'ambassadorformalreadysent', (array) $user->roles ) ) {
        include_once(ULTIMATE_MEMBER.'templates/profile/ambassador_status.php');
    }else{
         // Añadir el ID del post relativo a la página "become an ambassador"
        $url = esc_url( get_permalink( '76' ) );
        include_once(ULTIMATE_MEMBER.'templates/profile/buttom_become_an_ambassador.php');
    }

}

function function_front_ambassador_profile_shortcode() {

    $user =  get_user_by("id",um_profile_id() );
    $userId = $user->ID;
	if ( in_array( 'ambassador', (array) $user->roles ) ) {
        $meta = get_user_meta( $userId);
        include_once(ULTIMATE_MEMBER.'templates/profile/front_ambassador_profile.php');
    } else{
        if(  is_user_logged_in() && $userId == get_current_user_id()){
            function_become_ambassador( $user);
        }
    }
 
}

add_shortcode( "ambassadorProfile", "function_front_ambassador_profile_shortcode" );


?>