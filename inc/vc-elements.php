<?php
// Before VC Init
add_action( 'vc_before_init', 'vc_before_init_actions' );

function vc_before_init_actions() {

	// Modulo template
    require_once( get_stylesheet_directory() . '/vc-elements/vcIntro.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcYellowBlock.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcFullWidthContainer.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcTwoColumnListContainer.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcPopUp.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcYellowBlockWithButtons.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcFullWidthButton.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcTwoColumnImageContainer.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcAccordionLinks.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcContactForm.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcTwoColumnContactForm.php' );
    
}