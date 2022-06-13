<?php
/*
Plugin Name: VDZ Show More Plugin
Plugin URI:  http://online-services.org.ua
Description: Add show / hide block and button for control  Usage: <strong>[vdz_show_more vdz_show_text="SHOW" vdz_hide_text="HIDE"] Content [/vdz_show_more]</strong>
Version:     1.4.22
Author:      VadimZ
Author URI:  http://online-services.org.ua#vdz_show_more
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


define( 'VDZ_SHOW_MORE_VERSION', '1.4.22' );
define( 'VDZ_SHOW_MORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'VDZ_SHOW_MORE_URL', plugin_dir_url( __FILE__ ) );
define( 'VDZ_SHOW_MORE_API', 'vdz_info_show_more' );

// Just for frontend
if ( ! is_admin() ) {
	require_once VDZ_SHOW_MORE_DIR . 'includes/vdz_sm_assets.php';
	require_once VDZ_SHOW_MORE_DIR . 'includes/vdz_sm_shortcode.php';
} else {
	// In admin
	require_once VDZ_SHOW_MORE_DIR . 'includes/api.php';
	require_once VDZ_SHOW_MORE_DIR . 'updated_plugin_admin_notices.php';
}

// Код активации плагина
register_activation_hook(
	__FILE__,
	function () {
		global $wp_version;

		if ( version_compare( $wp_version, '3.8', '<' ) ) {
			// Деактивируем плагин
			deactivate_plugins( plugin_basename( __FILE__ ) );
			wp_die( 'This plugin required WordPress version 3.8 or higher' );
		}
		do_action( VDZ_SHOW_MORE_API, 'on', plugin_basename( __FILE__ ) );
	}
);

// Код деактивации плагина
register_deactivation_hook( __FILE__, function () {
	$plugin_name = preg_replace( '|\/(.*)|', '', plugin_basename( __FILE__ ));
	$response = wp_remote_get( "http://api.online-services.org.ua/off/{$plugin_name}" );
	if ( ! is_wp_error( $response ) && isset( $response['body'] ) && ( json_decode( $response['body'] ) !== null ) ) {
		//TODO Вывод сообщения для пользователя
	}
} );
//Сообщение при отключении плагина
add_action( 'admin_init', function (){
	if(is_admin()){
		$plugin_data = get_plugin_data(__FILE__);
		$plugin_name = isset($plugin_data['Name']) ? $plugin_data['Name'] : ' us';
		$plugin_dir_name = preg_replace( '|\/(.*)|', '', plugin_basename( __FILE__ ));
		$handle = 'admin_'.$plugin_dir_name;
		wp_register_script( $handle, '', null, false, true );
		wp_enqueue_script( $handle );
		$msg = '';
		if ( function_exists( 'get_locale' ) && in_array( get_locale(), array( 'uk', 'ru_RU' ), true ) ) {
			$msg .= "Спасибо, что были с нами! ({$plugin_name}) Хорошего дня!";
		}else{
			$msg .= "Thanks for your time with us! ({$plugin_name}) Have a nice day!";
		}
		wp_add_inline_script( $handle, "document.getElementById('deactivate-".esc_attr($plugin_dir_name)."').onclick=function (e){alert('".esc_attr( $msg )."');}" );
	}
} );




