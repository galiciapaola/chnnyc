<?php
/*
Element Description: VC Template
*/

// Element Class

class vcLocations extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_template_map' ] );
        add_shortcode( 'vc_template', [ $this, 'vc_template' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_template_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Template",
                'base'        => 'vc_template',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Description",
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
                        "type"        => 'textarea_html',
                        "class"       => '',
                        "heading"     => 'Content',
                        "param_name"  => 'content',
                        "value"       => '', 
                        "description" => "Content of the module"
                    ],

                    [
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'slides',
                        'params' => [

                            [
                                'type'        => 'textfield',
                                'value'       => '',
                                'heading'     => 'Title',
                                'param_name'  => 'title',
                                'admin_label' => true
                            ],
                            
                            [
                                'type'       => 'textfield',
                                'value'      => '',
                                'heading'    => 'Subtitle',
                                'param_name' => 'subtitle',
                            ],

                            [
                                "type"        => "attach_image",
                                "heading"     => "Image",
                                "description" => "Image for the module ( recommended 16:9 )",
                                "param_name"  => "image",
                                "value"       => "",
                            ]

                        ]
                    ],

                    [
                        'type'           => 'dropdown',
                        'heading'        => "Dropdown",
                        'param_name'     => 'dropdown',
                        'value'          => [
                            "Option 1" => 'option-1',
                            "Option 2" => 'option-2'
                        ],
                        "description"    => "Choose an option"
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

                    [
                        "type"        => "attach_image",
                        "heading"     => "Image",
                        "description" => "Image",
                        "param_name"  => "single-image",
                        "value"       => "",
                    ],

                    [
                        "type"        => "attach_images",
                        "heading"     => "Imágenes",
                        "description" => "Images for the module ( recommended 16:9 )",
                        "param_name"  => "images",
                        "value"       => "",
                    ],

                ]
            ]
        );

    }

    
    public function vc_template( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation' => '',
                    'slides'    => '',
                ],
                $atts
            )
        ); 

        $image = wp_get_attachment_image_src( $image, 'full' );
        $link = vc_build_link( $link );
        $slides = vc_param_group_parse_atts( $slides );

        $html = '
            <div class="row no-gutters">
                <div class="col-12">
                    '. apply_filters( "the_content", $content ) .'
                </div>                       
            </div>  
            ';

        return $html;

    }

}

new vcLocations();

?>
