<?php

function wpem_custom_theme_setup(){
   
    add_theme_support( 'event-manager-templates' );
   
   }

add_action('after_setup_theme','wpem_custom_theme_setup');



?>

