<?php


function function_load_javascript_css() {
	
    global $post;

    if( is_page() || is_single() )
    {
        switch($post->post_name) 
        { 
            case 'loclunch-events':   
                if(!(is_user_logged_in( )))
                wp_enqueue_script( "js", "/wp-content/themes/oceanwp-child/loclunch/assets/js/js.js", array("jquery"), "", false );
                break;

            case 'user':   
                wp_enqueue_style( 'profile', '/wp-content/themes/oceanwp-child/loclunch/ultimateMemberANDEventManager/assets/css/profile.css');
                wp_enqueue_script( "function_show_url_video", "/wp-content/themes/oceanwp-child/loclunch/eventManager/js/function_show_url_video.js", array("jquery"), "", false );
                break;
            
            case 'post-loclunch-event':
                wp_enqueue_style( 'profile', '/wp-content/themes/oceanwp-child/loclunch/eventManager/assets/css/postEvent.css');
                wp_enqueue_script( "function_show_url_video", "/wp-content/themes/oceanwp-child/loclunch/eventManager/js/function_show_url_video.js", array("jquery"), "", false );
                break;
            case 'ambassador-form':
                wp_enqueue_script( 'function_dropdown_ambassador_form', "/wp-content/themes/oceanwp-child/loclunch/ambassadorForm/assets/js/function_dropdown_ambassador_form.js", array( 'jquery' ) );
                wp_localize_script( 'function_dropdown_ambassador_form', 'tc_csca_auto_ajax', array( 'ajax_url' => admin_url('admin-ajax.php'),'nonce'=>wp_create_nonce('tc_csca_ajax_nonce')) );
                break;
        }
    } 
}

add_action( 'wp_enqueue_scripts', 'function_load_javascript_css' );


?>