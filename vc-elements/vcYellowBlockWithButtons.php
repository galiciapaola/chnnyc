<?php
/*
Element Description: VC Template
*/

// Element Class

class vcYellowBlockWithButtons extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_yellow_block_with_buttons_map' ] );
        add_shortcode( 'vc_yellow_block_with_buttons', [ $this, 'vc_yellow_block_with_buttons' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_yellow_block_with_buttons_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Yellow Block w/ Buttons",
                'base'        => 'vc_yellow_block_with_buttons',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Yellow block with buttons",
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
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'links',
                        'params' => [

                            [
                                "type"        => "vc_link",                 
                                "class"       => "",                       
                                "heading"     => "Link",                 
                                'admin_label' => false,
                                "param_name"  => "link",              
                                "value"       => '',                       
                                "description" => "Link for the CTA"
                            ],

                        ]
                    ]
                ]
            ]
        );

    }

    
    public function vc_yellow_block_with_buttons( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation' => '',
                    'title'     => '',
                    'links'   => '',
                ],
                $atts
            )
        ); 

        $html_buttons = '';
        $html_title = '';
        $links = vc_param_group_parse_atts( $links );

        if ( ! empty( $links ) ) {

            foreach ($links as $button) {
                $link = vc_build_link( $button['link'] );
                $html_buttons .= '

                    <a href="'. $link['url'] .'" target="'. $link['target'] .'" class="btn btn-secondary d-inline-block">'. $link['title'] .'</a>
                    
                ';
            }
            
        }

        if ( ! empty( $title ) ) {
            $html_title = '
                <h2>'. $title .'</h2>
            ';
        }

        $html = '
            <section class="bg-primary vc-custom vc-yellow-block-with-buttons my-3 py-3 my-md-5 py-md-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-10 mx-auto">
                            '. $html_title .'
                            <p>'. $html_buttons .'</p>
                        </div>
                    </div>
                </div>
            </section>
        ';

        return $html;

    }

}

new vcYellowBlockWithButtons();

?>
