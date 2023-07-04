<?php
/*
Element Description: Experiences Slider
*/

// Element Class

class vcImagesSlider extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_images_slider_map' ] );
        add_shortcode( 'vc_images_slider', [ $this, 'vc_images_slider' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_images_slider_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Images Slider",
                'base'        => 'vc_images_slider',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Slider of images",
                'icon'        => get_template_directory_uri() . '/img/chnnyc-icon.png',
                'params' => [
                    
                    [
                        'type'        => 'animation_style',
                        'heading'     => 'Animación',
                        'param_name'  => 'animation',
                        'description' => 'Escoge una animación',
                        'admin_label' => false,
                        'weight'      => 0
                    ],

                    [
                        'type'       => 'param_group',
                        'value'      => '',
                        'param_name' => 'slides',
                        'params' => [

                            [
                                "type"        => "attach_image",
                                "heading"     => "Imagen",
                                "description" => "Imagen para el slide ( proporción recomendada 16:9 )",
                                "param_name"  => "single-image",
                                'admin_label' => true,
                                "value"       => "",
                            ]

                        ]
                    ],
                ]
            ]
        );

    }

    
    public function vc_images_slider( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation' => '',
                    'slides'    => ''
                ],
                $atts
            )
        ); 


        $slides = vc_param_group_parse_atts( $slides );


        $html_slides = '';

        if ( !empty( $slides )) {

            foreach ($slides as $slide) {
            
                $image = wp_get_attachment_image_src( $slide['single-image'], 'full' );
                
                if( $image ){
                    $image_src = $image[0];
                }else{
                    $image_src = $this->template . '/img/birthday.png';
                }

                $active = ( $jj == 0 ) ? "active" : "";

                $html_slides .= '

                    <!-- slide -->
                    <div class="swiper-slide">
                        <a href="javascript:void(0);">
                            <div class="contenedor-slide">
                                <img class="img-fluid" src="'. $image_src .'">
                            </div>
                        </a>
                    </div>
                ';

                $jj++;
                $i++;

            }

        }



        $html = '
        <section class="vc-custom vc-images-slider">
             <div class="container">
                 <div class="row">
                     <div class="col-12 col-md-12 mx-auto">
                        <!-- Swiper -->
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                '. $html_slides .'                  
                            </div>
                            <div class="swiper-next">
                                <img src="'. $this->template .'/img/swiper-next.png">
                            </div>
                            <div class="swiper-prev">
                                <img src="'. $this->template .'/img/swiper-prev.png">
                            </div>        
                        </div> 
                    </div>
                </div>
            </div>   
        </section>  
        ';

        


        return $html;

    }

}

new vcImagesSlider();

?>