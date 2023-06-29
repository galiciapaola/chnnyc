<?php
/*
Element Description: VC Template
*/

// Element Class

class vcTeam extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_team_map' ] );
        add_shortcode( 'vc_team', [ $this, 'vc_team' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_team_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Team",
                'base'        => 'vc_team',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Template with position, name, description and image",
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
                        'heading'     => 'Name',
                        'param_name'  => 'name',
                        'admin_label' => true
                    ],

                    [
                        'type'        => 'textfield',
                        'value'       => '',
                        'heading'     => 'Position',
                        'param_name'  => 'position',
                        'admin_label' => true
                    ],

                    [
                        'type'        => 'textarea_html',
                        'value'       => '',
                        'heading'     => 'Content',
                        'param_name'  => 'content',
                        "description" => "Teammate info"
                    ],

                    [
                        'type'        => 'attach_image',
                        'value'       => '',
                        'heading'     => 'Photo',
                        'param_name'  => 'image',
                        'admin_label' => false
                    ]


                ]
            ]
        );

    }

    
    public function vc_team( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation' => '',
                    'name'      => '',
                    'position'  => '',
                    'image'     => '',
                ],
                $atts
            )
        ); 

        $image = wp_get_attachment_image_src( $image, 'full' );
        
        if ( $image ) {
            
            $image_src = $image[0];
            $html = '';

        }else{
            $image_src = '';
        }

       $html = '
           <section class="vc-custom vc-team my-3 py-3 my-md-5 py-md-5">
               <div class="container">
                   <div class="row no-gutters">
                    <div class="col-12">
                        <h2 class="bordered">'. $position .'</h2>
                    </div>
                   </div>
                   <div class="row no-gutters">
                    <div class="col-12 col-md-6 mr-auto">
                        <h1 class="mb-3 mb-md-5">'. $name .'</h1>
                    </div>
                   </div>
                   <div class="row no-gutters">
                    <div class="col-12 col-md-6 order-2 order-md-1 pr-md-5">
                        '. apply_filters( "the_content", $content ) .'
                    </div>
                    <div class="col-12 col-md-6 order-1 order-md-2 mb-4 mb-md-0">
                        <img src="'. $image_src .'" alt="" class="w-100 sticky">
                    </div>
                   </div>   
               </div>
           </section>
       ';

        return $html;

    }

}

new vcTeam();

?>
