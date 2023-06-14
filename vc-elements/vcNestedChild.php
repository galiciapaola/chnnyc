<?php
/*
Element Description: VC Template
*/

// Element Class

class vcNestedChild extends WPBakeryShortCode {

    
    function __construct() {
        
        add_action( 'init', [ $this, 'vc_nested_child_map' ] );
        add_shortcode( 'vc_nested_child', [ $this, 'vc_nested_child' ] );
        $this->template = get_template_directory_uri();


    }
    
    public function vc_nested_child_map() {

        

        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

       vc_map( array(
           "name"            => "Simple content",
           "base"            => "vc_nested_child",
           'icon'            => get_template_directory_uri() . '/img/chnnyc-icon.png',
           "content_element" => true,
           "as_child"        => array('only' => 'vc_nested'), 
           "params" => array(

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
           )
       ) );

    }

    
    public function vc_nested_child( $atts, $content ) {

        
        global $post;
        
        extract(
            shortcode_atts(
                [
                   'title' => ''
                ],
                $atts
            )
        ); 
        


        $html = '
            <div class="col-12 col-md-6 px-md-5 mb-5">
                <h2>'. $title .'</h2>
                '. apply_filters( "the_content", $content ) .'
            </div>';

        return $html;

        

    }

}

new vcNestedChild();

?>
