<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://thecodingjobs.online/
 * @since      1.0.0
 *
 * @package    Content_Layout
 * @subpackage Content_Layout/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Content_Layout
 * @subpackage Content_Layout/admin
 * @author     Sayan Pal <thecodingjobs@gmail.com>
 */
class Content_Layout_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/content-layout-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/content-layout-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function save_custom_fields() {

		global $post;
		// error_log( 'post ' . print_r( $post, 1 ) );

		if( $post->post_type == "layout" ) {

			$post_type_field = [];
			$taxonomy_field = [];
			$is_enable_pagination = [];
			$format = [];
			$field_settings = [];
			$layout_view = [];

			if ( isset( $_POST['choosen_post_types'] ) )
				$post_type_field = $_POST['choosen_post_types'];

			if ( isset( $_POST['select_taxonomy'] ) )
				$taxonomy_field = $_POST['select_taxonomy'];

		    if ( isset( $_POST['has_pagination'] ) )
				$is_enable_pagination = $_POST['has_pagination'];

			if ( isset( $_POST['content_format'] ) )
				$format = $_POST['content_format'];
			

			if ( isset( $_POST['field_settings'] ) )
				$field_settings = $_POST['field_settings'];

			if ( isset( $_POST['layout_view'] ) )
				$layout_view = $_POST['layout_view'];

			error_log('post_type_field '. print_r( $post_type_field, 1 ));
			error_log('taxonomy_field '. print_r( $taxonomy_field, 1 ));
			error_log('is_enable_pagination '. print_r( $is_enable_pagination, 1 ));
			error_log('format '. print_r( $format, 1 ));
			error_log('field_settings '. print_r( $field_settings, 1 ));
			error_log('layout_view '. print_r( $layout_view, 1 ));
			
		}
	}

	public function custom_meta_boxes() {
		$custom_metaboxes = [
			'0'	=>	[
				'id'	=>	'layout_view',
				'title'	=>	__( 'Layout View', 'content-layout' ),
				'callable'	=>	[ $this, 'custom_Layout_info' ],
				'type'	=>	'layout'
			],
			'1'	=>	[
				'id'	=>	'content_view',
				'title'	=>	__( 'Content View', 'content-layout' ),
				'callable'	=>	[ $this, 'custom_content_view' ],
				'type'	=>	'layout'
			],
			'2'	=>	[
				'id'	=>	'filter_settings',
				'title'	=>	__( 'Filtered By Taxonomies', 'content-layout' ),
				'callable'	=>	[ $this,  'filter_by_taxonomy' ],
				'type'	=>	'layout'
			],
		'3'	=>	[
				'id'	=>	'post_type_settings',
				'title'	=>	__( 'Choose Post Types', 'content-layout' ),
				'callable'	=>	[ $this,  'choose_post_types' ],
				'type'	=>	'layout'
				]
		];
		foreach( $custom_metaboxes as $value ) {
			add_meta_box(
				$value['id'],
				$value['title'],
				$value['callable'],
				$value['type']
			);
		}
		// add_meta_box( 
		// 	'layout_view', 
		// 	__( 'Layout View', 'content-layout' ),
		// 	[ $this, 'custom_Layout_info' ],
		// 	'layout' 
		// );

		// add_meta_box(
		// 	'content_view',
		// 	__( 'Content View', 'content-layout' ),
		// 	[ $this, 'custom_content_view' ],
		// 	'layout'
		// );

		// add_meta_box(
		// 	'filter_settings',
		// 	__( 'Filtered By Taxonomies', 'content-layout' ),
		// 	[ $this,  'filter_by_taxonomy' ],
		// 	'layout'
		// );

		// add_meta_box(
		// 	'post_type_settings',
		// 	__( 'Choose Post Types', 'content-layout' ),
		// 	[ $this,  'choose_post_types' ],
		// 	'layout'
		// );

	}

	public function choose_post_types() {
		$args = array(
			'public'   => true,
			'_builtin' => false
		 );
		  
		 $output = 'names'; // names or objects, note names is the default
		 $operator = 'and'; // 'and' or 'or'
		$all_post_types = get_post_types( $args, $output, $operator );
		$all_post_types['posts'] = 'posts';
		error_log('all_post_types '. print_r($all_post_types, 1));
		?>
		<div>
			<strong><?php _e('choose post types : ', 'content-layout'); ?></strong><br><br>
			<select name="choosen_post_types">
				<option><?php _e('select post type', 'content-layout'); ?></option>
				<?php
				  foreach( $all_post_types as $val ) {
					  ?>
					  <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
					  <?php
				  }
				?>
			</select>

			<div>

			</div>
		</div>
		<?php
	}

	public function filter_by_taxonomy() {
		?>
			<div>
				<strong><?php _e('Select Taxonoy : ', 'content-layout'); ?></strong><br><br>
				<div style="display: flex; align-items: center;">
					<input type="checkbox" id="cat_taxonomy" name="select_taxonomy[]" value="0">
					<label style="margin-right: 15px;" for="cat_taxonomy"><?php _e( 'Categories', 'content-layout' ); ?></label>

					<input type="checkbox" id="tag_taxonomy" name="select_taxonomy[]" value="1">
					<label for="tag_taxonomy"><?php _e( 'Tags', 'content-layout' ); ?></label>

				</div>
			

			</div>
		<?php
	}

	public function custom_content_view() {

		?>

		<div>
			<strong> <?php _e( 'Format: ', 'content-layout' ); ?> </strong><br>

			<div>
				<input type="radio" id="content_vertically" name="content_format" value="0">
				<label for="content_vertically"> <?php _e('Show thumbnail & text vertically', 'content-layout'); ?> </label><br>
				
				<input type="radio" id="content_horizontally" name="content_format" value="1">
				<label for="content_horizontally"> <?php _e('Show thumbnail on the left/right of text', 'content-layout'); ?> </label>
			</div>

		</div><br>

		<div>
			<strong> <?php _e( 'Field Settings: ', 'content-layout' ); ?> </strong><br>
			<div>
				<input type="checkbox" id="show_thumbnail" name="field_settings[]" value="0">
				<label for="show_thumbnail"><?php _e('Show Thumbnail', 'content-layout'); ?></label><br>

				<input type="checkbox" id="show_title" name="field_settings[]" value="1">
				<label for="show_title"><?php _e('Show Title', 'content-layout'); ?></label><br>

				<input type="checkbox" id="show_excerpt" name="field_settings[]" value="2">
				<label for="show_excerpt"><?php _e('Show Excerpt', 'content-layout'); ?></label><br>

				<input type="checkbox" id="show_metafields" name="field_settings[]" value="3">
				<label for="show_metafields"><?php _e('Show Metafields', 'content-layout'); ?></label><br>

			</div>

		</div><br>

		<div>
			<strong> <?php _e( 'Pagination: ', 'content-layout' ); ?> </strong><br>

			<div>
				<input type="checkbox" id="enable_pagination" name="has_pagination[]" value="1">
				<label for="enable_pagination"> <?php _e( 'Enable Pagination', 'content-layout' ); ?> </label>
			</div>

		  

		</div>

		<?php

	}

	public function custom_Layout_info() {
		global $post;
		$post_id = $post->ID;

		?>

		<div>
			<h2 style="padding: 0;"><strong><?php _e( 'Choose Your Layout Structure', 'content-layout' ); ?></strong></h2><br>
			<input type="radio" id="grid_view" name="layout_view" value="0">
			<label for="grid_view"> <?php _e('Grid View', 'content-layout'); ?> </label><br>

			<div class="if_choose_grid">
				<label for="items_row"> <?php _e('Items Per Row: ', 'content-layout'); ?> </label><br>
				<input type="number" id="items_row" min="1" max="5"><span class="items_row_hints"> 1 -> 5 </span><br>

				<label for="items_row_tablet"> <?php _e('Items Per Row ( Tablet ): ', 'content-layout'); ?> </label><br>
				<input type="number" id="items_row_tablet" min="1" max="3"><span class="items_row_hints"> 1 -> 3 </span><br>

				<label for="items_row_mobile"> <?php _e('Items Per Row (Mobile): ', 'content-layout'); ?> </label><br>
				<input type="number" id="items_row_mobile" min="1" max="2"><span class="items_row_hints"> 1 -> 2 </span><br>
			</div>

			<input type="radio" id="list_view" name="layout_view" value="1">
			<label for="list_view"> <?php _e('List View', 'content-layout'); ?> </label>

		</div>

		


		<?php
	}

}
