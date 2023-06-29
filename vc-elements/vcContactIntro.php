<?php
/*
Element Description: VC Template
*/

// Element Class

class vcContactIntro extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_contact_intro_map' ] );
        add_shortcode( 'vc_contact_intro', [ $this, 'vc_contact_intro' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_contact_intro_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Contact Intro",
                'base'        => 'vc_contact_intro',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Contact intro with image for map",
                'icon'        => get_template_directory_uri() . '/img/chnnyc-icon.png',
                'params' => [
                    
                    [
                        'type'        => 'textfield',
                        'value'       => '',
                        'heading'     => 'Title',
                        'param_name'  => 'title',
                        'admin_label' => true
                    ],

                    [
                        'type'        => 'dropdown',
                        'heading'     => "Font Size",
                        'param_name'  => 'font_size',
                        'admin_label' => true,
                        'value'       => [
                            
                            "Normal (h1)"  => '',
                            "Small (h2)"   => 'h2',
                            "Smaller (h3)" => 'h3',

                        ],
                        "description"    => "Choose the font size of the title"
                    ],

                    [
                        'type'        => 'textfield',
                        'value'       => '',
                        'heading'     => 'Subtitle',
                        'param_name'  => 'subtitle',
                        'admin_label' => true
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
                        "type"        => "textarea_raw_html",
                        "heading"     => "Map",
                        "description" => "Google Map Iframe",
                        "param_name"  => "image",
                        "value"       => "",
                    ],

                    [
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'locations',
                        'params' => [

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
                                'heading'     => 'Address',
                                'param_name'  => 'address',
                                'admin_label' => false
                            ],

                            [
                                'type'        => 'textfield',
                                'value'       => '',
                                'heading'     => 'Phone',
                                'param_name'  => 'phone',
                                'admin_label' => false
                            ],

                            [
                                'type'        => 'textfield',
                                'value'       => '',
                                'heading'     => 'Email',
                                'param_name'  => 'email',
                                'admin_label' => false
                            ],

                            [
                                "type"        => "vc_link",                 
                                "class"       => "",                       
                                "heading"     => "Link",                 
                                'admin_label' => false,
                                "param_name"  => "link",              
                                "value"       => '',                       
                                "description" => "Link for the Location"
                            ],

                        ]
                    ],



                ]
            ]
        );

    }

    
    public function locations( $locations = null ){
        
        
        $locations = vc_param_group_parse_atts( $locations );

        $html = '';

        if ( ! empty( $locations )) {
            
            foreach ( $locations as $location ) {

                $html .= '
                    <div class="row no-gutters mb-4">
                        <div class="col-12 col-md-7 mr-auto">';

                $html .= '<h3>'. $location['title'] .'</h3>';
                
                $html .= ( ! empty( $location['address'] ) ) || ( ! empty( $location['phone'] ) ) || ( ! empty( $location['email'] ) ) ? '<p>' : '';

                $html .= ( ! empty( $location['address'] ) ) ? '<span class="d-block"><b>Address:</b> '. $location['address'] .'</span>' : '';
                $html .= ( ! empty( $location['phone'] ) ) ? '<span class="d-block"><b>Phone:</b> '. $location['phone'] .'</span>' : '';
                $html .= ( ! empty( $location['email'] ) ) ? '<span class="d-block"><b>Email:</b> '. $location['email'] .'</span>' : '';
                
                $html .= ( ! empty( $location['address'] ) ) || ( ! empty( $location['phone'] ) ) || ( ! empty( $location['email'] ) ) ? '</p>' : '';

                $link = vc_build_link( $location['link'] );
                if( ! empty( $link ) && $link['url'] != "" ){
                    $html .= '
                        <p>
                            <a href="'. $link['url'] .'" class="btn btn-primary mt-3">'. $link['title'] .'</a>
                        </p>
                    ';
                }   

                $html .= '
                     </div>
                    </div>
                '; 



            }


        }




        return $html;
    }

    public function header( $font_size = 'h1', $string ){
        
        $html = '<'. $font_size .'>'. $string .'</'. $font_size .'>';

        return $html;

    }

    public function vc_contact_intro( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation' => '',
                    'title'     => '',
                    'font_size' => 'h1',
                    'subtitle'  => '',
                    'image'     => '',
                    'locations' => ''

                ],
                $atts
            )
        ); 

        $html_locations = self::locations( $locations );


       $html = '
            <div class="row no-gutters">
                <div class="col-12 col-md-6 pr-md-5 order-2 order-md-1">
                    <h2 class="bordered mt-3 mt-md-0">'. $subtitle .'</h2>
                    
                    '. self::header( $font_size, $title ) .'

                    <div class="content py-4">
                        '. apply_filters( "the_content", $content ) .'
                    </div>
                    '. $html_locations .'
                </div>
                <div class="col-12 col-md-6 order-1 order-md-2">
                    '. urldecode( base64_decode( $image ) ) .'
                </div>
            </div>
        ';


        $html = '
            <section class="'. $background .' vc-custom vc-contact-intro my-3 py-3 my-md-5 py-md-5">
                <div class="container">
                    '. $html .'    
                </div>
            </section>
        ';
        

        return $html;

    }

}

new vcContactIntro();

?>
