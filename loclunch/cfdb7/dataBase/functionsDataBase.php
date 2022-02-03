<?php


function get_name_continent_country_state_city_by_id ($direction, $id){
    global $wpdb;
    $table_direction = $wpdb->prefix.$direction;
    $query = "select name from $table_direction WHERE id = '$id'";
    $results = $wpdb->get_row($query);
    return $results->name;
}


function get_id_continent_country_state_city ($direction, $name){
    global $wpdb;
    $table_direction = $wpdb->prefix.$direction;
    $query = "select id from $table_direction WHERE name = '$name'";
    $results = $wpdb->get_row($query);
    return $results->id;
}


?>