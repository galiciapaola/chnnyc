<?php
/*
Element Description: VC Template
*/

// Element Class

class vcContactForm extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_contact_form_map' ] );
        add_shortcode( 'vc_contact_form', [ $this, 'vc_contact_form' ] );
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

    
    public function vc_contact_form_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        $contact_forms_options = self::get_data();
        
        vc_map(
            [
                'name'        => "Contact Form",
                'base'        => 'vc_contact_form',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Contact form selector from ContactForm7",
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
                        'type'        => 'dropdown',
                        'heading'     => "Conctact Forms Availables",
                        'param_name'  => 'contact_form',
                        'admin_label' => true,
                        'value'       => $contact_forms_options,
                        "description" => "Choose an option"
                    ]

                ]
            ]
        );

    }

    
    public function vc_contact_form( $atts) {

        global $post;

        $contact_form = '';
        
        extract(
            shortcode_atts(
                [
                    'animation'    => '',
                    'title'        => '',
                    'contact_form' => ''
                ],
                $atts
            )
        ); 

        if( ! empty( $contact_form ) ){
            $contacto_form_html = do_shortcode('[contact-form-7 id="'. $contact_form .'"]');
        }

        $html = '
            <div class="row no-gutters">
                <div class="col-10 col-md-10 mx-auto">
                    '. $contacto_form_html .'
                </div>                       
            </div>  
            ';

        $html = '
            <section class="vc-custom vc-contact-form my-3 pb-3 my-md-5 pb-md-5">
                <div class="row no-gutters title-container mb-5">
                    <div class="col-12 py-4">
                      <h1 class="text-center">'. $title .'</h1>  
                    </div>
                </div>
                <div class="container">
                    '. $html .'    
                </div>
            </section>
        ';
        

        return $html;

    }

}

new vcContactForm();

?>
