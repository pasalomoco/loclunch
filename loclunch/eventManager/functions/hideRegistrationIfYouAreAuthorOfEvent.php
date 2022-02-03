<?php

function function_hide_registration_if_you_are_ambassador_author($method, $post){

    if(get_current_user_id( ) == $post->post_author){
        $method->type = false;
        return $method;
    }
    return $method;

}


add_filter(  "display_event_registration_method", "function_hide_registration_if_you_are_ambassador_author", 99, 2 );




?>