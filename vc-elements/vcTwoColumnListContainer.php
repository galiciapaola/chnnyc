<?php
/*
Element Description: VC Template
*/

// Element Class

class vcTwoColumnListContainer extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_two_column_list_container_map' ] );
        add_shortcode( 'vc_two_column_list_container', [ $this, 'vc_two_column_list_container' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_two_column_list_container_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Two Column List Container",
                'base'        => 'vc_two_column_list_container',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Section with title and WYSIWYG for two columns",
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

    
    public function vc_two_column_list_container( $atts, $content ) {

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
        $html_title = '';
        
        
        if( ! empty( $content ) ){
            $html_content = '
                <div class="content">'
                    . apply_filters( "the_content", $content ) .'
                </div>';
        }

        if( ! empty( $title ) ){
            $html_title = '
                <h2>'. $title .'</h2>';
        }
        
        $html = '
            <div class="row no-gutters vc-custom vc-two-column-list-container my-3 py-3">
                <div class="col-12 pr-md-5">
                    '. $html_title .'
                    '. $html_content .'
                </div>
            </div>
        ';
        

        // $html = '
        //     <section class="vc-custom vc-two-column-list-container my-3 py-3 my-md-5 py-md-5">
        //         <div class="container">
        //             '. $html .'    
        //         </div>
        //     </section>
        // ';
        

        return $html;

    }

}

new vcTwoColumnListContainer();

?>
