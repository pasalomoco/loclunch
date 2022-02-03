<?php

function redirect_to_profile(){
    global $wp;
    $url= add_query_arg( $wp->query_vars, home_url( $wp->request ) );
    echo "<script>location.href='$url'</script>";
}

function subscribe_or_unsubscribe ($subscription){  

    if(isset($_GET["localizationId"]) && isset($_GET["localizationType"])){
            $localization = $_GET["localizationType"];
            $key_to_eliminate = array_search($_GET["localizationId"], $subscription[0][ $localization]);
            unset($subscription[0][ $localization][$key_to_eliminate]);
            $subscription[0][ $localization] = array_values($subscription[0][ $localization]);
            $keys = ['continent', 'country', 'state', 'city'];
            $values = [ $subscription[0]['continent'],  $subscription[0]['country'], $subscription[0]['state'], $subscription[0]['city']];
            $the_meta_array = array_combine($keys, $values);
            $update = update_user_meta( get_current_user_id(), 'subscriptions', $the_meta_array );
            redirect_to_profile(); 
    }
}

function get_all_subscriptions (){

    $user =  get_user_by("id",um_profile_id() );
    if(  get_current_user_id() == (int) $user->ID) {
        $subscription = get_user_meta( get_current_user_id(), "subscriptions", false );
        if(!empty($subscription)){
            subscribe_or_unsubscribe($subscription);
            include(ULTIMATE_MEMBER_AND_EVENT_MANAGER.'/templates/subscriptionsProfileTemplate.php');
        }else{
            echo "<h3>Without subscriptions</h3>";
        }
    }

}

function get_user_from_um_profile_id( ) {

    $user =  get_user_by("id",um_profile_id() );
    return $user;

}

function hide_events_if_user_is_not_ambassador( $tabs ) {

    $user =  get_user_by("id",um_profile_id() );
    if ($user){
        if (! (in_array( 'ambassador', (array) $user->roles )) ) {
            unset($tabs["events"]);
        } 
        return $tabs;
    }
    return $tabs;

}


function event_registrations_by_user( $args) {

    $user = get_user_from_um_profile_id();
    $args["meta_value"] = (int) $user->ID;

    return $args;

}



function function_user_is_not_login($actions, $event ){

    $user = get_user_from_um_profile_id();
    if(  get_current_user_id() == (int) $user->ID) {

        return $actions;
    }
    unset($actions["edit"]);
    unset($actions["mark_cancelled"]);
    unset($actions["duplicate"]);
    unset($actions["delete"]);
    return $actions;

}

function get_events_by_user_um_profile($events ){

    $user = get_user_from_um_profile_id();

    $events["author"] =  $user->ID;

    return $events;

}

function function_ambassador_dashboard_panel( $menus ){

    unset($menus["organizer_dashboard"]);
    unset($menus["registration"]);
    unset($menus["event_dashboard"]);
    
    return $menus;

}

add_shortcode( "subscriptions", "get_all_subscriptions" );

add_filter( "wpem_dashboard_menu", "function_ambassador_dashboard_panel", 99, 1 );

add_filter( "event_manager_get_dashboard_events_args", "get_events_by_user_um_profile", 1, 1 ); 

add_filter( "event_manager_my_event_actions", "function_user_is_not_login", 2, 2 );    
    
add_filter(  'um_user_profile_tabs', 'hide_events_if_user_is_not_ambassador', 10, 1 );

add_action( "um_profile_before_header", "event_registrations_by_user", 1 ); 

add_filter(  'event_manager_event_registrations_past_args', 'event_registrations_by_user', 2, 1 );


// function test($current_action, $atts ){

//     var_dump($current_action);
//     var_dump($atts);

// }

// function testing($menus ){

//     var_dump($menus);

// }



// add_action( "wpem_dashboard_menu_before", "testing", 2 , 1 ); 
// add_action( "event_manager_event_dashboard_content_", "test", 1 , 2 );

?>