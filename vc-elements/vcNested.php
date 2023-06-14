<?php
/*
Element Description: VC Template
*/

// Element Class

class vcNested extends WPBakeryShortCode {


    function __construct() {

        add_action( 'init', [ $this, 'vc_nested_map' ] );
        add_shortcode( 'vc_nested', [ $this, 'vc_nested' ] );
        $this->template = get_template_directory_uri();


    }

    public function vc_nested_map() {

        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }


        vc_map( array(
            "name"                    => "Two Column Content Container",
            "base"                    => "vc_nested",
            'category'                => 'CHNNYC',
            "as_parent"               => array('only' => 'vc_nested_child'), 
            "content_element"         => true,
            "show_settings_on_create" => false,
            "is_container"            => true,
            'icon'                    => get_template_directory_uri() . '/img/chnnyc-icon.png',
            "params"                  => [],
            "js_view"                 => 'VcColumnView'
        ) );

    }


    public function vc_nested( $atts, $content ) {


        global $post;

        extract(
            shortcode_atts(
                [
                    'animation' => ''
                ],
                $atts
            )
        ); 

        $html = '
            <section class="vc-custom vc-two-column-content-container my-3 py-3 my-md-5 py-md-5">
                <div class="container">
                    <div class="row no-gutters">
                        ' . do_shortcode($content) . '
                    </div>
                </div>
            </section>
            ';

        return $html;

    }

}

new vcNested();

?>
