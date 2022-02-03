<?php
add_filter("um_prepare_user_query_args","um_custom_prepare_user_query_args", 9999 );
function um_custom_prepare_user_query_args( $args ) {

    if($args['role__in'][0] == "um_ambassador"){
        $args['role__in'][0] = "ambassador";
        $args['role__not_in'][0] = "locluncher";
    }
    if($args['role__in'][0] == "um_locluncher"){
        $args['role__in'][0] = "um_locluncher";
        $args['role__not_in'][0] = "ambassador";
    }
    if($args['role__in'][0] == "um_locluncher" && $args['role__in'][1] == "um_ambassador"){
        $args['role__in'][0] = "um_locluncher";
        $args['role__not_in'][0] = "";
    }

	return $args;
}
?>