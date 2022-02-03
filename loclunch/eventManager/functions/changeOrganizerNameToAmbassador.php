<?php

function function_change_organizer_name_to_ambassador( $data ){

    $data["labels"]["name"] = "Ambassadors";
    $data["labels"]["singular_name"] = "Ambassador";
    $data["labels"]["add_new_item"] = "Add Ambassador";
    $data["labels"]["edit_item"] = "Edit Ambassador";
    $data["labels"]["featured_image"] = "Ambassador Logo";
    $data["labels"]["set_featured_image"] = "Set Ambassador Logo";
    $data["labels"]["remove_featured_image"] = "Remove Ambassador Logo";
    $data["labels"]["use_featured_image"] = "Use as Ambassador logo";
 
    return $data;
}

add_filter( "register_event_organizer_post_type", "function_change_organizer_name_to_ambassador", 1 );


?>