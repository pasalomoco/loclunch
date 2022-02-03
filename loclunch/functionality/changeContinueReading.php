<?php


/**
 * Change the Continue Reading text on Blog Post Entries
 */
function myprefix_post_readmore_link_text() {
	return 'See the loclunch event';
}

add_filter( 'ocean_post_continue_reading', 'myprefix_post_readmore_link_text' );

/**
* Change the Continue Reading text on Search Results
*/

function myprefix_search_readmore_link_text() {
	return 'See the loclunch event';
}
	
add_filter( 'ocean_search_continue_reading', 'myprefix_search_readmore_link_text' );


?>