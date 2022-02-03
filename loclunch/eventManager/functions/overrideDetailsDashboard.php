<?php

add_filter( 'event_manager_event_dashboard_columns', 'add_assign_to_columns' );
function add_assign_to_columns( $columns ) 
{
    unset($columns['registrations']);
    $columns['attendees'] = __( 'Attendees', 'wp-event-manager-registrations' );
    return $columns;
}
 
add_action('event_manager_event_dashboard_column_attendees','assign_to_column');
function assign_to_column( $event ) 
{
    global $post;
 
    echo ( $count = get_event_registration_count( $event->ID ) ) ? '<p>' . $count . '</p>' : '&ndash;';
}



?>