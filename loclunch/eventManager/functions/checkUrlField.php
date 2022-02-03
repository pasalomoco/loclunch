<?php


function function_url_field ($fields, $values){


    if($values["event"]["event_online"] == "no"){
        unset($fields["event"]["url_meeting"]);
    }
    return $fields;

}

add_filter( "before_submit_event_form_validate_fields", "function_url_field", 1, 2 );

?>