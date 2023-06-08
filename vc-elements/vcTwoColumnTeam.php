<?php
/*
Element Description: VC Template
*/

// Element Class

class vcTwoColumnTeam extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_two_column_team_map' ] );
        add_shortcode( 'vc_two_column_team', [ $this, 'vc_two_column_team' ] );
        $this->template = get_template_directory_uri();

    }

    
    public function vc_two_column_team_map() {

        
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        
        vc_map(
            [
                'name'        => "Two Column Team",
                'base'        => 'vc_two_column_team',
                'heading'     => "heading",
                'category'    => 'CHNNYC',
                'value'       => "Description",
                'description' => "List of teammates sorted in two columns",
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
                        'param_name' => 'teammates',
                        'params' => [

                            [
                                'type'        => 'textfield',
                                'value'       => '',
                                'heading'     => 'Name',
                                'param_name'  => 'name',
                                'admin_label' => true
                            ],
                            
                            [
                                'type'       => 'textfield',
                                'value'      => '',
                                'heading'    => 'Position',
                                'param_name' => 'position',
                            ],

                            [
                                'type'        => 'textarea',
                                'value'       => '',
                                'heading'     => 'Description',
                                'param_name'  => 'description',
                                'admin_label' => false
                            ],

                        ]
                    ]
                ]
            ]
        );

    }

    
    public function vc_two_column_team( $atts, $content ) {

        global $post;
        
        extract(
            shortcode_atts(
                [
                    'animation' => '',
                    'teammates' => '',
                ],
                $atts
            )
        ); 

        $columna_izquierda = '';
        $columna_derecha = '';
        $izquierda  = '';
        $derecha  = '';


        $teammates = vc_param_group_parse_atts( $teammates );

        if ( ! empty( $teammates ) ) {
            
            foreach ($teammates as &$teammate ) {
                $izquierda_o_derecha = @$i%2==0 ? "izquierda" : "derecha";
                
                if( $izquierda_o_derecha == 'izquierda' ){
                    $columna_izquierda .= '
                        <div class="row no-gutters mb-5">
                            <div class="col-12">
                                <h2>'. $teammate['name'] .'</h2>
                                <p class="mb-4">
                                    <b>'. $teammate['position'] .'</b>
                                </p>
                                <p>
                                    <p>'. $teammate['description'] .'</p>
                                </p>
                            </div>
                        </div>
                    ';
                
                }else{

                    $columna_derecha .= '
                        <div class="row no-gutters mb-5">
                            <div class="col-12">
                                <h2>'. $teammate['name'] .'</h2>
                                <p class="mb-4">
                                    <b>'. $teammate['position'] .'</b>
                                </p>
                                <p>
                                    <p>'. $teammate['description'] .'</p>
                                </p>
                            </div>
                        </div>
                    ';

                }

                $i++;

            }
            
            if( !empty( $columna_izquierda ) ){
                
                $izquierda .= '<div class="col-10 col-md-6 izquierda  mx-auto px-2 pr-md-5">'. $columna_izquierda .'</div>';    

            }else{
                
                $izquierda .= '';

            }
            
            if( !empty( $columna_derecha ) ){
                
                $derecha .= '<div class="col-10 col-md-6 derecha mx-auto px-2 pl-md-5">'. $columna_derecha .'</div>';    

            }else{
                
                $derecha .= '';

            }

            $columna_izquierda = '';
            $columna_derecha = '';
            
            $$html_teammates .= '
                <div class="row no-gutters">
                    <div class="col-12 col-md-10 col-lg-10 col-xl-10 mx-auto">
                        <div class="row no-gutters">
                            '. $izquierda . $derecha .'
                        </div>
                    </div>
                </div>';
            

            $html = '
                <div class="row no-gutters">
                    <div class="col-12" id="accordion">
                        '. $$html_teammates .'
                    </div>                       
                </div>  
            ';
        }

        $html = '
            <section class="vc-custom vc-two-columns-team my-3 py-3 my-md-5 py-md-3">
                '. $html .'    
            </section>
        ';

        return $html;

    }

}

new vcTwoColumnTeam();

?>
