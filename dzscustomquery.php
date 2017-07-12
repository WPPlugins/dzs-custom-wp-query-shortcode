<?php
/*
Plugin Name: DZS Custom WP Query shortcode
Plugin URI: http://digitalzoomstudio.net/
Description: DZS Custom WP Query shortcode
Version: 1.0
Author: Digital Zoom Studio
Author URI: http://digitalzoomstudio.net/
*/


$dzscq = new DZSCustomQuery();
class DZSCustomQuery{
    function __construct(){
        add_shortcode('query', array($this, 'show_shortcode'));
    }
    function show_shortcode($atts){
        $oput='';
        //print_r($atts['vars']);
        $args = array();
        $aux = explode("&", $atts['vars']);
        foreach($aux as $auxi){
                $auxi = str_replace("amp;", "", $auxi);
                //print_r($auxi);
                $auxj = explode("=", $auxi);
                $args[$auxj[0]] = $auxj[1];
        }
        $the_query = new WP_Query($args);
        foreach($the_query->posts as $cp){
            $oput .= '<h3>'. $cp->post_title.'</h3>';
            $oput .= '<div>'. $cp->post_content.'</div>';
        }
        return $oput;
    }
}