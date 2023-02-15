<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/arunkumar-raj
 * @since      1.0.0
 *
 * @package    Ltp
 * @subpackage Ltp/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ltp
 * @subpackage Ltp/admin
 * @author     Arunkumar <arunkumar.ram87@gmail.com>
 */
class Ltp_Admin
{

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
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}


	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ltp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ltp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_media();
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/ltp-admin.js', array('jquery'), $this->version, true); 

	}

	/**
	 * Register the Leagues Taxonomy and Teams Post type.
	 *
	 * @since    1.0.0
	 */
	public function register_leagues_and_teams()
	{

		$args = [
			'label'  => esc_html__('Leagues', 'ltp'),
			'labels' => [
				'menu_name'                  => esc_html__('Leagues', 'ltp'),
				'all_items'                  => esc_html__('All Leagues', 'ltp'),
				'edit_item'                  => esc_html__('Edit League', 'ltp'),
				'view_item'                  => esc_html__('View League', 'ltp'),
				'update_item'                => esc_html__('Update League', 'ltp'),
				'add_new_item'               => esc_html__('Add new League', 'ltp'),
				'new_item'                   => esc_html__('New League', 'ltp'),
				'parent_item'                => esc_html__('Parent League', 'ltp'),
				'parent_item_colon'          => esc_html__('Parent League', 'ltp'),
				'search_items'               => esc_html__('Search Leagues', 'ltp'),
				'popular_items'              => esc_html__('Popular Leagues', 'ltp'),
				'separate_items_with_commas' => esc_html__('Separate Leagues with commas', 'ltp'),
				'add_or_remove_items'        => esc_html__('Add or remove Leagues', 'ltp'),
				'choose_from_most_used'      => esc_html__('Choose most used Leagues', 'ltp'),
				'not_found'                  => esc_html__('No Leagues found', 'ltp'),
				'name'                       => esc_html__('Leagues', 'ltp'),
				'singular_name'              => esc_html__('League', 'ltp'),
			],
			'public'               => true,
			'show_ui'              => true,
			'show_in_menu'         => true,
			'show_in_nav_menus'    => true,
			'show_tagcloud'        => true,
			'show_in_quick_edit'   => true,
			'show_admin_column'    => true,
			'show_in_rest'         => true,
			'hierarchical'         => true,
			'query_var'            => true,
			'sort'                 => false,
			'rewrite_no_front'     => false,
			'rewrite_hierarchical' => false,
			'rewrite' => true
		];
		register_taxonomy('league', ['team'], $args);

		$args = [
			'label'  => esc_html__('Keywords', 'your-textdomain'),
			'labels' => [
				'menu_name'                  => esc_html__('Keywords', 'your-textdomain'),
				'all_items'                  => esc_html__('All Keywords', 'your-textdomain'),
				'edit_item'                  => esc_html__('Edit Keyword', 'your-textdomain'),
				'view_item'                  => esc_html__('View Keyword', 'your-textdomain'),
				'update_item'                => esc_html__('Update Keyword', 'your-textdomain'),
				'add_new_item'               => esc_html__('Add new Keyword', 'your-textdomain'),
				'new_item'                   => esc_html__('New Keyword', 'your-textdomain'),
				'parent_item'                => esc_html__('Parent Keyword', 'your-textdomain'),
				'parent_item_colon'          => esc_html__('Parent Keyword', 'your-textdomain'),
				'search_items'               => esc_html__('Search Keywords', 'your-textdomain'),
				'popular_items'              => esc_html__('Popular Keywords', 'your-textdomain'),
				'separate_items_with_commas' => esc_html__('Separate Keywords with commas', 'your-textdomain'),
				'add_or_remove_items'        => esc_html__('Add or remove Keywords', 'your-textdomain'),
				'choose_from_most_used'      => esc_html__('Choose most used Keywords', 'your-textdomain'),
				'not_found'                  => esc_html__('No Keywords found', 'your-textdomain'),
				'name'                       => esc_html__('Keywords', 'your-textdomain'),
				'singular_name'              => esc_html__('Keyword', 'your-textdomain'),
			],
			'public'               => true,
			'show_ui'              => true,
			'show_in_menu'         => true,
			'show_in_nav_menus'    => true,
			'show_tagcloud'        => true,
			'show_in_quick_edit'   => true,
			'show_admin_column'    => true,
			'show_in_rest'         => true,
			'hierarchical'         => false,
			'query_var'            => true,
			'sort'                 => false,
			'rewrite_no_front'     => false,
			'rewrite_hierarchical' => false,
			'rewrite' => true
		];
		register_taxonomy('keyword', ['team'], $args);

		$args = [
			'label'  => esc_html__('Teams', 'text-domain'),
			'labels' => [
				'menu_name'          => esc_html__('Teams', 'ltp'),
				'name_admin_bar'     => esc_html__('Team', 'ltp'),
				'add_new'            => esc_html__('Add Team', 'ltp'),
				'add_new_item'       => esc_html__('Add new Team', 'ltp'),
				'new_item'           => esc_html__('New Team', 'ltp'),
				'edit_item'          => esc_html__('Edit Team', 'ltp'),
				'view_item'          => esc_html__('View Team', 'ltp'),
				'update_item'        => esc_html__('View Team', 'ltp'),
				'all_items'          => esc_html__('All Teams', 'ltp'),
				'search_items'       => esc_html__('Search Teams', 'ltp'),
				'parent_item_colon'  => esc_html__('Parent Team', 'ltp'),
				'not_found'          => esc_html__('No Teams found', 'ltp'),
				'not_found_in_trash' => esc_html__('No Teams found in Trash', 'ltp'),
				'name'               => esc_html__('Teams', 'ltp'),
				'singular_name'      => esc_html__('Team', 'ltp'),
				'featured_image'        => __('Logo', 'ltp'),
				'set_featured_image'    => __('Set Logo image', 'ltp'),
				'remove_featured_image' => __('Remove Logo image', 'ltp'),
				'use_featured_image'    => __('Use as Logo image', 'ltp'),
			],
			'public'              => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'show_in_rest'        => true,
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite_no_front'    => false,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-awards',
			'supports' => [
				'title',
				'editor',
				'thumbnail',
				'custom-fields',
				'excerpt'
			],

			'rewrite' => true
		];

		register_post_type('team', $args);
		flush_rewrite_rules();
	}

	/**
	 * Add League Logo for the taxnomy in the Add League page.
	 *
	 * @since    1.0.0
	 */

	public function add_league_logo($taxonomy)
	{
		?>
			<div class="form-field term-group" id="league-container">
				<label for="league-logo-id"><?php _e('Logo', 'ltp'); ?></label>
				<div class="custom-img-container"></div>		
				<p class="hide-if-no-js">				
					<input type="button" class="button button-secondary upload-custom-img" value="<?php _e('Add Logo', 'ltp'); ?>" />
					<input type="button" class="button button-secondary delete-custom-img hidden"  value="<?php _e('Remove Logo', 'ltp'); ?>" />
				</p>
				<input class="league-logo-id" name="league-logo-id" type="hidden" value="" />			
			</div>
		<?php
	}

	/**
	 * Update League Logo for the taxnomy in the Edit League page.
	 *
	 * @since    1.0.0
	 */

	public function edit_league_logo($term, $taxonomy)
	{
		?>
			<tr class="form-field term-group-wrap" id="league-container">
				<th scope="row">
					<label for="league-logo-id"><?php _e('Logo', 'ltp'); ?></label>
				</th>
				<td>
					<?php $image_id = get_term_meta($term->term_id, 'league-logo-id', true); ?>
					<input type="hidden" class="league-logo-id" name="league-logo-id" value="<?php echo $image_id; ?>">
					<div class="custom-img-container">
						<?php if ($image_id) { ?>
							<?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
						<?php } ?>
					</div>
					<p>
						<input type="button" class="button button-secondary upload-custom-img <?php if ( $image_id  ) { echo 'hidden'; } ?>" value="<?php _e('Add Logo', 'ltp'); ?>" />
						<input type="button" class="button button-secondary delete-custom-img <?php if ( ! $image_id  ) { echo 'hidden'; } ?>"  value="<?php _e('Remove Logo', 'ltp'); ?>" />
					</p>
				</td>
			</tr>
		<?php
	}

	/**
	 * Save the Logo.
	 *
	 * @since    1.0.0
	 */
	public function save_logo($term_id)
	{
		if (isset($_POST['league-logo-id']) && '' !== $_POST['league-logo-id']) {
			$image = absint($_POST['league-logo-id']);
			add_term_meta($term_id, 'league-logo-id', $image, true);
		}
	}

	/**
	 * Update the Logo.
	 *
	 * @since    1.0.0
	 */
	public function update_logo($term_id)
	{
		if (isset($_POST['league-logo-id']) && '' !== $_POST['league-logo-id']) {
			$image = absint($_POST['league-logo-id']);
			update_term_meta($term_id, 'league-logo-id', $image);
		} else {
			update_term_meta($term_id, 'league-logo-id', '');
		}
	}

	/**
	 * Custom meta box.
	 *
	 * @since    1.0.0
	 */
	public function team_meta_box_setup()
	{
		add_meta_box('teamnickname', __('Nick name','ltp'), array($this,'nick_name_team_metabox'));
	}

	/**
	 * Custom meta box for nickname.
	 *
	 * @since    1.0.0
	 */
	public function nick_name_team_metabox($post){
		$nickname='';
		if(!empty($post)){
			$nickname  = get_post_meta($post->ID, 'team-nickname',true);
		}
		?>
		<input type="text" name="team_nickname" id="team_nickname" class="" value="<?php echo $nickname; ?>"/>
		<?php
	}

	/**
	 * save custom field value.
	 *
	 * @since    1.0.0
	 */
	public function save_custom_field_value($post_id){

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['team_nickname'] ) ) {
			return;
		}
		
		update_post_meta($post_id, 'team-nickname', $_POST['team_nickname']);
	}
	
	
}
