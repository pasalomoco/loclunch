<?php
function show_more_information_in_members_grid( $user_id, $args ) {

    $countEventsByUser = count_user_posts($user_id, "event_listing");
    $country = get_user_meta( $user_id, "country" );
    $city = get_user_meta( $user_id, "city" );
    $state = get_user_meta( $user_id, "state_province" );
    if(!empty($countEventsByUser)){
        include ULTIMATE_MEMBER."templates/members/show_ambassador_role.php";
        include ULTIMATE_MEMBER."templates/members/show_events_by_ambassador.php";
    }
  
}


add_action( 'um_members_after_user_name', 'show_more_information_in_members_grid', 10, 2 );

?>