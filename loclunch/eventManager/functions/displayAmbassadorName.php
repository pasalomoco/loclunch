<?php


function function_display_ambassador_name( $data, $post ){

    $authorFirstName = get_user_meta ($post->post_author,'last_name');  
    return $authorFirstName[0];

}

add_filter( "display_organizer_name", "function_display_ambassador_name", 1, 2 );



?>