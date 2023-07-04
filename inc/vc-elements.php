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
    require_once( get_stylesheet_directory() . '/vc-elements/vcIconBanner.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcTeam.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcTwoColumnTeam.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcSmallContainerContent.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcThreeColumnBlock.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcContactIntro.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcNested.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcNestedChild.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcLocations.php' );
    require_once( get_stylesheet_directory() . '/vc-elements/vcImagesSlider.php' );
    
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_Vc_Nested extends WPBakeryShortCodesContainer {
  }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_Vc_Nested_Child extends WPBakeryShortCode {
  }
}