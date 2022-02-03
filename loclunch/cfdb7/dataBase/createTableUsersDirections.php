<?php

// Needed in admin cfdb7 to manage ambassadors forms
// function_create_table_users_directions();
function function_create_table_users_directions(){

    global $wpdb;
    $table_name = $wpdb->prefix . 'users_directions';
  
    if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {

            $sql= "CREATE TABLE IF NOT EXISTS $table_name (
                `ID` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `user_id` bigint(20) UNSIGNED NOT NULL ,
                `country` varchar(100),
                `state_province` varchar(255),   
                `city` varchar(255),
                `active` boolean
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
            $wpdb->query("ALTER TABLE $table_name 
            ADD CONSTRAINT `unique_user_id_directions` FOREIGN KEY (`user_id`) REFERENCES `wp_users`(`ID`) 
            ON DELETE CASCADE ON UPDATE CASCADE");
    }
  
}



?>