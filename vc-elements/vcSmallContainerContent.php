<?php
/*
Element Description: VC Template
*/

// Element Class

class vcSmallContainerContent extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_small_container_content_map' ] );
        add_shortcode( 'vc_small_container_content', [ $this, 'vc_small_container_content' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_small_container_content_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Small Container Content",
                'base'        => 'vc_small_container_content',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Small container content",
                'icon'        => get_template_directory_uri() . '/img/chnnyc-icon.png',
                'params' => [
                    
                    [
                        'type'        => 'animation_style',
                        'heading'     => 'Animación',
                        'param_name'  => 'animation',
                        'description' => 'Choose your animation',
                        'admin_label' => false,
                        'weight'      => 0
                    ],

                    [
                        'type'        => 'textfield',
                        'value'       => '',
                        'heading'     => 'Title',
                        'param_name'  => 'title',
                        'admin_label' => true
                    ],

                    [
                        'type'        => 'textfield',
                        'value'       => '',
                        'heading'     => 'Subtitle',
                        'param_name'  => 'subtitle',
                        'admin_label' => false
                    ],

                    [
                        'type'        => 'textarea_html',
                        'value'       => '',
                        'heading'     => 'Content',
                        'param_name'  => 'content',
                        "description" => "Content of the section"
                    ],

                ]
            ]
        );

    }

    
    public function vc_small_container_content( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation' => '',
                    'title'     => '',
                    'subtitle'  => ''
                ],
                $atts
            )
        ); 


        $html = '
            <div class="row no-gutters content-centered">
                <div class="col-10 col-md-4 mx-auto order-2 order-md-1">
                    <h2 class="text-center">'. $subtitle .'</h2>
                </div>
            </div>
            <div class="row no-gutters content-centered">
                <div class="col-10 col-md-5 mx-auto order-2 order-md-1">
                    <h1 class="text-center">'. $title .'</h1>
                    <div class="content py-4">
                        '. apply_filters( "the_content", $content ) .'
                    </div>
                </div>
            </div>';


        $html = '
            <section class="'. $background .' vc-custom vc-small-container-content my-3 py-3 my-md-5 py-md-5">
                <div class="container">
                    '. $html .'    
                </div>
            </section>
        ';

        return $html;

    }

}

new vcSmallContainerContent();

?>
