<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/nileshpipaliya
 * @since      1.0.0
 *
 * @package    Wp_Profile_Listing
 * @subpackage Wp_Profile_Listing/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Profile_Listing
 * @subpackage Wp_Profile_Listing/admin
 * @author     Nilesh Pipaliya <pipaliyanilesh04@gmail.com>
 */
class Wp_Profile_Listing_Admin {

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
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
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
		 * defined in Wp_Profile_Listing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Profile_Listing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-profile-listing-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Adds custom meta data to the plugin row on the Plugins page.
	 *
	 * @param array  $plugin_meta An array of the plugin's metadata.
	 * @param string $plugin_file Path to the plugin file relative to the plugins directory.
	 * @return array Modified array of plugin metadata.
	 */
	public function profile_plugin_row_meta( $plugin_meta, $plugin_file ) {
		// Check profile plugin file.
		if ( 'wp-profile-listing/wp-profile-listing.php' === $plugin_file ) {
			// Add shortcode description for WP Profile Listing plugin.
			$plugin_meta[] = '<strong>' . esc_html__( 'Shortcode:', 'wp-profile-listing' ) . '</strong> [profiles]';
		}
		return $plugin_meta;
	}

	/**
	 * Register a custom post type called "Profile".
	 *
	 * @since    1.0.0
	 */
	public function codex_profile_post_type_init() {

		// Set Labels.
		$labels = array(
			'name'               => __( 'Profiles', 'wp-profile-listing' ),
			'singular_name'      => __( 'Profile', 'wp-profile-listing' ),
			'menu_name'          => __( 'Profiles', 'wp-profile-listing' ),
			'name_admin_bar'     => __( 'Profile', 'wp-profile-listing' ),
			'add_new'            => __( 'Add New Profile', 'wp-profile-listing' ),
			'add_new_item'       => __( 'Add New Profile', 'wp-profile-listing' ),
			'new_item'           => __( 'New Profile', 'wp-profile-listing' ),
			'edit_item'          => __( 'Edit Profile', 'wp-profile-listing' ),
			'view_item'          => __( 'View Profile', 'wp-profile-listing' ),
			'all_items'          => __( 'All Profiles', 'wp-profile-listing' ),
			'search_items'       => __( 'Search Profiles', 'wp-profile-listing' ),
			'not_found'          => __( 'No Profiles found.', 'wp-profile-listing' ),
			'not_found_in_trash' => __( 'No Profiles found in Trash.', 'wp-profile-listing' ),
		);
		$args   = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'profile' ),
			'capability_type'    => 'post',
			'menu_icon'          => 'dashicons-businessman',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 5,
			'supports'           => array( 'title' ),
		);
		register_post_type( 'profile', $args );
	}

	/**
	 * Create two taxonomies, Skills and Education for the post type "profiles".
	 *
	 * @since 1.0.0
	 */
	public function codex_profile_taxonomies() {
		// Add skills taxonomy.
		$labels = array(
			'name'          => __( 'Skills', 'wp-profile-listing' ),
			'singular_name' => __( 'Skills', 'wp-profile-listing' ),
			'search_items'  => __( 'Search Skills', 'wp-profile-listing' ),
			'edit_item'     => __( 'Edit Skill', 'wp-profile-listing' ),
			'update_item'   => __( 'Update Skill', 'wp-profile-listing' ),
			'add_new_item'  => __( 'Add New Skill', 'wp-profile-listing' ),
			'new_item_name' => __( 'New Skill Name', 'wp-profile-listing' ),
			'menu_name'     => __( 'Skills', 'wp-profile-listing' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'skill' ),
		);
		register_taxonomy( 'skill', array( 'profile' ), $args );

		unset( $args );
		unset( $labels );

		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'          => __( 'Educations', 'wp-profile-listing' ),
			'singular_name' => __( 'Educations', 'wp-profile-listing' ),
			'search_items'  => __( 'Search Educations', 'wp-profile-listing' ),
			'edit_item'     => __( 'Edit Education', 'wp-profile-listing' ),
			'update_item'   => __( 'Update Education', 'wp-profile-listing' ),
			'add_new_item'  => __( 'Add New Education', 'wp-profile-listing' ),
			'new_item_name' => __( 'New Education Name', 'wp-profile-listing' ),
			'menu_name'     => __( 'Educations', 'wp-profile-listing' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'education' ),
		);
		register_taxonomy( 'education', 'profile', $args );
	}

	/**
	 * Create meta box for the post type "profile".
	 *
	 * @since 1.0.0
	 */
	public function adding_profile_meta_boxes() {
		add_meta_box(
			'profile-meta-box',
			__( 'Profile Information', 'wp-profile-listing' ),
			array( $this, 'render_meta_box' ),
			'profile',
			'normal',
			'high'
		);
	}

	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'profile_inner_custom_box', 'profile_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$dob                 = get_post_meta( $post->ID, '_dob', true );
		$hobbies             = get_post_meta( $post->ID, '_hobbies', true );
		$interests           = get_post_meta( $post->ID, '_interests', true );
		$years_of_experience = get_post_meta( $post->ID, '_years_of_experience', true );
		$ratings             = get_post_meta( $post->ID, '_ratings', true );
		$no_jobs_completed   = get_post_meta( $post->ID, '_no_jobs_completed', true );
		?>
		<table class="form-table profile-metabox-table">
			<tbody>
				<tr>
					<th><label for="dob"><?php esc_html_e( 'DOB', 'wp-profile-listing' ); ?></label></th>
					<td><input type="date" id="dob" name="_dob" value="<?php echo esc_attr( $dob ); ?>"></td>
				</tr>
				<tr>
					<th><label for="hobbies"><?php esc_html_e( 'Hobbies', 'wp-profile-listing' ); ?></label></th>
					<td><input type="text" id="hobbies" name="_hobbies" value="<?php echo esc_attr( $hobbies ); ?>"></td>
				</tr>
				<tr>
					<th><label for="interests"><?php esc_html_e( 'Interests', 'wp-profile-listing' ); ?></label></th>
					<td><input type="text" id="interests" name="_interests" value="<?php echo esc_attr( $interests ); ?>"></td>
				</tr>
				<tr>
					<th><label for="years_of_experience"><?php esc_html_e( 'Years of Experience', 'wp-profile-listing' ); ?></label></th>
					<td><input type="number" id="years_of_experience" name="_years_of_experience" value="<?php echo esc_attr( $years_of_experience ); ?>"></td>
				</tr>
				<tr>
					<th><label for="ratings"><?php esc_html_e( 'Ratings', 'wp-profile-listing' ); ?></label></th>
					<td>
						<input type="number" id="ratings" name="_ratings" min="1" max="5" value="<?php echo esc_attr( $ratings ); ?>">
						<span><i><?php esc_html_e( 'If you do not enter any ratings, it will default to 1.', 'wp-profile-listing' ); ?></i></span>
					</td>
				</tr>
				<tr>
					<th><label for="no_jobs_completed"><?php esc_html_e( 'No. of Jobs Completed', 'wp-profile-listing' ); ?></label></th>
					<td><input type="number" id="no_jobs_completed" name="_no_jobs_completed" value="<?php echo esc_attr( $no_jobs_completed ); ?>"></td>
				</tr>
			</tbody>
		</table>

		<?php
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save_profile_meta_boxes( $post_id ) {
		// Verify that the nonce is valid.
		$nonce = isset( $_POST['profile_inner_custom_box_nonce'] ) ? sanitize_key( $_POST['profile_inner_custom_box_nonce'] ) : '';
		if ( ! $nonce || ! wp_verify_nonce( $nonce, 'profile_inner_custom_box' ) ) {
			return;
		}

		/*
		 * If this is an autosave, our form has not been submitted,
		 * so we don't want to do anything.
		 */
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Sanitize and check DOB.
		$dob = isset( $_POST['_dob'] ) ? sanitize_text_field( wp_unslash( $_POST['_dob'] ) ) : '';
		if ( $dob && ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $dob ) ) {
			wp_die( esc_html__( 'Invalid DOB format. Please follow the yyyy-mm-dd format.', 'wp-profile-listing' ) );
		}
		$today = gmdate( 'Y-m-d' );
		if ( $dob > $today ) {
			wp_die( esc_html__( 'DOB must be a valid past date.', 'wp-profile-listing' ) );
		}

		// Sanitize hobbies and interests.
		$hobbies   = isset( $_POST['_hobbies'] ) ? sanitize_text_field( wp_unslash( $_POST['_hobbies'] ) ) : '';
		$interests = isset( $_POST['_interests'] ) ? sanitize_text_field( wp_unslash( $_POST['_interests'] ) ) : '';
		// Sanitize and check years of experience.
		$years_of_experience = isset( $_POST['_years_of_experience'] ) ? intval( $_POST['_years_of_experience'] ) : 0;
		if ( $years_of_experience < 0 || $years_of_experience > 100 ) {
			wp_die( esc_html__( 'Invalid years of experience. Please enter a value between 0 and 100.', 'wp-profile-listing' ) );
		}
		// Sanitize and check ratings.
		$ratings = ( isset( $_POST['_ratings'] ) && ! empty( $_POST['_ratings'] ) ) ? floatval( $_POST['_ratings'] ) : 1;
		if ( $ratings < 1 || $ratings > 5 ) {
			wp_die( esc_html__( 'Invalid ratings. Please enter a value between 1 and 5.', 'wp-profile-listing' ) );
		}
		// Sanitize and validate number of jobs completed.
		$no_jobs_completed = ( isset( $_POST['_no_jobs_completed'] ) && ! empty( $_POST['_no_jobs_completed'] ) ) ? intval( $_POST['_no_jobs_completed'] ) : 0;
		if ( $no_jobs_completed < 0 ) {
			wp_die( esc_html__( 'Invalid number of jobs completed. Please enter a integer value.', 'wp-profile-listing' ) );
		}

		// Update post meta.
		update_post_meta( $post_id, '_dob', $dob );
		update_post_meta( $post_id, '_hobbies', $hobbies );
		update_post_meta( $post_id, '_interests', $interests );
		update_post_meta( $post_id, '_years_of_experience', $years_of_experience );
		update_post_meta( $post_id, '_ratings', $ratings );
		update_post_meta( $post_id, '_no_jobs_completed', $no_jobs_completed );
	}

	/**
	 * Updates the profile content.
	 *
	 * This function takes the content and updates it according to specific requirements.
	 *
	 * @param string $content The content to be updated.
	 * @return string The updated content.
	 */
	public function codex_update_profile_content( $content ) {
		// Check if current post is a single profile post.
		if ( is_singular( 'profile' ) ) {
			$post_id = get_the_ID();

			// Define metadata field.
			$metadata_fields = array(
				'_dob'                 => __( 'Date of Birth', 'wp-profile-listing' ),
				'_hobbies'             => __( 'Hobbies', 'wp-profile-listing' ),
				'_interests'           => __( 'Interests', 'wp-profile-listing' ),
				'_years_of_experience' => __( 'Years of Experience', 'wp-profile-listing' ),
				'_ratings'             => __( 'Ratings', 'wp-profile-listing' ),
				'_no_jobs_completed'   => __( 'Jobs Completed', 'wp-profile-listing' ),
			);

			// Initialize empty string for efficiency.
			$metadata_html = '';
			// Retrieve all meta fields at once for efficiency.
			$post_meta = get_post_custom( $post_id );
			// Efficiently create the metadata string.
			$metadata_html .= '<ul class="profile-metadata">';
			foreach ( $metadata_fields as $key => $label ) {
				$field_value = isset( $post_meta[ $key ] ) ? $post_meta[ $key ][0] : '';
				if ( $field_value ) {
					$metadata_html .= '<li><strong>' . esc_html( $label ) . ':</strong> ' . esc_html( $field_value ) . '</li>';
				}
			}

			// Get skills and education terms directly without unnecessary variables.
			$metadata_html .= '<li><strong>' . __( 'Skills', 'wp-profile-listing' ) . ':</strong> ' . get_the_term_list( $post_id, 'skill', '<ul><li>', '</li><li>', '</li></ul>' ) . '</li>';
			$metadata_html .= '<li><strong>' . __( 'Education', 'wp-profile-listing' ) . ':</strong> ' . get_the_term_list( $post_id, 'education', '<ul><li>', '</li><li>', '</li></ul>' ) . '</li>';
			$metadata_html .= '</ul>';
			// Append metadata to content.
			$content .= $metadata_html;
		}
		return $content;
	}
}
