<?php
/*
Element Description: VC Template
*/

// Element Class

class vcAccordionLinks extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_accordion_links_map' ] );
        add_shortcode( 'vc_accordion_links', [ $this, 'vc_accordion_links' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_accordion_links_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Accordion Links",
                'base'        => 'vc_accordion_links',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "Accordion with links",
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
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'level_one',
                        'params' => [

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
                                'param_name' => 'level_two',
                                'params' => [

                                    [
                                        'type'        => 'textfield',
                                        'value'       => '',
                                        'heading'     => 'Subtitle',
                                        'param_name'  => 'subtitle',
                                        'admin_label' => true
                                    ],
                                    
                                    [
                                        'type' => 'param_group',
                                        'value' => '',
                                        'param_name' => 'level_three',
                                        'params' => [

                                            [
                                                "type"        => "vc_link",                 
                                                "class"       => "",                       
                                                "heading"     => "Link",                 
                                                'admin_label' => false,
                                                "param_name"  => "link",              
                                                "value"       => '',                       
                                                "description" => "Link"
                                            ],

                                        ]
                                    ]

                                ]
                            ]

                        ]
                    ]
                ]
            ]
        );

    }


    public function stringify( $string = '' ){
        return str_replace(" ", "-",  strtolower( htmlentities( $string ) ) );
    }
    
    public function vc_accordion_links( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation' => '',
                    'level_one'    => '',
                ],
                $atts
            )
        ); 

        $html_links = '';
        $jj = 0;
        


        $level_one = vc_param_group_parse_atts( $level_one );

        $html_links .= '<ul class="level-one">';

        foreach ($level_one as &$item_level_one) {

            $bg = @$cnt1++%2==0 ? "bg-primary_" : "bg-tertiary_";

            
            $html_links .= '<li class="'. $bg .' level-one" data-toggle="collapse" data-target="#'. self::stringify(  $item_level_one['title'] ) .'">'. $item_level_one['title'] .' <img src="'. get_stylesheet_directory_uri() .'/img/arrow_forward_ios.svg">';
            
            $item_level_one['items_level_two'] = vc_param_group_parse_atts( $item_level_one['level_two'] );

            if( ! empty( $item_level_one['items_level_two'] ) ){

                $show = ( $jj == 0 ) ? 'show' : '';

                $html_links .= '<ul id="'. self::stringify(  $item_level_one['title'] ) .'" class="collapse '. $show .'" aria-labelledby="headingOne" data-parent="#accordion">';
                
            }

            $i = 0;

            $columna_izquierda = '';
            $columna_derecha = '';

            $izquierda  = '';
            $derecha  = '';
            foreach ($item_level_one['items_level_two'] as &$item_level_two ) {
                
                $izquierda_o_derecha = @$i%2==0 ? "izquierda" : "derecha";
                

                if( $izquierda_o_derecha == 'izquierda' ){

                    
                    $columna_izquierda .= '<li class="level-two">'. $item_level_two['subtitle'] .'';

                    $item_level_two['items_level_three'] = vc_param_group_parse_atts( $item_level_two['level_three'] );

                    if( ! empty( $item_level_two['items_level_three'] ) ){

                        $columna_izquierda .= '<ul>';
                        
                    }

                    foreach ($item_level_two['items_level_three'] as &$item_level_three) {
                        
                        $link = vc_build_link( $item_level_three['link'] );
                        $columna_izquierda .= '<li class="level-three">
                                <a href="'. $link['url'] .'">'. $link['title'] .'</a> <img class="pl-5" src="'. get_stylesheet_directory_uri() .'/img/arrow_circle_down.svg">
                            </li>';                    
                    }

                    if( ! empty( $item_level_two['items_level_three'] ) ){

                        $columna_izquierda .= '</ul></li>';
                        
                    }

                }else{
                    
                    $columna_derecha .= '<li class="level-two">'. $item_level_two['subtitle'] .'';

                    $item_level_two['items_level_three'] = vc_param_group_parse_atts( $item_level_two['level_three'] );

                    if( ! empty( $item_level_two['items_level_three'] ) ){

                        $columna_derecha .= '<ul>';
                        
                    }

                    foreach ($item_level_two['items_level_three'] as &$item_level_three) {
                        
                        $link = vc_build_link( $item_level_three['link'] );
                        $columna_derecha .= '
                            <li class="level-three">
                                <a href="'. $link['url'] .'">'. $link['title'] .'</a> <img class="pl-5" src="'. get_stylesheet_directory_uri() .'/img/arrow_circle_down.svg">
                            </li>';                    
                    }

                    if( ! empty( $item_level_two['items_level_three'] ) ){

                        $columna_derecha .= '</ul></li>';
                        
                    }
                }

                $i++;


            }
            
            if( !empty( $columna_izquierda ) ){
                $izquierda .= '<div class="col-12 col-md-6 izquierda pr-md-3">'. $columna_izquierda .'</div>';    
                
            }else{
                $izquierda .= '';
                
            }
            
            if( !empty( $columna_derecha ) ){
                $derecha .= '<div class="col-12 col-md-6 derecha pl-md-3">'. $columna_derecha .'</div>';    
                
            }else{
                $derecha .= '';
                
            }

            $columna_izquierda = '';
            $columna_derecha = '';
            
            $html_links .= '<div class="row no-gutters">'. $izquierda . $derecha .'</div>';
            

            
            if( ! empty( $item_level_one['items_level_two'] ) ){

                
                $html_links .= '</ul>';
            }

            $jj++;
            $html_links .= '</li>';
        }
            $html_links .= '</ul>';

        // echo '<pre>';
        // print_r( $level_one );
        // echo '</pre>';
        // exit;

        $html = '
            <div class="row no-gutters">
                <div class="col-12" id="accordion">
                    '. $html_links .'
                </div>                       
            </div>  
            ';


        $html = '
            <section class="vc-custom vc-accordion-links my-3 py-3 my-md-5 py-md-3">
                
                    '. $html .'    
                
            </section>
        ';

        return $html;

    }

}

new vcAccordionLinks();

?>
