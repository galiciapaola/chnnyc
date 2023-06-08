<?php
/*
Element Description: VC Template
*/

// Element Class

class vcIconBanner extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_icon_banner_map' ] );
        add_shortcode( 'vc_icon_banner', [ $this, 'vc_icon_banner' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_icon_banner_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Icon Banner",
                'base'        => 'vc_icon_banner',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Banner with icons linkables with background",
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
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'icons',
                        'params' => [

                            [
                                'type'        => 'textfield',
                                'value'       => '',
                                'heading'     => 'Title',
                                'param_name'  => 'title',
                                'admin_label' => true
                            ],

                            [
                                "type"        => "attach_image",
                                "heading"     => "Image",
                                "description" => "Image",
                                "param_name"  => "image",
                                "value"       => "",
                            ],

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
                    ]

                ]
            ]
        );

    }

    public function icons( $icons_raw ){
     

        $icons = vc_param_group_parse_atts( $icons_raw );
        $html_icons = '';
        $image_src = '';
        
        if( ! empty( $icons ) ){
            
            foreach ( $icons as $icon ) {

                $image = wp_get_attachment_image_src( $icon['image'], 'icon' );

                if( $image ){
                    $image_src = $image[0];
                }

                $link = vc_build_link( $icon['link'] );

                $html_icons .= '<div class="col-12 col-md-3 mx-auto text-center px-md-3">';
                
                $title_html = ( !empty( $icon['title'] ) ) ? '<p class="text-center">'. $icon['title'] .'</p>' : '';

                if( $link ){
                    
                    $html_icons .= '<a href="'. $link['url'] .'" target="'. $link['target'] .'">
                                        <img src="'. $image_src .'" class="mb-3 mx-auto">
                                        '. $title_html .'
                                    </a>';

                }else{
                    
                    $html_icons .= '<img src="'. $image_src .'" class="mb-3 mx-auto">'. $title_html .'';

                }

                $html_icons .= '</div>';
                    
            }

        }

        return $html_icons;

    }

    
    public function vc_icon_banner( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation'  => '',
                    'icons'      => '',
                    'background' => 'bg-none'
                ],
                $atts
            )
        ); 
        


        $html_icons = self::icons( $icons );


        

        $html = '
            <section class="'. $background .' vc-custom vc-icon-banner my-3 py-3 my-md-5 py-md-5">
                <div class="container">
                    <div class="row no-gutters">
                        '. $html_icons .'    
                        
                    </div>
                    
                </div>
            </section>
        ';

        return $html;

    }

}

new vcIconBanner();

?>
