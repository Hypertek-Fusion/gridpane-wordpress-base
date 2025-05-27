<?php

namespace BricksUltra\Admin;

use BricksUltra\includes\Helper;

class Admin
{


	private $prefix;
	private $helper;

	public function __construct()
	{	
		// actions
		add_action('admin_menu', [$this, 'admin_init'], 400);
		add_action('admin_enqueue_scripts', [$this, 'register_scripts_styles']);

		// ajax
		add_action('wp_ajax_wpv_bu_save_modules', [$this, 'save_modules']);
		$this->helper = new Helper();
		$this->prefix = $this->helper->get_domain_prefix();

		// add inline script
		add_action('admin_footer', [$this, 'add_inline_script']);
	}

	public function admin_init()
	{

		add_submenu_page(
			'bricks',
			'Bricks Ultra',
			'Bricks Ultra',
			'manage_options',
			'bultr-settings',
			[$this, 'admin_page']
		);
	}

	public function register_scripts_styles()
	{
		$screen = get_current_screen();

		if ($screen->id === 'bricks_page_bultr-settings') {
			$this->load_scripts();
			$this->load_styles();
		}
	}

	public function load_scripts()
	{
		$handle = $this->prefix . '_admin-js';
		wp_register_script($handle, WPV_BU_URL . 'assets/admin/js/index.js', [], WPV_BU_VERSION, true);
		wp_enqueue_script($handle);

		wp_localize_script(
			$handle,
			$this->prefix . 'admin_localizer',
			[
				'adminUrl'   => admin_url('/'),
				'ajaxUrl'    => admin_url('admin-ajax.php'),
				'apiUrl'     => home_url('/wp-json'),
				'nonce'      => wp_create_nonce('wpv_bu_nonce'),
				'modules'    => $this->helper->get_modules(),
				'settings'   => $this->helper->get_initial_settings(),
				'plugin_url' => WPV_BU_URL,
			]
		);
	}

	public function load_styles()
	{
		$handle = $this->prefix . '_admin-css';
		wp_register_style($handle, WPV_BU_URL . 'assets/admin/css/index.css', [], WPV_BU_VERSION);

		wp_enqueue_style($handle);
	}

	public function save_modules()
	{
		if (!wp_verify_nonce($_POST['nonce'], 'wpv_bu_nonce')) {
			wp_send_json_error(
				[
					'message' => 'Invalid nonce',
				]
			);
		}

		try {
			$settings = (array) $this->helper->sanitize_text_or_array_field(json_decode(stripslashes($_POST['settings'])));

			$saved_settings = get_option('wpv_bu_settings', []);

			foreach ($settings as $key => $value) {
				$saved_settings['modules'][$key] = $value;
			}

			update_option('wpv_bu_settings', $saved_settings);

			wp_send_json_success(
				[
					'message' => 'Settings saved',
				]
			);
		} catch (\Exception $e) {
			wp_send_json_error(
				[
					'message' => $e->getMessage(),
				]
			);
		}
	}

	public function admin_page()
	{
?>
		<div id="bricks-ultra-settings">
			loading...
		</div>
<?php
	}

	// add inline script only on plugins page
	public function add_inline_script()
	{	
		$screen = get_current_screen();
		
		// add script if screen id is plugins
		if($screen->id === 'plugins') {

			
			?>
			<script type="text/javascript">
				const missing_license = document.querySelector('.bultr-activate');

				const activate_license = document.querySelector('.activate-license.bricks-ultra a');

				missing_license.addEventListener('click', (e) => {
					e.preventDefault();
					activate_license.click();
				});

				<?php 
					if(isset($_GET['bultr-activate']) && $_GET['bultr-activate'] === '1') {
				?>
				window.addEventListener('load', () => {
					activate_license.click();
				});
				<?php
					}
				?>
			</script>	
			<?php
		}
	}
}
