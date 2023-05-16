<?php
/*
Element Description: VC Template
*/

// Element Class

class vcFullWidthContainer extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_full_width_container_map' ] );
        add_shortcode( 'vc_full_width_container', [ $this, 'vc_full_width_container' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_full_width_container_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Full-Width Container",
                'base'        => 'vc_full_width_container',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Section full width with title and WYSIWYG",
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
                        "type"        => 'textarea_html',
                        "class"       => '',
                        "heading"     => 'Content',
                        "param_name"  => 'content',
                        "value"       => '', 
                        "description" => "Content of the module"
                    ]
                ]
            ]
        );

    }

    
    public function vc_full_width_container( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation' => '',
                    'title'     => ''
                ],
                $atts
            )
        ); 

        $link = vc_build_link( $link );
        $html_content = '';
        
        
        if( ! empty( $content ) ){
            $html_content = '
                <div class="content pt-5">'
                    . apply_filters( "the_content", $content ) .'
                </div>';
        }
        
        $html = '
            <div class="row no-gutters content-centered">
                <div class="col-12">
                    <h1 class="text-center">'. $title .'</h1>
                    '. $html_content .'
                </div>
            </div>
        ';
        

        $html = '
            <section class="vc-custom vc-full-width-container my-3 py-3 my-md-5 py-md-5">
                <div class="container">
                    '. $html .'    
                </div>
            </section>
        ';
        

        return $html;

    }

}

new vcFullWidthContainer();

?>
