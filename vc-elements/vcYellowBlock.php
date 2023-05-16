<?php
/*
Element Description: VC Template
*/

// Element Class

class vcYellowBlock extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_yellow_block_map' ] );
        add_shortcode( 'vc_yellow_block', [ $this, 'vc_yellow_block' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_yellow_block_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Yellow Block",
                'base'        => 'vc_yellow_block',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Section yellow with title and WYSIWYG",
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
                    ],

                     [
                        "type"        => "vc_link",                 
                        "class"       => "",                       
                        "heading"     => "Link",                 
                        'admin_label' => false,
                        "param_name"  => "link",              
                        "value"       => '',                       
                        "description" => "Link for the CTA"
                    ]

                ]
            ]
        );

    }

    
    public function vc_yellow_block( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation' => '',
                    'title'     => '',
                    'link'      => ''
                ],
                $atts
            )
        ); 

        $link = vc_build_link( $link );
        $html_content = '';
        $html_link = '';

        if( ! empty( $link ) && $link['url'] != "" ){
            $html_link = '
                <p>
                    <a href="'. $link['url'] .'" class="btn btn-primary mx-auto mt-5 mb-0">'. $link['title'] .'</a>
                </p>
            ';
        }
        
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
                    '. $html_link .'
                </div>
            </div>
        ';
        

        $html = '
            <section class="bg-primary vc-custom vc-yellow-block my-3 py-3 my-md-5 py-md-5">
                <div class="container">
                    '. $html .'    
                </div>
            </section>
        ';
        

        return $html;

    }

}

new vcYellowBlock();

?>
