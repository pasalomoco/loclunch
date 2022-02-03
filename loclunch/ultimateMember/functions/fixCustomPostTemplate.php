<?php

add_filter("um_locate_template","um_120921_locate_template_in_theme", 999999, 3 );
function um_120921_locate_template_in_theme( $template, $template_name, $path ){
	$theme_file = get_stylesheet_directory() . "/ultimate-member/templates/".basename($template_name);
	
			if ( file_exists( $theme_file ) ) {
				return $theme_file;
			}
	
	return $template;
}


?>