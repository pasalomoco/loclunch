<?php 
add_action('wp_ajax_tc_csca_get_countries','tc_csca_get_countries');
add_action("wp_ajax_nopriv_tc_csca_get_countries", "tc_csca_get_countries");
function tc_csca_get_countries() {
    check_ajax_referer( 'tc_csca_ajax_nonce', 'nonce_ajax' );
    global $wpdb;
    if(isset($_POST["continent"])){
    $continent=sanitize_text_field($_POST["continent"]);
    }
    $countries = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."countries where continent_id=%1s order by name asc", $continent) );
    echo json_encode($countries);
    wp_die();
}
add_action('wp_ajax_tc_csca_get_states','tc_csca_get_states');
add_action("wp_ajax_nopriv_tc_csca_get_states", "tc_csca_get_states");
function tc_csca_get_states() {
    check_ajax_referer( 'tc_csca_ajax_nonce', 'nonce_ajax' );	
    global $wpdb;
    if(isset($_POST["cnt"])){
    $cid=sanitize_text_field($_POST["cnt"]);
    }
    $states = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."state where country_id=%1s order by name asc", $cid) );
    echo json_encode($states);
    wp_die();
}
add_action('wp_ajax_tc_csca_get_cities','tc_csca_get_cities');
add_action("wp_ajax_nopriv_tc_csca_get_cities", "tc_csca_get_cities");
function tc_csca_get_cities() 
{
check_ajax_referer( 'tc_csca_ajax_nonce', 'nonce_ajax' );
global $wpdb;
if(isset($_POST["sid"]))
{
$sid=sanitize_text_field($_POST["sid"]);
}
$cities = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."city where state_id=%1s order by name asc", $sid));
echo json_encode($cities);
wp_die();
}
?>