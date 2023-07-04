<?php
/*
Element Description: VC Template
*/

// Element Class

class vcThreeColumnBlock extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_three_column_block_map' ] );
        add_shortcode( 'vc_three_column_block', [ $this, 'vc_three_column_block' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_three_column_block_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Three Column Block",
                'base'        => 'vc_three_column_block',
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
                        'type'        => 'textfield',
                        'value'       => '',
                        'heading'     => 'Title',
                        'param_name'  => 'title',
                        'admin_label' => true
                    ],

                    [
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'slides',
                        'params' => [

                            [
                                'type'        => 'textfield',
                                'value'       => '',
                                'heading'     => 'Content',
                                'param_name'  => 'description',
                                'admin_label' => true
                            ],

                            [
                                'type'        => 'textfield',
                                'value'       => '',
                                'heading'     => 'Author',
                                'param_name'  => 'author',
                                'admin_label' => false
                            ]

                        ]
                    ],

                    [
                        'type'           => 'dropdown',
                        'heading'        => "Background",
                        'param_name'     => 'background',
                        'value'          => [
                            "Transparent" => 'bg-none',
                            "Yellow"      => 'bg-primary',
                            "Grey"        => 'bg-tertiary'
                        ],
                        "description"    => "Choose an option"
                    ],
                ]
            ]
        );

    }

    
    public function vc_three_column_block( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation'  => '',
                    'title'      => '',
                    'slides'     => '',
                    'background' => ''
                ],
                $atts
            )
        ); 

        $slides_html = '';

        $slides = vc_param_group_parse_atts( $slides );

        if( $slides ){

            switch ( count( $slides ) ) {
                
                case 4:
                    $width = 'col-md-3';
                    break;

                case 3:
                    $width = 'col-md-4';
                    break;

                case 2:
                    $width = 'col-md-6';
                    break;
                
                default:
                    $width = 'col-md-3';
                    break;
            }
            
            foreach ($slides as $slide) {


                $author_html = ( ! empty( $slide['author'] ) ) ? '<p class="author text-center">'. $slide['author'] .'</p>' : '';

                $slides_html .= '
                    <div class="col-12 '. $width .' mx-auto d-flex flex-column">
                        <p class="text-center my-auto px-3 py-4 px-md-5 py-md-2">'. $slide['description'] .'</p>
                        '. $author_html .'
                    </div>
                ';
            }

        }

        $html = '
            <div class="row no-gutters content-centered">
                
                '. $slides_html .'
                
            </div>
        ';


        $html = '
            <section class="'. $background .' vc-custom vc-three-column-block my-3 py-3 my-md-5 py-md-5">
                <div class="container">
                    <div class="row no-gutters mb-4 mb-md-5">
                        <div class="col-12">
                            <h1 class="text-center">
                                '. $title .'
                            </h1>
                        </div>
                    </div>
                    '. $html .'    
                </div>
            </section>
        ';

        return $html;

    }

}

new vcThreeColumnBlock();

?>
