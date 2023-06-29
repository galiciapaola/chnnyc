<?php
/*
Element Description: VC Template
*/

// Element Class

class vcLocations extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_locations_map' ] );
        add_shortcode( 'vc_locations', [ $this, 'vc_locations' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_locations_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Locations",
                'base'        => 'vc_locations',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Template for locations w/ hours, bus directions, languages and directions",
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
                        'heading'     => 'Subtitle',
                        'param_name'  => 'subtitle',
                        'admin_label' => true
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
                        'heading'     => 'Description',
                        'param_name'  => 'description',
                        'admin_label' => false
                    ],

                    [
                        'type'        => 'attach_image',
                        'value'       => '',
                        'heading'     => 'Cover image',
                        'param_name'  => 'cover',
                        'admin_label' => false
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
                        'heading'     => 'FAX',
                        'param_name'  => 'fax',
                        'admin_label' => false
                    ],

                    [
                        "type"        => "vc_link",                 
                        "class"       => "",                       
                        "heading"     => "Link",                 
                        'admin_label' => false,
                        "param_name"  => "link",              
                        "value"       => '',                       
                        "description" => "Link for Book"
                    ],

                    [
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => 'Hours',
                        'param_name' => 'hours',
                        'params' => [

                            [
                                'type'        => 'textfield',
                                'value'       => '',
                                'heading'     => 'Day',
                                'param_name'  => 'day',
                                'admin_label' => true
                            ],

                            [
                                'type'        => 'textfield',
                                'value'       => '',
                                'heading'     => 'Hours',
                                'param_name'  => 'hours',
                                'admin_label' => true
                            ],
                        ],
                    ],

                    [
                        'type'        => 'textfield',
                        'value'       => '',
                        'heading'     => 'Bus Directions',
                        'param_name'  => 'bus_directions',
                        'admin_label' => false
                    ],

                    [
                        'type'        => 'textarea_raw_html',
                        'value'       => '',
                        'heading'     => 'Google Map Iframe',
                        'param_name'  => 'map',
                        'admin_label' => false
                    ],

                    [
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => 'Languages Spoken',
                        'param_name' => 'languages_spoken',
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
                                'heading'     => 'Description',
                                'param_name'  => 'description',
                                'admin_label' => false
                            ],
                        ]
                    ],

                    [
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => 'Directions',
                        'param_name' => 'directions',
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
                                'heading'     => 'Description',
                                'param_name'  => 'description',
                                'admin_label' => false
                            ],
                        ]
                    ],

                    [
                        "type"        => "vc_link",                 
                        "class"       => "",                       
                        "heading"     => "Link",                 
                        'admin_label' => false,
                        "param_name"  => "link_directions",              
                        "value"       => '',                       
                        "description" => "Link for Get Directions"
                    ],

                ]
            ]
        );

    }

    public function hours( $hours = null ){
        
        $hours = vc_param_group_parse_atts( $hours );
        
        $html_hours = '';
        
        if ( $hours ) {
            $html_hours = '
                <h3>Hours</h3>
                <ul>
                ';
            foreach ($hours as $hour) {
                $html_hours .= '
                    <li class="row">
                        <span class="col-5"><b>'. $hour['day'] .'</b></span>
                        <span class="col-7">'. $hour['hours'] .'</span>
                    </li>
                '; 
            }
            $html_hours .= '
                </ul>
                ';
        }

        return $html_hours;

    }

    public function languages_spoken( $languages_spoken = null ){
        
        $languages_spoken = vc_param_group_parse_atts( $languages_spoken );
        
        $html_languages_spoken = '';
        
        if ( $languages_spoken ) {
            $html_languages_spoken = '
                <h3 class="pb-4 pt-5 pt-md-0">Languages Spoken</h3>
                ';
            foreach ($languages_spoken as $language) {
                $html_languages_spoken .= '
                    <p>
                        <b>'. $language['title'] .'</b>
                    </p>
                    <p>
                        '. $language['description'] .'
                    </p>
                '; 
            }

        }

        return $html_languages_spoken;

    }

    public function directions( $directions = null ){
        
        $directions = vc_param_group_parse_atts( $directions );
        
        $html_directions = '';
        
        if ( $directions ) {
            $html_directions = '
                <h3 class="mt-5 mb-4">Directions</h3>
                ';
            foreach ($directions as $direction) {
                $html_directions .= '
                    <p>
                        <span style="font-weight: 600" class="d-block">'. $direction['title'] .':</span>
                        '. $direction['description'] .'
                    </p>
                    
                '; 
            }

        }

        return $html_directions;

    }

    public function bus_directions( $bus_directions = null ){
        
        
        $html_bus_directions = '';
        
        if ( ! empty( $bus_directions ) ) {
            $html_bus_directions = '
                <h3 class="mt-5 mb-4">Bus Directions</h3>
                <p>'. $bus_directions .'</p>
                ';
        }

        return $html_bus_directions;

    }

    
    public function vc_locations( $atts, $content ) {

        global $post;

        $img_cover_src = '';
        
        extract(
            shortcode_atts(
                [
                    'animation'        => '',
                    'title'            => '',
                    'subtitle'         => '',
                    'description'      => '',
                    'cover'      => '',
                    'address'          => '',
                    'phone'            => '',
                    'fax'              => '',
                    'link_directions'  => '',
                    'link'             => '',
                    'hours'            => '',
                    'bus_directions'   => '',
                    'map'              => '',
                    'directions'   => '',
                    'languages_spoken' => '',
                ],
                $atts
            )
        ); 


        $link = vc_build_link( $link );
        $link_directions = vc_build_link( $link_directions );

        $cover = wp_get_attachment_image_src( $cover, 'full' );

        if( $cover ){
            $img_cover_src = $cover[0];
        }


        $html_hours = self::hours( $hours );
        $html_bus_directions = self::bus_directions( $bus_directions );
        $html_languages_spoken = self::languages_spoken( $languages_spoken );
        $html_directions = self::directions( $directions );


        $html = '
            <section class="'. $background .' vc-custom vc-locations my-3 py-3 my-md-5 py-md-5">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-12 col-md-6 pr-md-5">
                            <h2 class="bordered">'. $subtitle .'</h2>
                            <h1>'. $title .'</h1>
                            <p class="my-4">'. $description .'</p>
                            <p>
                                <span class="d-block">
                                    <b>Address: </b>'. $address .'
                                </span>
                                <span class="d-block">
                                    <b>Phone: </b>'. $phone .'
                                </span>
                                <span class="d-block">
                                    <b>Fax: </b>'. $fax .'
                                </span>
                            </p>
                            <p>
                                <a target="'. $link['target'] .'" href="'. $link['url'] .'" class="my-4 btn btn-primary">
                                    '. $link['title'] .'
                                </a>
                            </p>
                        </div>
                        <div class="col-12 col-md-6 pl-md-5">
                            <img class="w-100" src="'. $img_cover_src .'" alt="">
                        </div>
                    </div>
                    <div class="row no-gutters mt-5">
                        <div class="col-12 col-md-6 pr-md-5">
                            
                            '. $html_hours .'
                            
                            '. $html_bus_directions .'
                            
                            '. urldecode( base64_decode( $map ) ) .'

                        </div>
                        <div class="col-12 col-md-6 pl-md-5">
                            
                            '. $html_languages_spoken .'

                            '. $html_directions .'

                            <p>
                                <a href="'. $link_directions['url'] .'" class="my-4 btn btn-primary">
                                    '. $link_directions['title'] .'
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            ';

        return $html;

    }

}

new vcLocations();

?>
