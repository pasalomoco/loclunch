<?php

    function oceanwp_child_event_allowed_comment( $open, $post_id ) 
    {
        $post_type = get_post_type( $post_id );
    
        if ( $post_type == 'event_listing' ) {
            if(is_user_logged_in(  )){
                $open = true;
            }
           
        }
    
        return $open;
    }
    add_filter( 'comments_open', 'oceanwp_child_event_allowed_comment', 10 , 2 );

?>