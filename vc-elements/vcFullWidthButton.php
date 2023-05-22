<?php
/*
Element Description: VC Template
*/

// Element Class

class vcFullWidthButton extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_full_width_button_map' ] );
        add_shortcode( 'vc_full_width_button', [ $this, 'vc_full_width_button' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_full_width_button_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Full Width Button",
                'base'        => 'vc_full_width_button',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Section with background with a button",
                'icon'        => get_template_directory_uri() . '/img/chnnyc-icon.png',
                'params' => [
                    
                    [
                        "type"        => "vc_link",                 
                        "class"       => "",                       
                        "heading"     => "Link",                 
                        "param_name"  => "link",              
                        "value"       => '',                   
                        "description" => "Link for the CTA"
                    ],

                    [
                        'type'           => 'dropdown',
                        'heading'        => "Background",
                        'param_name'     => 'background',
                        'value'          => [
                            "Transparent" => 'bg-none',
                            "Yellow"      => 'bg-primary',
                            "Blue"        => 'bg-secondary'
                        ],
                        "description"    => "Choose an option"
                    ],

                ]
            ]
        );

    }

    
    public function vc_full_width_button( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation'  => '',
                    'link'       => '',
                    'background' => '',
                ],
                $atts
            )
        ); 

        $link = vc_build_link( $link );
        $html_link = '';


        if( ! empty( $link ) && $link['url'] != "" ){
            $html_link = '
                <p class="text-center mb-0">
                    <a target="'. $link['target'] .'" href="'. $link['url'] .'" class="btn btn-primary mx-auto">'. $link['title'] .'</a>
                </p>
            ';
        }

        $html = '
            <div class="row no-gutters content-centered">
                <div class="col-12  mx-auto order-2 order-md-1">
                    '. $html_link .'
                </div>
            </div>
        ';


        $html = '
            <section class="'. $background .' vc-custom vc-full-width-button my-3 py-3 my-md-5 py-md-3">
                <div class="container">
                    '. $html .'    
                </div>
            </section>
        ';
        

        return $html;

    }

}

new vcFullWidthButton();

?>
