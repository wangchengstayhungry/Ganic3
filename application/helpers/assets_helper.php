<?php

/*
 * Method to load css files into your project.
 *
 * Accepts a string or array as parameter.
 *
 * Usage:
 *
 * echo load_css('screen.css');
 * echo load_css(array('screen.css','otherstyle.css'));
 * echo load_css(array(
 *			 array('screen.css', 'screen, projection'),
 *			 array('print.css', 'print'),
 *		 ));
 *
 * @author William Rufino <williamhrs@gmail.com>
 * @author Lucas Vasconcelos <lucas.vasconcelos@gmail.com>
 * @version 1.6
 * @param mixed $css
 */
if (!function_exists('load_css')) {

	function load_css($data) {
		$CI =& get_instance();
		$CI->load->helper('html');
                $CI->config->load('assets');
                if(!$CI->config->item('css_path')){
                    $CI->config->set_item('css_path','public/css/');
                }
		$csspath = base_url() . $CI->config->item('css_path');

		if (!is_array($data))
			return link_tag($csspath . $data, 'stylesheet', 'text/css');
		else {
			$return = '';
			foreach ($data as $item) {
				if (!is_array($item)) {
					$return .= link_tag($csspath . $item, 'stylesheet', 'text/css');
				} else {
					$return .= link_tag($csspath . $item[0], 'stylesheet', 'text/css', '', $item[1]);
				}
			}
		}
		return $return;
	}

}
/*
 * Method to load javascript files into your project.
 * @author William Rufino
 * @version 1.4
 * @param array $js
 */
if (!function_exists('load_js')) {

	function load_js($js) {
		$CI =& get_instance();
		$CI->load->helper('url');
		if (!is_array($js)) {
			$js = (array) $js;
		}
                $CI->config->load('assets');
                if(!$CI->config->item('js_path')){
                    $CI->config->set_item('js_path','public/js/');
                }
                $jspath =  base_url() . $CI->config->item('js_path');
		$return = '';
		foreach ($js as $j) {
			$return .= '<script type="text/javascript" src="' . $jspath . $j . '"></script>' . "\n";
		}
		return $return;
	}

}
/*
 * Method to insert images into your project.
 * @author Neto Fontenele and William Rufino
 * @version 1.4
 * @param string $image - path to image
 * @param string $alt - the text of image
 * @param mixin $atributs
 * @return String tag img com parametros
 * Usage:
 *      echo load_img('28188.jpg','este é o alt',array('class' => 'a b','id' => 'c'))
 *      echo load_img('28188.jpg',false,'class="a"')
 *      echo load_img('28188.jpg',false)
 *      echo load_img('28188.jpg','alt da imagem','class="a"') ?>
 */
if ( !function_exists('load_img') ) {

    function load_img( $img , $alt = TRUE , $attributes = '' )
    {
        $CI = & get_instance();
        $CI->load->helper('url');
        $CI->config->load('assets');
        if ( !$CI->config->item('img_path') ) {
            $CI->config->set_item('img_path' , 'public/img/');
        }
        if ( is_array($attributes) ) {
            $atts = '';
            foreach ( $attributes as $key => $val ) {
                $atts .= ' ' . $key . '="' . $val . '"';
            }
            $attributes = $atts;
        } elseif ( is_string($attributes) AND strlen($attributes) > 0 ) {
            $attributes = ' ' . $attributes;
        }
        $imagepath = base_url() . $CI->config->item('img_path');

        $exist_alt = "<img src=\"$imagepath$img\"$attributes alt=\"$alt\">\n";
        $not_exist_alt = "<img src=\"$imagepath$img\"$attributes>\n";

        return ($alt) ? $exist_alt : $not_exist_alt;
    }

}