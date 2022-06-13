<?php
/**
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ name
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 *
 */

if ( ! defined( 'VDZ_SHOW_MORE_VERSION' ) ) {
	exit;
}

// Add styles
add_action( 'wp_head', 'vdz_show_more_style', 1 );
function vdz_show_more_style() {
	wp_register_style( 'vdz_show_more', VDZ_SHOW_MORE_URL . 'assets/vdz_show_more.css', array(), VDZ_SHOW_MORE_VERSION );
	wp_enqueue_style( 'vdz_show_more' );
}

// Add scripts
add_action( 'wp_footer', 'vdz_show_more_js', 1 );
function vdz_show_more_js() {
	wp_register_script( 'vdz_show_more', VDZ_SHOW_MORE_URL . 'assets/vdz_show_more.js', array( 'jquery' ), VDZ_SHOW_MORE_VERSION, true );
	wp_enqueue_script( 'vdz_show_more' );
}



