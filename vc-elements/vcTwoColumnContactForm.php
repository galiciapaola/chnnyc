<?php
/*
Element Description: VC Template
*/

// Element Class

class vcTwoColumnContactForm extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_two_column_contact_form_map' ] );
        add_shortcode( 'vc_two_column_contact_form', [ $this, 'vc_two_column_contact_form' ] );
        $this->template = get_template_directory_uri();

    }

    public function get_data() {
        $args = [
            'post_type'     => 'wpcf7_contact_form',
            'posts_per_page' => -1
        ];

        $cf7_id_array = [];
        
        if (post_type_exists('wpcf7_contact_form')) {
            
            $the_query = new WP_Query($args);
            
            if ($the_query->have_posts()) {
            
                while ($the_query->have_posts()) {
                    
                    $the_query->the_post();
                    $cf7_id_array[ get_the_title() ] = get_the_ID();
                    
                }
            
                wp_reset_postdata();

            }

        }

        return $cf7_id_array;

    }

    
    public function vc_two_column_contact_form_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        $contact_forms_options = self::get_data();
        
        vc_map(
            [
                'name'        => "Two Column Contact Form",
                'base'        => 'vc_two_column_contact_form',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Contact form selector from ContactForm7 by two columns",
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
                        'type'        => 'dropdown',
                        'heading'     => "Conctact Forms Availables",
                        'param_name'  => 'contact_form',
                        'admin_label' => true,
                        'value'       => $contact_forms_options,
                        "description" => "Choose an option"
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
                                'type'       => 'textfield',
                                'value'      => '',
                                'heading'    => 'Address',
                                'param_name' => 'address',
                            ],
                            
                            [
                                'type'       => 'textfield',
                                'value'      => '',
                                'heading'    => 'Phone',
                                'param_name' => 'phone',
                            ],
                            
                            [
                                'type'       => 'textfield',
                                'value'      => '',
                                'heading'    => 'Email',
                                'param_name' => 'email',
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

                ]
            ]
        );

    }

    
    public function vc_two_column_contact_form( $atts) {

        global $post;

        $contact_form = '';
        $locations_html = '';
        
        extract(
            shortcode_atts(
                [
                    'animation'    => '',
                    'contact_form' => '',
                    'locations'    => ''
                ],
                $atts
            )
        ); 

        $locations = vc_param_group_parse_atts( $locations );

        if( ! empty( $locations ) ){
            foreach ( $locations as $location ) {


                $link = vc_build_link( $location['link'] );

                $locations_html .= '
                    <div class="row no-gutters mb-5">
                        <div class="col-12">
                            <h2>'. $location['title'] .'</h2>
                        </div>
                        <div class="col-12">
                            <span><b>Address:</b> '. $location['address'] .'</span>
                        </div>
                        <div class="col-12">
                            <span><b>Phone:</b> '. $location['phone'] .'</span>
                        </div>
                        <div class="col-12">
                            <span><b>Email:</b> '. $location['email'] .'</span>
                        </div>
                        <div class="col-12 mt-4">
                            <p>
                                <a href="'. $link['url'] .'" target="'. $link['target'] .'" class="btn btn-primary">'. $link['title'] .'</a>
                            </p>
                        </div>
                    </div>
                ';
            }
        }


        if( ! empty( $contact_form ) ){
            $contacto_form_html = do_shortcode('[contact-form-7 id="'. $contact_form .'"]');
        }

        $html = '
            <div class="row no-gutters">
                <div class="col-10 col-md-4 mx-auto pr-md-5 order-2 order-md-1">
                    '. $locations_html .'
                </div>
                <div class="col-10 col-md-7 mx-auto order-1 order-md-2 mb-5 mb-md-0">
                    <div class="sticky">
                        '. $contacto_form_html .'
                    </div>                       
                </div>                       
            </div>  
            ';

        $html = '
            <section class="vc-custom vc-two-column-contact-form my-3 pb-3 my-md-5 pb-md-5">
                <div class="container">
                    '. $html .'    
                </div>
            </section>
        ';
        

        return $html;

    }

}

new vcTwoColumnContactForm();

?>
