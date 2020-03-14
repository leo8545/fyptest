<?php
/**
 * Check if provided field is empty or not
 * 
 * @param string $field - Name of the form field
 * 
 * @return bool true if empty, false otherwise
 */
function is_empty( $field_name ) {
	return isset( $_POST[$field_name] ) && !empty( $_POST[$field_name] ) ? false : true; 
}

/**
 * Displays 'selected' if both values are same
 * 
 * @param string $field_name Name of the form field
 * @param string $compare_with Value to compare with
 * 
 * @return void
 */
function checked( $field_name, $compare_with ) {
	echo ( isset($_POST[$field_name]) && $_POST[$field_name] === $compare_with ) ? "selected" : ""; 
}

/**
 * Displays field's posted value
 * 
 * @param string $field_name Name of the form field
 * @param string $default Default value to show
 * 
 * @return void
 */
function print_field_value( $field_name, $default = "" ) {
	echo isset($_POST[$field_name]) ? $_POST[$field_name] : $default;
}