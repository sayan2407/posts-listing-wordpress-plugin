<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://thecodingjobs.online/
 * @since      1.0.0
 *
 * @package    Content_Layout
 * @subpackage Content_Layout/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Content_Layout
 * @subpackage Content_Layout/public
 * @author     Sayan Pal <thecodingjobs@gmail.com>
 */
class Content_Layout_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode('content_layout', [$this, 'custom_shortcode']);

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Content_Layout_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Content_Layout_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/content-layout-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Content_Layout_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Content_Layout_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/content-layout-public.js', array( 'jquery' ), $this->version, false );

	}

	public function create_custom_menu() {
	
		register_post_type(
			'layout', [
					'label'	=> __( 'Layout', 'content-layout' ),
					'labels'	=>	__( 'Layouts', 'content-layout' ),
					'public'	=>	true,
					'supports'	=>	['title'],
					'hierarchical'	=>	true
				]
			);
	
		}

	public function custom_shortcode($arg)	{
		error_log('arg ' . print_r($arg, 1));
		ob_start();
		?>
		<p>Hii</p>
		<?php
		return ob_get_clean();
	}

}
