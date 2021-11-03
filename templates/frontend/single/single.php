<?php
/**
 * Property detail page.
 *
 * @package    realhomes
 * @subpackage classic
 */

function object_title() {
	global $page_name;

	return $page_name;
}

add_action( 'pre_get_document_title', 'object_title' );

get_header();

// Banner Image.
$banner_image_id = isset( $object['pictures'][0]['url'] ) ? $object['pictures'][0]['url'] : null;
if ( $banner_image_id ) {
	$banner_image_path = $object['pictures'][0]['url'];
} else {
	$banner_image_path = get_default_banner();
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
	?>
    <div class="page-head" style="background-image: url('<?php echo esc_attr( $banner_image_path ); ?>');">
		<?php if ( ! ( 'true' == get_option( 'theme_banner_titles' ) ) ) : ?>
            <div class="container">
                <div class="wrap clearfix">
                    <h1 class="page-title"><span><?php echo esc_html( ucfirst( $object['property_type'] ) . " in " . $object['address']['city'] ) ?></span></h1>
					<?php
					$display_property_breadcrumbs = get_option( 'theme_display_property_breadcrumbs' );
					if ( 'true' == $display_property_breadcrumbs ) {
						include( 'breadcrumbs.php' );
					}
					?>
                </div>
            </div>
		<?php endif; ?>
    </div><!-- End Page Head -->
	<?php
	$order_settings = get_theme_mod( 'inspiry_property_sections_order_default', 'default' );
	?>
    <div class="container contents detail property-section-order-<?php echo esc_attr( $order_settings ); ?>">
		<?php
		// Display any contents after the page banner and before the contents.
		do_action( 'inspiry_before_page_contents' );
		?>
        <div class="row">
            <div class="span9 main-wrap">
                <div class="main">
                    <div id="overview">
						<?php
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							if ( ! post_password_required() ) {
								include( 'slider.php' );
								include( 'content.php' );
							} else {
								echo wp_kses( get_the_password_form(), [ 'form', 'input', 'b', 'i', 'span', 'div', 'a', 'button', 'img' ] );
							}
						endwhile;
						endif;
						?>
                    </div>
                </div><!-- End Main Content -->
				<?php
				include( 'similar-properties.php' );
				?>
            </div><!-- End span9 -->
            <div class="span3 sidebar-wrap">
                <aside class="sidebar">
                    <section id="advance_search_widget-4" class="widget advance-search clearfix Advance_Search_Widget"><h4 class="title search-heading">Find Your Home<i class="fas fa-search"></i></h4>
						<?php include( __DIR__ . '/templates/frontend/head-search/form-wrapper.php' ); ?>
                    </section>
                </aside>
            </div>
        </div><!-- End contents row -->
    </div><!-- End Content -->
	<?php
}
get_footer();
?>