<?php
/**
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ name
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 */
if ( ! defined( 'VDZ_SHOW_MORE_VERSION' ) ) {
	exit;
}


// Add shorccode for more text Plugin
function vdz_show_more_shortcode( $atts, $content ) {

	// Add defaults params and extract variables
	extract(
		$attributes = shortcode_atts(
			array(
				'vdz_content_class'   => '',
				'vdz_show_text'       => 'Show',
				'vdz_hide_text'       => 'Hide',
				'vdz_btn_class'       => '',
				'vdz_only_btn_class'  => 'off', // on || off
				'vdz_btn_align'       => 'left',
				'vdz_btn_color'       => 'black',
				'vdz_control_class'   => '',
				'vdz_show_btn_class'  => '',
				'vdz_hide_btn_class'  => '',
				'vdz_effect_duration' => '',

			),
			$atts
		)
	);

	// if(!isset($vdz_show_text) || empty($vdz_show_text) || !isset($vdz_hide_text) || empty($vdz_hide_text)) return '';

	// Add compatibility for Bootstrap (2-4) and Foundation (5-6)
	if ( 'on' === $vdz_only_btn_class ) {
		$vdz_btn_class .= '';
	} else {
		$vdz_btn_class .= ' button btn btn-default ';
	}

	// template
	$vdz_html = '<div class="vdz_show_more">
                    <div class="vdz_sm_content ' . $vdz_content_class . '" data-vdz_effect_duration="' . $vdz_effect_duration . '">'
				. $content .
				'</div>
                    <div class="vdz_sm_control ' . $vdz_control_class . '" style="color: ' . $vdz_btn_color . '; text-align: ' . $vdz_btn_align . ';">
                        <span class="vdz_sm_btn vdz_sm_show ' . $vdz_btn_class . ' ' . $vdz_show_btn_class . '">'
				. __( $vdz_show_text, 'vdz_show_more' ) .
				'</span>
                        <span class="vdz_sm_btn vdz_sm_hide vdz_sm_btn_hide ' . $vdz_btn_class . '' . $vdz_hide_btn_class . '">'
				. __( $vdz_hide_text, 'vdz_show_more' ) .
				'</span>
                    </div>
                </div>';

	// do inside shortcode
	return do_shortcode( $vdz_html );
}

add_shortcode( 'vdz_show_more', 'vdz_show_more_shortcode' );
