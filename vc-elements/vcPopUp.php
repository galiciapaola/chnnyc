<?php
/*
Element Description: VC Template
*/

// Element Class

class vcPopup extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_popup_map' ] );
        add_shortcode( 'vc_popup', [ $this, 'vc_popup' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_popup_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "PopUp",
                'base'        => 'vc_popup',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "PopUp merging with title, paragraph and call to action",
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
                        "param_name"  => "link",              
                        "value"       => '',                   
                        "description" => "Link for the CTA"
                    ],

                    [
                        'type'           => 'dropdown',
                        'heading'        => "Size",
                        'param_name'     => 'size',
                        'value'          => [
                            "Medium" => '',
                            "Large"  => 'modal-lg'
                        ],
                        "description"    => "Choose an option"
                    ],

                ]
            ]
        );

    }

    
    public function vc_popup( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation' => '',
                    'title'     => '',
                    'link'      => '',
                    'size'      => ''
                ],
                $atts
            )
        ); 

        $link = vc_build_link( $link );
        $html_link = '';


        if( ! empty( $link ) && $link['url'] != "" ){
            $html_link = '
                <p>
                    <a href="'. $link['url'] .'" class="btn btn-primary">'. $link['title'] .'</a>
                </p>
            ';
        }


        $html = '
            <!-- Modal -->
            <div class="modal fade popup-chnnyc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered '. $size .'" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                Close
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-11 col-md-10 mx-auto py-3 py-md-5">
                                        <h2>'. $title .'</h2>
                                        <div class="text-container py-3 py-md-4">
                                            '. apply_filters( "the_content", $content ) .'
                                        </div>
                                        '. $html_link .'
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ';
        

        return $html;

    }

}

new vcPopup();

?>
