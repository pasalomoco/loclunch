<?php

add_action('event_manager_event_dashboard_event_filter_start', 'my_theme_custom_filter');
function my_theme_custom_filter()
{ ?>
    <div class="wpem-events-filter-block">
        <?php $search_location = isset($_GET['search_location']) ? $_GET['search_location'] : ''; ?>
        <div class="wpem-form-group"><input name="search_location" id="search_location" type="text" value="<?php echo $search_location; ?>" placeholder="<?php _e('Location','wp-event-manager');?>"></div>
    </div>
<?php }
add_filter( 'event_manager_get_dashboard_events_args', 'my_theme_custom_search', 10 );
function my_theme_custom_search($args)
{
    if( isset($_GET['search_location']) && !empty($_GET['search_location']) )
    {
        $location_meta_keys = array( 'geolocation_formatted_address', '_event_location', 'geolocation_state_long', 'state_province', 'city', 'state_province' );
        $location_search    = array( 'relation' => 'OR' );
        foreach ( $location_meta_keys as $meta_key ) {
            $location_search[] = array(
                'key'     => $meta_key,
                'value'   => $_GET['search_location'],
                'compare' => 'like'
            );
        }
        $args['meta_query'][] = $location_search;
    }
    return $args;
}

function change_dashboard_panel( $menu ){

   $menu["wpem_mailchimp"] = array();
   $menu["wpem_hubspot_crm"] = array();
   
}

add_action( "wpem_dashboard_menu_before", "change_dashboard_panel", 9999, 1 );



?>