<?php
function um_custom_validate_mobile_number( $key, $array, $args ) {
	if ( isset( $args[$key] ) && !preg_match('/^[6-9]\d{9}$/', $args[$key]) ) {
		UM()->form()->add_error( $key, __( 'Please enter valid Mobile Number.', 'ultimate-member' ) );
	}
}
add_action( 'um_custom_field_validation_mobile_number', 'um_custom_validate_mobile_number', 30, 3 );

?>