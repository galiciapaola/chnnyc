<?php
// Before VC Init
add_action( 'vc_before_init', 'vc_before_init_actions' );

function vc_before_init_actions() {

	// Modulo template
    require_once( get_stylesheet_directory() . '/vc-elements/vcTemplate.php' );
    
}