<?php
function event_post_type( $args = array() ) {

$args['post_type'] = 'event_listing';

return $args;

}

add_filter( 'um_profile_query_make_posts', 'event_post_type', 12, 1 );
?>