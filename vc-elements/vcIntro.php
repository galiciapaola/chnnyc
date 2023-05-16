<?php
/*
Element Description: VC Template
*/

// Element Class

class vcIntro extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_intro_map' ] );
        add_shortcode( 'vc_intro', [ $this, 'vc_intro' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_intro_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Intro",
                'base'        => 'vc_intro',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Description",
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
                            "Primary"     => 'bg-primary'
                        ],
                        "description"    => "Choose an option"
                    ],

                ]
            ]
        );

    }

    
    public function vc_intro( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation'  => '',
                    'title'      => '',
                    'subtitle'   => '',
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
        $html_image = '';


        if( ! empty( $link ) && $link['url'] != "" ){
            $html_link = '<a href="'. $link['url'] .'" class="btn btn-primary">'. $link['title'] .'</a>';
        }


        

        if ( $image ) {
            $img_src = $image[0];

            $html = '
                <div class="row no-gutters">
                    <div class="col-12 col-md-6 pr-md-5 order-2 order-md-1">
                        <h2 class="mt-3 mt-md-0">'. $subtitle .'</h2>
                        <h1>'. $title .'</h1>
                        <div class="content py-4">
                            '. apply_filters( "the_content", $content ) .'
                        </div>
                        '. $html_link .'
                    </div>
                    <div class="col-12 col-md-6 order-1 order-md-2">
                        <img src="'. $img_src .'" alt="" class="img-fluid w-100">
                    </div>
                </div>
            ';

        }else{
            $html = '
                <div class="row no-gutters content-centered">
                    <div class="col-12 col-md-6 mx-auto order-2 order-md-1">
                        <h2>'. $subtitle .'</h2>
                        <h1>'. $title .'</h1>
                        <div class="content py-4">
                            '. apply_filters( "the_content", $content ) .'
                        </div>
                        '. $html_link .'
                    </div>
                </div>
            ';
        }


        $html = '
            <section class="'. $background .' vc-custom vc-intro my-3 py-3 my-md-5 py-md-5">
                <div class="container">
                    '. $html .'    
                </div>
            </section>
        ';
        

        return $html;

    }

}

new vcIntro();

?>
