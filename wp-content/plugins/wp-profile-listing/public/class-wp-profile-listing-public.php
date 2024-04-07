<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/nileshpipaliya
 * @since      1.0.0
 *
 * @package    Wp_Profile_Listing
 * @subpackage Wp_Profile_Listing/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Profile_Listing
 * @subpackage Wp_Profile_Listing/public
 * @author     Nilesh Pipaliya <pipaliyanilesh04@gmail.com>
 */
class Wp_Profile_Listing_Public {

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
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
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
		 * defined in Wp_Profile_Listing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Profile_Listing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-profile-listing-public.css', array(), $this->version );
		wp_enqueue_style( 'datatables-min-css', plugin_dir_url( __FILE__ ) . 'css/datatables.min.css', array(), '2.0.3' );
		wp_enqueue_style( 'select2-min-css', plugin_dir_url( __FILE__ ) . 'css/select2.min.css', array(), $this->version );
		wp_enqueue_style( 'jquery-ui-min-css', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.min.css', array(), $this->version );
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
		 * defined in Wp_Profile_Listing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Profile_Listing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'dataTables-main-js', plugin_dir_url( __FILE__ ) . 'js/dataTables.min.js', array( 'jquery' ), '2.0.3', true );
		wp_enqueue_script( 'select2-min-js', plugin_dir_url( __FILE__ ) . 'js/select2.min.js', array( 'jquery' ), '4.0.3', true );
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-profile-listing-public.js', array( 'jquery', 'dataTables-main-js' ), $this->version, true );
		wp_localize_script(
			$this->plugin_name,
			'ajax_obj',
			array(
				'url'   => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'profile_nonce' ),
			)
		);
	}

	/**
	 * Register shortcodes for Codex profiles.
	 */
	public function codex_profile_shortcodes() {
		add_shortcode( 'profiles', array( $this, 'codex_profile_shortcodes_render' ) );
	}

	/**
	 * Shortcode to show Profile List
	 * Is not used anymore
	 * This the the markup function for the Profile list shortcode
	 *
	 * @since    1.0.0
	 */
	public function codex_profile_shortcodes_render() {
		ob_start();
		?>
		<div class="profile-list-wrapper">
			<form id="profile-filter">
				<div class="profile-form-wrapper">
					<div class="profile-form-full-group">
						<div class="profile-form-group">
							<label for="profile-keyword" class="keyword-label">Keyword</label>
							<input type="text" class="form-control profile-form-control" id="profile-keyword" name="keyword">
						</div>
					</div>
					<div class="profile-form-full-group flex-form-group">
						<div class="profile-form-group">
							<label for="profile-skills">Skills</label>
							<?php
							// Get all skills.
							$skill_terms = get_terms(
								array(
									'taxonomy'   => 'skill',
									'hide_empty' => false,
								)
							);
							if ( ! empty( $skill_terms ) && ! is_wp_error( $skill_terms ) ) {
								echo "<select class='form-control profile-form-control skills-control' name='skills[]' multiple>";
								foreach ( $skill_terms as $term ) {
									printf( '<option value="%s">%s</option>', esc_attr( $term->term_id ), esc_html( $term->name ) );
								}
								echo '</select>';
							}
							?>
						</div>
						<div class="profile-form-group">
							<label for="profile-education">Education</label>
							<?php
							// Get all educations.
							$education_terms = get_terms(
								array(
									'taxonomy'   => 'education',
									'hide_empty' => false,
								)
							);
							if ( ! empty( $education_terms ) && ! is_wp_error( $education_terms ) ) {
								echo "<select class='form-control profile-form-control education-control' name='education[]' multiple>";
								foreach ( $education_terms as $term ) {
									printf( '<option value="%s">%s</option>', esc_attr( $term->term_id ), esc_html( $term->name ) );
								}
								echo '</select>';
							}
							?>
						</div>
					</div>
					<div class="profile-form-full-group flex-form-group">
						<div class="profile-form-group">
							<label for="profile-age-range">Age</label>
							<div id="profile-age-range" data-name="age-range" data-min="0" data-max="100" data-step="1"></div>
							<input type="hidden" name="age_min" id="profile-age-min" value="0" />
							<input type="hidden" name="age_max" id="profile-age-max" value="100" />
						</div>
						<div class="profile-form-group">
							<label for="profile-ratings">Ratings</label>
							<div class="star-rating">
								<input type="radio" id="5-stars" name="ratings" value="5" />
								<label for="5-stars" class="star">&#9733;</label>
								<input type="radio" id="4-stars" name="ratings" value="4" />
								<label for="4-stars" class="star">&#9733;</label>
								<input type="radio" id="3-stars" name="ratings" value="3" />
								<label for="3-stars" class="star">&#9733;</label>
								<input type="radio" id="2-stars" name="ratings" value="2" />
								<label for="2-stars" class="star">&#9733;</label>
								<input type="radio" id="1-star" name="ratings" value="1" />
								<label for="1-star" class="star">&#9733;</label>
							</div>
						</div>
					</div>
					<div class="profile-form-full-group flex-form-group">
						<div class="profile-form-group">
							<label for="profile-jobs-completed">No of Jobs Completed</label>
							<input type="number" id="profile-jobs-completed" class="form-control profile-form-control" name="jobs_completed">
						</div>
						<div class="profile-form-group">
							<label for="profile-experience">Years of Experience</label>
							<input type="number" id="profile-experience" class="form-control profile-form-control" name="experience">
						</div>
					</div>
					<div class="profile-form-actions">
					<button type="submit" class="profile-button">Search</button>
				</div>
				</div>
			</form>
			<table id="profiles-table">
				<thead>
					<tr>
						<th>ID</th>	
						<th>Profile Name</th>
						<th>Age</th>
						<th>Years of Experience</th>
						<th>No. of Jobs Completed</th>
						<th>Ratings</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>	
						<th>Profile Name</th>
						<th>Age</th>
						<th>Years of Experience</th>
						<th>No. of Jobs Completed</th>
						<th>Ratings</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Callback function to get profile data.
	 */
	public function get_profile_data_callback() {
		// Get nonce from POST data.
		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
		if ( ! wp_verify_nonce( $nonce, 'profile_nonce' ) ) {
			// Prepare response array for invalid nonce.
			$response = array(
				'success'              => false,
				'data'                 => array(),
				'iTotalDisplayRecords' => 0,
				'iTotalRecords'        => 0,
			);
			// Return profiles as JSON response.
			wp_send_json( $response );
			wp_die();
		}
		// Retrieve search parameters from AJAX request.
		$name_sorting_order = isset( $_POST['order'][0]['dir'] ) ? sanitize_text_field( wp_unslash( $_POST['order'][0]['dir'] ) ) : 'ASC';
		// Define query arguments based on search parameters.
		$args = array(
			'post_type'      => 'profile',
			'orderby'        => 'title',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'order'          => $name_sorting_order,
		);
		// Retrieve keyword search query from AJAX request.
		$keyword = isset( $_POST['keyword'] ) ? sanitize_text_field( wp_unslash( $_POST['keyword'] ) ) : '';
		if ( ! empty( $_POST['keyword'] ) ) {
			$args['s'] = $keyword;
		}
		// Retrieve skills from AJAX request.
		$skills = isset( $_POST['skills'] ) ? array_map( 'sanitize_text_field', (array) wp_unslash( $_POST['skills'] ) ) : array();
		if ( ! empty( $skills ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'skill',
				'field'    => 'term_id',
				'terms'    => array_map( 'absint', $skills ),
			);
		}

		// Retrieve education from AJAX request.
		$education = isset( $_POST['education'] ) ? array_map( 'sanitize_text_field', (array) wp_unslash( $_POST['education'] ) ) : array();
		if ( ! empty( $education ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'education',
				'field'    => 'term_id',
				'terms'    => array_map( 'absint', $education ),
			);
		}

		// Retrieve age from AJAX request.
		$age_min = isset( $_POST['age_min'] ) ? absint( $_POST['age_min'] ) : 0;
		$age_max = isset( $_POST['age_max'] ) ? absint( $_POST['age_max'] ) : 0;

		if ( $age_min > 0 && $age_max > 0 && $age_min <= $age_max ) {

			$year_min = gmdate( 'Y', strtotime( "-$age_max years" ) );
			$year_max = gmdate( 'Y', strtotime( "-$age_min years" ) );

			$args['meta_query'][] = array(
				'key'     => '_dob',
				'value'   => array( "$year_min-01-01", "$year_max-12-31" ),
				'compare' => 'BETWEEN',
				'type'    => 'DATE',
			);
		}

		// Retrieve ratings from AJAX request.
		$ratings = isset( $_POST['ratings'] ) ? absint( $_POST['ratings'] ) : 0;
		if ( $ratings > 0 ) {
			$args['meta_query'][] = array(
				'key'     => '_ratings',
				'value'   => $ratings,
				'compare' => '=',
				'type'    => 'NUMERIC',
			);
		}

		// Retrieve jobs from AJAX request.
		$no_jobs_completed = isset( $_POST['jobs_completed'] ) ? absint( $_POST['jobs_completed'] ) : 0;
		if ( $no_jobs_completed > 0 ) {
			$args['meta_query'][] = array(
				array(
					'key'     => '_no_jobs_completed',
					'value'   => $no_jobs_completed,
					'compare' => '=',
					'type'    => 'NUMERIC',
				),
			);
		}

		// Retrieve experience from AJAX request.
		$years_of_experience = isset( $_POST['experience'] ) ? absint( $_POST['experience'] ) : 0;
		if ( $years_of_experience > 0 ) {
			$args['meta_query'][] = array(
				array(
					'key'     => '_years_of_experience',
					'value'   => $years_of_experience,
					'compare' => '=',
					'type'    => 'NUMERIC',
				),
			);
		}

		// total profiles.
		$total_profiles         = get_posts( $args );
		$args['posts_per_page'] = isset( $_POST['length'] ) ? absint( $_POST['length'] ) : -1;

		$page = isset( $_POST['start'] ) ? absint( $_POST['start'] ) : 0;
		if ( $page > 0 ) {
			$args['offset'] = $page;
		}

		// Run the query to retrieve matching profiles based on the specified criteria.
		$profile_query = new WP_Query( $args );

		// Build array of profile data to return as JSON response.
		$profiles = array();
		if ( $profile_query->have_posts() ) :
			while ( $profile_query->have_posts() ) :
				$profile_query->the_post();

				$post_id = get_the_ID();
				$ratings = get_post_meta( $post_id, '_ratings', true );
				// Generate star ratings efficiently using str_repeat.
				$stars      = str_repeat( '<span class="star">&#9733;</span>', $ratings );
				$profile    = array(
					'ID'                  => $post_id,
					'name'                => sprintf( '<a href="%s">%s</a>', get_permalink(), get_the_title() ),
					'age'                 => get_post_meta( $post_id, '_dob', true ),
					'no_jobs_completed'   => get_post_meta( $post_id, '_no_jobs_completed', true ),
					'years_of_experience' => get_post_meta( $post_id, '_years_of_experience', true ),
					'ratings'             => $stars,
				);
				$profiles[] = $profile;
			endwhile;
		endif;
		wp_reset_postdata();

		// Response array.
		$response = array(
			'success'              => true,
			'data'                 => $profiles,
			'iTotalDisplayRecords' => count( $total_profiles ),
			'iTotalRecords'        => count( $total_profiles ),
		);

		// Return profiles as JSON response.
		wp_send_json( $response );
		wp_die();
	}
}
