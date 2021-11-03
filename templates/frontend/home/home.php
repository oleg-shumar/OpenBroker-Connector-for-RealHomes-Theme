<?php
/**
 * Homepage
 *
 * @package    realhomes
 * @subpackage classic
 */

get_header();

// Load Properties from API
$properties = new WPM_Core;
$properties->load_settings();
$objects_list = $properties->properties_type( 'home' );

/* Theme Home Page Module */
$theme_homepage_module = get_option( 'theme_homepage_module' );
$main_border_class     = '';

/* For demo purpose only */
if ( isset( $_GET['module'] ) ) {
	$theme_homepage_module = sanitize_text_field( $_GET['module'] );
}

switch ( $theme_homepage_module ) {
	case 'properties-slider':
		include( 'properties-slider.php' );
		break;

	case 'search-form-over-image':
		get_template_part( 'assets/classic/partials/home/slider/search-form-over-image' );
		break;

	case 'slides-slider':
		get_template_part( 'assets/classic/partials/home/slider/slides' );
		break;

	case 'properties-map':
		get_template_part( 'assets/classic/partials/banners/map' );
		break;

	case 'revolution-slider':
		$rev_slider_alias = trim( get_option( 'theme_rev_alias' ) );
		if ( function_exists( 'putRevSlider' ) && ( ! empty( $rev_slider_alias ) ) ) {
			putRevSlider( $rev_slider_alias );
		} else {
			get_template_part( 'assets/classic/partials/banners/default' );
		}
		break;
	case 'simple-banner':
		get_template_part( 'assets/classic/partials/banners/default' );
		$main_border_class = 'top-border';
		break;
}
?>
    <div class="main-wrapper contents">
		<?php
		/**
		 * Advance Search
		 */
		include( __DIR__ . '/templates/frontend/head-search/advance-search.php' );

		/**
		 * Get all the sections to be displayed on Homepage
		 */

		$sections                        = array();
		$sections['home-properties']     = get_option( 'theme_show_home_properties' );
		$sections['features-section']    = get_option( 'inspiry_show_features_section' );
		$sections['featured-properties'] = get_option( 'theme_show_featured_properties' );
		$sections['blog-posts']          = get_option( 'theme_show_news_posts' );

		// For demo purpose only.
		if ( isset( $_GET['show-features'] ) ) {
			$show_home_features = sanitize_text_field( $_GET['show-features'] );
		}

		/**
		 * Get the order in which sections are to be displayed
		 */

		$section_ordering = get_theme_mod( 'inspiry_home_sections_order_default', 'default' );

		if ( ! empty( $section_ordering ) && $section_ordering == 'default' ) {
			$home_sections = 'home-properties,features-section,featured-properties,blog-posts';
			$home_sections = explode( ',', $home_sections );
		} else {
			$home_sections = get_option( 'inspiry_home_sections_order' );
			$home_sections = ( ! empty( $home_sections ) ) ? $home_sections : 'home-properties,features-section,featured-properties,blog-posts';
			$home_sections = explode( ',', $home_sections );
		}
		/**
		 * Display sections according to their order
		 */
		if ( ! empty( $home_sections ) && is_array( $home_sections ) ) {
			foreach ( $home_sections as $home_section ) {
				if ( isset( $sections[ $home_section ] ) && 'true' === $sections[ $home_section ] ) {
					include 'home-properties.php';
				}
			}
		}
		?>
        <div id="amala">
            <div>
                <div>
                    <h2>
                        Lorem Ipsum passage </h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                </div>
                <div>
                    <a href="#">Find out more</a>
                </div>
            </div>
        </div>
        <div id="home-contact">
            <img src="https://almahomes.es/newsite/wp-content/uploads/2021/09/ALMA-Homes-logo.png" alt="">
            <h2>Contact Us</h2>
            <div class="container">
                <div class="home-form">
					<?php echo do_shortcode( '[contact-form-7 id="1234" title="Home Contact"]' ); ?>
                </div>
            </div>
        </div>
    </div><!-- /.main-wrapper -->
<?php get_footer(); ?>