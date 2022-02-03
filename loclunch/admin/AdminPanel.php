<?php

function get_blog_timezone() {

    $tzstring = get_option( 'timezone_string' );
    $offset   = get_option( 'gmt_offset' );
    if( empty( $tzstring ) && 0 != $offset && floor( $offset ) == $offset ){
        $offset_st = $offset > 0 ? "-$offset" : '+'.absint( $offset );
        $tzstring  = 'Etc/GMT'.$offset_st;
    }

    if( empty( $tzstring ) ){
        $tzstring = 'UTC';
    }

    $timezone = new DateTimeZone( $tzstring );
    return $timezone; 
}

add_filter('bulk_actions-users', function($actions) {
    $actions['eventsControl'] = __('Events Control');
    return $actions;
});

add_filter('handle_bulk_actions-users', function($redirect, $action, $ids) {

    $time = new DateTime( null, get_blog_timezone() );
    
    foreach ($ids as $id) {
        $args = array(
            'post_type' => 'event_listing',
            'author'        =>  $id, 
            'orderby'       =>  'post_date',
            'order'         =>  'ASC',
            'posts_per_page' => -1
        );
        $currentUserPosts = get_posts( $args);
        if (!empty( $currentUserPosts)) {
            foreach($currentUserPosts as $posts){
                $fechaEntrada = new DateTime($posts->post_date);
                $interval = $time->diff($fechaEntrada);
                //https://stackoverflow.com/questions/676824/how-to-calculate-the-difference-between-two-dates-using-php?page=1&tab=votes#tab-top
                if ( $interval->y != "0" || $interval->m != "0") {
                    $warning = get_user_meta( $id, 'warning_control', false );
                    if(empty($warning)){ 
                        $warning = 1;
                        add_user_meta( $id, 'warning_control', $warning );
                        send_email_with_events_control_notification($id, $interval, $warning);
                    }else{
                        (int) $warning[0]++;
                        update_user_meta(  $id, 'warning_control', $warning[0] );
                        send_email_with_events_control_notification($id, $interval,$warning);                 
                    }
                    break;  
                }
            }
        }  
    }
    return $redirect;
}, 10, 3);

function send_email_with_events_control_notification ($id, $interval, $warning){

    
    if ( $interval->y == "0") {
    $year = "";      
    }else if ($interval->y == "1"){
        $year = $interval->y. " Year";  
    }else{
        $year = $interval->y. " Years";
    }
    if ( $interval->m == "0") {
        $mounth = "";      
    }else if ($interval->m == "1"){
        $mounth = $interval->m. " Mounth";  
    }else{
        $mounth = $interval->m. " Mounths";  
    }
    $userInfo = get_userdata($id);
    $from = "testloclunch@gmail.com";
    $to = $userInfo->user_email;
    $subject = "It's been along time since you don't publish LocLunch events...";
    $message = "<h1> it's been  $year  $mounth since you posted. This is your ".$warning[0]. "º advice.</h1>";
    $headers = "From:" . $from;
    wp_mail($to,$subject,$message, $headers);        
}

function send_email_check_ambassador_account_notice() {
    if (isset($_GET["action"]) && ($_GET["action"]) == "eventsControl") ?>
     <div data-dismissible="disable-event-control-forever" class="updated notice notice-success is-dismissible">
        <p><?php _e( 'Events Control has been done successfully!', 'sample-text-domain' ); ?></p>
    </div>
     <?php
 }
 add_action( 'admin_notices', 'send_email_check_ambassador_account_notice' );

function ambassador_actions( $actions, $user ) {

    if ( in_array( 'ambassadorformalreadysent', (array) $user->roles ) ) {
        global $wpdb;
        $user =$user->ID;
        $table_db7_forms = $wpdb->prefix.'db7_forms';
        $result = $wpdb->get_row("SELECT form_id,form_post_id FROM `$table_db7_forms` WHERE user_id= '$user' LIMIT 1");
        $form_post_id = $result->form_post_id;
        $form_id = $result->form_id;
        $actions['ambassador_form'] = "<a class='new_action' href='" . admin_url( "admin.php?page=cfdb7-list.php&fid=$form_post_id&ufid=$form_id") . "'>" . esc_html__( 'Ambassador form') . "</a>";
    }
    unset($actions["view_info"]);
    return $actions;
}
add_filter('user_row_actions', 'ambassador_actions', 10, 2);




?>