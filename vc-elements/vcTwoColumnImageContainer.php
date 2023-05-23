<?php
/*
Element Description: VC Template
*/

// Element Class

class vcTwoColumnImageContainer extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_two_column_image_container_map' ] );
        add_shortcode( 'vc_two_column_image_container', [ $this, 'vc_two_column_image_container' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_two_column_image_container_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Two Column Image Container",
                'base'        => 'vc_two_column_image_container',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Section with two columns, an image and a paragraph",
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
                        "type"        => "attach_image",
                        "heading"     => "Image",
                        "description" => "Image",
                        "param_name"  => "image",
                        "value"       => "",
                    ],

                    [
                        'type'           => 'dropdown',
                        'heading'        => "Background",
                        'param_name'     => 'background',
                        'value'          => [
                            "Transparent" => 'bg-none',
                            "Yellow"     => 'bg-primary'
                        ],
                        "description"    => "Choose an option"
                    ],

                ]
            ]
        );

    }

    
    public function vc_two_column_image_container( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation'  => '',
                    'title'      => '',
                    'image'      => '',
                    'link'       => '',
                    'background' => '',
                ],
                $atts
            )
        ); 

        $image = wp_get_attachment_image_src( $image, 'full' );
        $link = vc_build_link( $link );
        $html_link = '';
        $html_image = '';


        if( ! empty( $link ) && $link['url'] != "" ){
            $html_link = '
                <p>
                    <a href="'. $link['url'] .'" class="btn btn-primary">'. $link['title'] .'</a>
                </p>
            ';
        }


        

        if ( $image ) {
            $img_src = $image[0];
            $html_image = '<img src="'. $img_src .'" alt="" class="img-fluid w-100">';
        }

            $html = '
                <div class="row no-gutters">
                    <div class="col-12 col-md-6">
                        '. $html_image .'
                    </div>
                    <div class="col-12 col-md-6 pl-md-5 d-flex flex-column justify-content-center">
                        <h1 class="mt-3 mt-md-0">'. $title .'</h1>
                        <div class="content py-4">
                            '. apply_filters( "the_content", $content ) .'
                        </div>
                        '. $html_link .'
                    </div>
                </div>
            ';


        $html = '
            <section class="'. $background .' vc-custom vc-two-column-image-container my-3 py-3 my-md-5 py-md-5">
                <div class="container">
                    '. $html .'    
                </div>
            </section>
        ';
        

        return $html;

    }

}

new vcTwoColumnImageContainer();

?>
