<?php

function get_event_url_meeting( $post = null ) {
  
    $post = get_post( $post );
    if ( $post->post_type !== 'event_listing' ) 
        return '';
    $event_url_meeting   = $post->_url_meeting;
    if(!empty($event_url_meeting)){
        return apply_filters( 'display_event_url_meeting', $event_url_meeting, $post );
    }else{
        return false;
    }
   
}
  
function display_event_url_meeting( $post = null ) {
$event_url_meeting = get_event_url_meeting( $post );
    if(!empty($event_url_meeting)){
        echo $event_url_meeting;
    }
}

function get_event_city( $post = null ) {
  
    $post = get_post( $post );
    if ( $post->post_type !== 'event_listing' ) 
        return '';
    $event_city   = $post->city;
    if(!empty($event_city)){
        return apply_filters( 'display_event_city', $event_city, $post );
    }else{
        return false;
    }
   
}
  
function display_event_city( $before = '', $after = '', $echo = true, $post = null ) {
$event_city = get_event_city( $post );
$city = "";
if (is_array($event_city)){
    foreach ($event_city as $value){
        $city .= $value."<br>";
    }
}
if ( $echo )
    if(!empty($city)){
        $city = $before . $city . $after;
        echo $city;
    }
else
    return $city;
}

function get_event_state_province( $post = null ) {
  
    $post = get_post( $post );
    if ( $post->post_type !== 'event_listing' ) 
        return '';
    $event_state_province   = $post->state_province;
    if(!empty($event_state_province)){
        return apply_filters( 'display_event_state_province', $event_state_province, $post );
    }else{
        return false;
    }
   
}
  
function display_event_state_province( $before = '', $after = '', $echo = true, $post = null ) {
$event_state_province = get_event_state_province( $post );
$event_state_province_final ="";
if ( $echo )
    if(!empty($event_state_province)){
        $event_state_province_final = $before . $event_state_province . $after;
        echo $event_state_province_final;
    }
}

function function_show_more_information_event_listing( $postID ){

    $author_id = get_post_field ('post_author', $postID);
    $ambassadorName =  get_the_author_meta( "user_login", $author_id );
    include(EVENT_MANAGER.'/templates/listingEvents/show_more_information_event_listing.php');
    
}

add_action( "wpem_event_listing_event_detail_end", "function_show_more_information_event_listing", 1);






?>