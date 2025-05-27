<?php

namespace BricksUltra;

use Bricks\Breakpoints;
use Bricks\Setup;
use BricksUltra\Admin\Admin;
use BricksUltra\includes\Helper;

class Plugin {


	private static $_instance   = null;
	public static $buBaseDevice = null;
	public static $schemas;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function __construct() {
		add_action( 'init', [ $this, 'load_modules' ], 11 );
		add_action( 'wp_enqueue_scripts', [ $this, 'bricks_ultra_scripts' ] );
		new Admin();

		add_action( 'wp_footer', array( $this, 'render_schema' ) );
		add_action( 'admin_notices', [ $this, 'missing_license' ] );
		add_filter('upload_mimes', [$this,'allow_json_upload']);
	}


	public function load_modules() {
		$helper        = new Helper();
		$modules       = $helper->get_modules();
		$settings      = $helper->get_initial_settings();
		$saved_modules = [];

		if ( $settings['is_setting_saved'] && ! $settings['is_error'] ) {
			$saved_modules = $settings['modules'];
		}

		foreach ( $modules as $module ) {
			$sub_modules = $module['submodules'];
			foreach ( $sub_modules as $key => $sub_module ) {
				if ( array_key_exists( $key, $saved_modules ) && ! $saved_modules[ $key ] ) {
					continue;
				}
				$active = $sub_module['active'];
				if ( $active || ( array_key_exists( $key, $saved_modules ) && $saved_modules[ $key ] ) ) {
					
					\Bricks\Elements::register_element( $sub_module['path'] );
				}
			}
		}
	}

	public function bricks_ultra_scripts() {
		$breakpoints_data = Breakpoints::get_breakpoints();
		$baseDevice       = [];
		foreach ( $breakpoints_data as $key => $breakpoint_data ) {
			$breakpoints[ $breakpoint_data['key'] ] = $breakpoint_data['width'];
			if ( isset( $breakpoint_data['base'] ) ) {
				self::$buBaseDevice            = $breakpoint_data['key'];
				$baseDevice['baseDevice']      = $breakpoint_data['key'];
				$baseDevice['baseDeviceWidht'] = $breakpoint_data['width'];
			}
		}
		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			$checkout_url = wc_get_checkout_url();
			$cart_url = wc_get_cart_url();
		}
		else{
			$checkout_url = '';
			$cart_url = '';
		}
		wp_register_style( 'bu-popup-css', WPV_BU_URL . 'assets/vendor/magnific-popup/maginific-popup.css', [], WPV_BU_VERSION);
		wp_register_script( 'bu-popup-script', WPV_BU_URL . 'assets/vendor/magnific-popup/magnific-popup.min.js', [ 'jquery' ], '1.1.0', false );
		wp_register_script( 'bultr-module-script', WPV_BU_URL . 'assets/js/module.min.js', ['jquery'], WPV_BU_VERSION, false );
		wp_register_style( 'bultr-module-style', WPV_BU_URL . 'assets/css/module.min.css', [], WPV_BU_VERSION );
		wp_localize_script(
			'bultr-module-script',
			'bricksUltra',
			[
				'ajaxurl'     	=> admin_url( 'admin-ajax.php' ),
				'breakpoints' 	=> $breakpoints,
				'baseDevice'  	=> $baseDevice,
				'checkout_url' 	=>$checkout_url ,
				'cart_url'		=> $cart_url,
				'nonce'       	=> wp_create_nonce( 'wooproduct_script_nonce' ),
			]	
		);

		//lightgallery style
		wp_register_style('bultr-lightgallery-style',WPV_BU_URL . 'assets/vendor/lightgallery/css/lightgallery-bundle.css', [],WPV_BU_VERSION );
		//lightgallery scripts
		wp_register_script('bultr-lightgallery-script', WPV_BU_URL . 'assets/vendor/lightgallery/lightgallery.js',[], '2.7.1', true);
		wp_register_script('bu-lg-fullscreen-js', WPV_BU_URL . 'assets/vendor/lightgallery/plugins/fullscreen/lg-fullscreen.min.js',[], '2.7.1', true);
		wp_register_script('bu-lg-hash-js', WPV_BU_URL . 'assets/vendor/lightgallery/plugins/hash/lg-hash.min.js',[], '2.7.1', true);
		wp_register_script('bu-lg-rotate-js', WPV_BU_URL . 'assets/vendor/lightgallery/plugins/rotate/lg-rotate.min.js',[], '2.7.1', true);
		wp_register_script('bu-lg-share-js', WPV_BU_URL . 'assets/vendor/lightgallery/plugins/share/lg-share.min.js',[], '2.7.1', true);
		wp_register_script('bu-lg-video-js', WPV_BU_URL . 'assets/vendor/lightgallery/plugins/video/lg-video.min.js',[], '2.7.1', true);
		wp_register_script('bu-lg-zoom-js', WPV_BU_URL . 'assets/vendor/lightgallery/plugins/zoom/lg-zoom.min.js',[], '2.7.1', true);
		wp_register_script('bu-lg-autoplay-js', WPV_BU_URL . 'assets/vendor/lightgallery/plugins/autoplay/lg-autoplay.min.js',[], '2.7.1', true);
		wp_register_script('bu-lg-thumbnail-js', WPV_BU_URL . 'assets/vendor/lightgallery/plugins/thumbnail/lg-thumbnail.min.js',[], '2.7.1', true);
		// For Vimeo video-Video Box Widget
		wp_register_script('bu-player-js', WPV_BU_URL . 'assets/vendor/lightgallery/player.min.js',[], '2.19.0', true);
		// For selfhosted video-Video Box Widget
		wp_register_script('bu-video-js', WPV_BU_URL . 'assets/vendor/lightgallery/video.min.js',[], '8.3.0', true);
		wp_enqueue_style('bu-video-css', WPV_BU_URL . 'assets/vendor/lightgallery/css/video.css',[], '8.3.0');

	}

	public function getBaseDevice() {
		return $this->buBaseDevice;
	}

	// Admin Notice for missing license
	function missing_license() {
		global $bu_fs;

		if ( $bu_fs->is_not_paying() ) {
			$url         = admin_url( 'plugins.php?bultr-activate=1' );
			$upgrade_url = $bu_fs->get_upgrade_url();
			?>
		<div class="error bultr-license-error">
			<p>
				<strong>Bricks Ultra</strong><br />
				You license key is missing or invalid. Please <a class="bultr-activate" href="<?php echo esc_attr( $url ); ?>">activate</a> your license.<br/>
				Don't have a license yet? <a href="<?php echo esc_attr( $upgrade_url ); ?>">Get it Now</a>
			</p>
		</div>
			<?php
		}
	}
	function render_schema(){
		if(self::$schemas == null){
			return;
		}
		// loop through $schema and add schema tag to footer
		foreach ( self::$schemas as $schema ) {
			$video_schema = '<script type="application/ld+json" id="bultr-video-schema" >' . wp_json_encode( $schema ) . '</script>';
			echo $video_schema;
		}
	}

	function allow_json_upload($mimes){
		if( is_user_logged_in() ) {
			$user = wp_get_current_user();
			$roles = ( array ) $user->roles;
			if(in_array('administrator',$roles)){
				$mimes['json'] = 'application/json';
				return $mimes;
			}

		}
		return $mimes;
	}	

}

Plugin::instance();
