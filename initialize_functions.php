<?php
/*
Plugin Name: OpenBroker Connector for RealHomes Theme
Plugin URI: https://www.openbroker.com/
Description: Connect your RealHomes Theme with official WordPress plugin for OpenBroker.com integration.
Author: teamopenbroker
Version: 1.0
*/

define( 'OPENBROKER_RH_PLUGIN_PATH', plugins_url( '', __FILE__ ) );

class WPM_Core {

	private $settings;
	private $propertiesMapOptions;
	private $objects_list;

	/**
	 * Initialize functions
	 */
	public function __construct() {
		// Init Functions
		add_action( 'init', [ $this, 'save_settings' ] );
		add_action( 'init', [ $this, 'load_settings' ] );

		// Frontend Functions
		add_action( 'template_include', [ $this, 'change_main_templates' ] );

		// Include Styles and Scripts
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts_and_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'include_scripts_and_styles' ], 99 );

		// Remove Script
		add_action( 'wp_print_scripts', [ $this, 'remove_scripts_from_template' ] );

		// Redirect to API Single property
		add_filter( 'status_header', [ $this, 'api_properties_page_redirect' ], - 1 );

		// Admin menu
		add_action( 'admin_menu', [ $this, 'register_menu' ] );

		// Ajax Functions
		add_action( 'wp_ajax_load_cities', [ $this, 'load_cities_list' ] );
		add_action( 'wp_ajax_nopriv_load_cities', [ $this, 'load_cities_list' ] );
	}

	/**
	 * Change Default Template on Manual
	 */
	public function change_main_templates( $template ) {
		$template_url = explode( '/', $template );

		if ( in_array( 'home.php', $template_url ) ) {
			$template = __DIR__ . '/templates/frontend/home/home.php';
		} elseif ( in_array( 'properties-search.php', $template_url ) ) {
			$template = __DIR__ . '/templates/frontend/search/properties-search.php';
		}

		return $template;
	}

	/**
	 * Load Data from API
	 */
	public function properties_type( $type, $object = null ) {
		if ( isset( $_GET['property-id'] ) ) {
			$id = sanitize_url( $_GET['property-id'] );
			wp_redirect( get_home_url() . "/property/{$id}" );
			exit;
		} elseif ( $type == 'home' ) {
			// Set Settings before Get properties
			$num_posts    = intval( get_option( 'theme_properties_on_home' ) );
			$objects_list = $this->get_properties_data( "/properties/?per_page=$num_posts" );
		} elseif ( $type == 'search' ) {
			// Set Settings before Get properties
			$num_posts = intval( get_option( 'theme_properties_on_search' ) );
			$paged     = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

			$beds        = isset( $_GET['bedrooms'] ) ? sanitize_text_field( $_GET['bedrooms'] ) : '';
			$baths       = isset( $_GET['bathrooms'] ) ? sanitize_text_field( $_GET['bathrooms'] ) : '';
			$price_min   = isset( $_GET['min-price'] ) ? sanitize_text_field( $_GET['min-price'] ) : '';
			$price_max   = isset( $_GET['max-price'] ) ? sanitize_text_field( $_GET['max-price'] ) : '';
			$prop_type   = isset( $_GET['type'] ) ? sanitize_text_field( $_GET['type'] ) : '';
			$size_min    = isset( $_GET['min-area'] ) ? sanitize_text_field( $_GET['min-area'] ) : '';
			$size_max    = isset( $_GET['max-area'] ) ? sanitize_text_field( $_GET['max-area'] ) : '';
			$sort        = isset( $_GET['sortby'] ) ? sanitize_text_field( $_GET['sortby'] ) : 'created_at_desc';
			$search_city = isset( $_GET['location'] ) ? sanitize_text_field( $_GET['location'] ) : '';

			$features         = isset( $_GET['features'] ) ? $_GET['features'] : [];
			$fireplace        = in_array( 'has_fireplace', $features ) ? 'true' : '';
			$balcony          = in_array( 'has_balcony', $features ) ? 'true' : '';
			$garage           = in_array( 'has_parking', $features ) ? 'true' : '';
			$elevator         = in_array( 'has_elevator', $features ) ? 'true' : '';
			$air_conditioning = in_array( 'has_ac', $features ) ? 'true' : '';
			$pool             = in_array( 'has_pool', $features ) ? 'true' : '';
			$security         = in_array( 'has_security', $features ) ? 'true' : '';
			$garden           = in_array( 'has_garden', $features ) ? 'true' : '';
			$furnished        = in_array( 'is_furnished', $features ) ? 'true' : '';
			$exclusive        = in_array( 'exclusive', $features ) ? 'true' : '';

			// Get Objects from API
			$objects_list = $this->get_properties_data( "/properties/?sort_by=$sort&exclusive=$exclusive&is_furnished=$furnished&has_garden=$garden&has_security=$security&has_pool=$pool&has_ac=$air_conditioning&has_elevator=$elevator&has_parking=$garage&has_balcony=$balcony&has_fireplace=$fireplace&search_area_id=$search_city&per_page=$num_posts&page=$paged&beds=$beds&baths=$baths&max_price=$price_max&min_price=$price_min&property_type=$prop_type&max_built_area=$size_max&min_built_area=$size_min" );

			// Create Map with Markers
			wp_localize_script( 'map-properties', 'propertiesMapData', $this->get_map_markers( $objects_list ) );
			wp_localize_script( 'map-properties', 'propertiesMapOptions', $this->propertiesMapOptions );
			wp_enqueue_script( 'map-properties' );
		} elseif ( $type == 'similar_objects' && $object ) {
			// Set Settings before Get properties
			$num_posts = 4;
			$beds      = isset( $object['beds'] ) && $object['beds'] > 0 ? $object['beds'] : '';
			$baths     = isset( $object['baths'] ) && $object['baths'] > 0 ? $object['baths'] : '';
			$prop_type = isset( $object['property_type'] ) ? $object['property_type'] : '';
			$price     = isset( $object['price'] ) ? (int) $object['price'] : 0;

			$fireplace        = $object['climate_control']['fireplace'] == 1 ? 'true' : '';
			$balcony          = $object['feature']['has_balcony'] == 1 ? 'true' : '';
			$garage           = ! empty( array_keys( array_filter( $object['parking'] ) ) ) ? 'true' : '';
			$elevator         = $object['feature']['has_elevator'] == 1 ? 'true' : '';
			$air_conditioning = $object['climate_control']['air_conditioning'] == 1 ? 'true' : '';
			$pool             = ! empty( array_keys( array_filter( $object['pool'] ) ) ) ? 'true' : '';
			$security         = ! empty( array_keys( array_filter( $object['security'] ) ) ) ? 'true' : '';
			$garden           = $object['view']['garden'] == 1 ? 'true' : '';
			$furnished        = $object['furniture'] == 'furnished' ? 'true' : '';
			$exclusive        = $object['exclusive'] != '' ? 'true' : '';

			// Range Price Similar Objects
			$discount  = 40;
			$price_min = $price - ( $price * ( $discount / 100 ) );
			$price_max = $price + ( $price * ( $discount / 100 ) );

			// Get Objects from API
			$objects_list = $this->get_properties_data( "/properties/?max_price=$price_max&min_price=$price_min&exclusive=$exclusive&is_furnished=$furnished&has_garden=$garden&has_security=$security&has_pool=$pool&has_ac=$air_conditioning&has_elevator=$elevator&has_parking=$garage&has_balcony=$balcony&has_fireplace=$fireplace&per_page=$num_posts&property_type=$prop_type&beds=$beds&baths=$baths" );
		} elseif ( $type == 'city_list' && $object ) {
			$objects_list = $this->get_properties_data( "/search_areas?query=$object" );
		} elseif ( $type == 'only_stats' && $object ) {
			// Get Objects from API
			$objects_list = $this->get_properties_data( "/properties/?$object[param]=$object[value]" );
		}

		return $objects_list;
	}

	/**
	 * Load Cities List Ajax
	 */
	public function load_cities_list() {
		$url_query = str_replace( ' ', '+', sanitize_text_field( $_POST['search'] ) );
		wp_send_json( $this->properties_type( 'city_list', $url_query ) );
	}

	/**
	 * Prepare Map Markers
	 */
	public function get_map_markers( $objects_list ) {
		// Prepare it to Map format
		$markers = [];
		if ( isset( $objects_list['data'] ) ) {
			foreach ( $objects_list['data'] as $object ) {
				$markers[] = [
					'title'      => ucfirst( $object['property_type'] ) . " in " . $object['address']['province'] . ", " . $object['address']['city'],
					'price'      => '€' . number_format( $object['price'], 0, ",", "," ),
					'url'        => get_home_url() . "/property/{$object['id']}",
					'lat'        => $object['address']['lat'],
					'lng'        => $object['address']['lng'],
					'thumb'      => $object['pictures'][0]['url'],
					'icon'       => get_template_directory_uri() . '/assets/classic/images/map/single-family-home-map-icon.png',
					'retinaIcon' => get_template_directory_uri() . '/assets/classic/images/map/single-family-home-map-icon@2x.png'
				];
			}
		}

		return $markers;
	}

	/**
	 * Get Properties from OpenBroker
	 */
	public function get_properties_data( $url_query ) {
		$response = wp_remote_post( $this->settings['api_url'] . $url_query, array(
			'method'  => 'GET',
			"timeout" => 100,
			'headers' => [
				"Content-type" => "application/json",
				"APP_ID"       => $this->settings['app_id'],
				"API_KEY"      => $this->settings['api_key']
			]
		) );

		return json_decode( $response['body'], true );
	}

	/**
	 * Try to map virtual URI with property
	 */
	public function api_properties_page_redirect( $header ) {
		global $wp_query;
		global $page_name;

		if ( is_404() ) {
			// Get Request URL Parts
			$url  = parse_url( sanitize_url( $_SERVER['REQUEST_URI'] ) );
			$path = explode( '/', $url['path'] );

			// Search property ID in URL
			foreach ( $path as $name ) {
				if ( strpos( $name, "house_" ) !== false ) {
					$object_id = $name;
				}
			}

			// Check if its property ID from API
			if ( isset( $object_id ) ) {
				// Get Random post for correct configure page
				$args     = array(
					'post_type'      => 'property',
					'posts_per_page' => 1
				);
				$wp_query = new WP_Query( $args );

				// Get Random Post ID
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$id = get_the_ID();
				endwhile;

				// Configure WP Query
				$post                        = get_post( $id );
				$wp_query->queried_object    = $post;
				$wp_query->is_single         = true;
				$wp_query->is_404            = false;
				$wp_query->queried_object_id = $post->ID;
				$wp_query->post_count        = 1;
				$wp_query->current_post      = - 1;
				$wp_query->posts             = array( $post );

				// Get property Data
				$object = $this->get_properties_data( "/properties/$object_id" );
				$object = $object['data'];
				$beds   = $object['beds'];

				// Get Similar Properties
				$objects_similar = $this->properties_type( 'similar_objects', $object );

				// Create new Title for Page
				if ( $beds != '' ) {
					$page_name = $beds . ' Bedroom ' . ucwords( $object['property_type'] );
				} else {
					$page_name = ucwords( $object['property_type'] );
				}

				// Include Template for API property
				add_filter( 'template_include', function () use ( $object, $objects_similar, $page_name ) {
					include 'templates/frontend/single/single-property.php';
				}, 99 );

				if ( strpos( sanitize_url( $_SERVER['REQUEST_URI'] ), "house_" ) !== false && isset( $object['property_type'] ) ) {
					$header = "HTTP/1.0 200 OK";
				}
			}
		}

		return $header;
	}

	/**
	 * Save Core Settings to Option
	 */
	public function save_settings() {
		if ( isset( $_POST['wpm_core'] ) ) {
			$tmp_data = (array) $_POST['wpm_core'];
			$data     = [];
			foreach ( $tmp_data as $tmp_key => $tmp_val ) {
				$data[ $tmp_key ] = sanitize_text_field( $tmp_val );
			}
			update_option( 'wpm_core', json_encode( $data ) );
		}
	}

	/**
	 * Load Saved Settings
	 */
	public function load_settings() {
		// Fallback Location
		$fallback_location = get_option( 'inspiry_properties_map_default_location', '27.664827,-81.515755' );
		if ( ! empty( $fallback_location ) ) {
			$lat_lng                                          = explode( ',', $fallback_location );
			$propertiesMapOptions['fallback_location']['lat'] = $lat_lng[0];
			$propertiesMapOptions['fallback_location']['lng'] = $lat_lng[1];
		}

		$this->settings             = json_decode( get_option( 'wpm_core' ), true );
		$this->propertiesMapOptions = $propertiesMapOptions;
	}

	/**
	 * Remove Map Scripts Before Create Map with Custom Properties
	 */
	public function remove_scripts_from_template() {
		wp_dequeue_script( 'properties-open-street-map' );
	}

	/**
	 * Include Scripts And Styles on Admin Pages
	 */
	public function admin_scripts_and_styles() {
		// Register styles
		wp_enqueue_style( 'wpm-core-selectstyle', plugins_url( 'templates/libs/selectstyle/selectstyle.css', __FILE__ ) );
		wp_enqueue_style( 'wpm-font-awesome', plugins_url( 'templates/libs/font-awesome/scripts/all.min.css', __FILE__ ) );
		wp_enqueue_style( 'wpm-core-tips', plugins_url( 'templates/libs/tips/tips.css', __FILE__ ) );
		wp_enqueue_style( 'wpm-core-select2', plugins_url( 'templates/libs/select2/select2.min.css', __FILE__ ) );
		wp_enqueue_style( 'wpm-core-lightzoom', plugins_url( 'templates/libs/lightzoom/style.css', __FILE__ ) );
		wp_enqueue_style( 'wpm-core-modal', plugins_url( 'templates/libs/jquery-modal/jquery.modal.min.css', __FILE__ ) );
		wp_enqueue_style( 'wpm-core-admin', plugins_url( 'templates/assets/css/admin.css', __FILE__ ) );

		// Register Scripts
		wp_enqueue_script( 'wpm-core-selectstyle', plugins_url( 'templates/libs/selectstyle/selectstyle.js', __FILE__ ) );
		wp_enqueue_script( 'wpm-font-awesome', plugins_url( 'templates/libs/font-awesome/scripts/all.min.js', __FILE__ ) );
		wp_enqueue_script( 'wpm-core-tips', plugins_url( 'templates/libs/tips/tips.js', __FILE__ ) );
		wp_enqueue_script( 'wpm-core-select2', plugins_url( 'templates/libs/select2/select2.min.js', __FILE__ ) );
		wp_enqueue_script( 'wpm-core-lightzoom', plugins_url( 'templates/libs/lightzoom/lightzoom.js', __FILE__ ) );
		wp_enqueue_script( 'wpm-core-modal', plugins_url( 'templates/libs/jquery-modal/jquery.modal.min.js', __FILE__ ) );
		wp_enqueue_script( 'wpm-core-admin', plugins_url( 'templates/assets/js/admin.js', __FILE__ ) );
		wp_register_script( 'wpm-core-ajax', plugins_url( 'templates/assets/js/ajax.js', __FILE__ ) );
		wp_localize_script( 'wpm-core-ajax', 'admin', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script( 'wpm-core-ajax' );
	}

	/**
	 * Include Scripts And Styles on FrontEnd
	 */
	public function include_scripts_and_styles() {
		// Register styles
		wp_enqueue_style( 'wpm-core', plugins_url( 'templates/assets/css/frontend.css', __FILE__ ), false, '1.0.0', 'all' );

		// Register scripts
		wp_register_script( 'wpm-core', plugins_url( 'templates/assets/js/frontend.js', __FILE__ ), array( 'jquery' ), '1.0.0', 'all' );
		wp_localize_script( 'wpm-core', 'admin', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script( 'wpm-core' );

		wp_register_script( 'map-properties', plugins_url( 'templates/assets/js/properties-open-street-map.js', __FILE__ ), array( 'jquery' ), '1.0.0', 'all' );
	}

	/**
	 * Add Settings to Admin Menu
	 */
	public function register_menu() {
		add_menu_page( 'OpenBrocker', 'OpenBrocker', 'edit_others_posts', 'wpm_core_settings' );
		add_submenu_page( 'wpm_core_settings', 'OpenBrocker', 'OpenBrocker', 'manage_options', 'wpm_core_settings', function () {
			global $wp_version, $wpdb;

			// Get Saved Settings
			$settings = $this->settings;

			include 'templates/admin/settings.php';
		} );
	}
}

new WPM_Core();