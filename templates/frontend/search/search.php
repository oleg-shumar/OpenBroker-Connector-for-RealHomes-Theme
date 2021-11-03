<?php
/**
 * Properties Search Page
 *
 * @since 2.7.0
 * @package RH/classic
 */

get_header();

// Load Properties from API
$properties = new WPM_Core;
$properties->load_settings();
$objects_list = $properties->properties_type( 'search' );

/* Theme Home Page Module */
$theme_search_module = get_option( 'theme_search_module' );

switch ( $theme_search_module ) {
	case 'properties-map':
		get_template_part( 'assets/classic/partials/banners/map' );
		break;

	default:
		get_template_part( 'assets/classic/partials/banners/default' );
		break;
}
?>
<!-- Content -->
<div class="container contents">
	<?php
	// Display any contents after the page banner and before the contents.
	do_action( 'inspiry_before_page_contents' );
	?>
    <div class="row">
        <div class="span12">
            <!-- Main Content -->
            <div class="main">
				<?php
				/* Advance Search Form */
				include( __DIR__ . '/templates/frontend/head-search/form-wrapper.php' );
				?>
                <section class="property-items">
                    <div class="search-header inner-wrapper clearfix">
                        <div class="properties-count">
							<span><strong><?php if ( isset( $objects_list['meta']['total_items'] ) ) {
										echo esc_html( $objects_list['meta']['total_items'] );
									} ?></strong>&nbsp;
								<?php
								if ( isset( $objects_list['meta']['total_items'] ) && 1 < $objects_list['meta']['total_items'] ) {
									esc_html_e( 'Results', 'framework' );
								} else {
									esc_html_e( 'Result', 'framework' );
								}
								?>
							</span>
                        </div>
                        <div class="multi-control-wrap">
							<?php
							// Sort controls.
							include( 'sort-controls.php' );
							?>
                        </div>
						<?php
						$get_content_position = get_post_meta( get_the_ID(), 'REAL_HOMES_content_area_above_footer', true );
						if ( $get_content_position !== '1' ) {
							if ( have_posts() ) {
								while ( have_posts() ) {
									the_post();
									$rh_content_is_empty = '';
									if ( ! get_the_content() ) {
										$rh_content_is_empty = 'rh_content_is_empty';
									}
									?>
                                    <article id="post-<?php the_ID(); ?>" <?php post_class( $rh_content_is_empty ); ?>>
										<?php the_content(); ?>
                                    </article>
									<?php
								}
							}
						}
						?>
                    </div>
					<?php
					include( 'four-columns.php' );
					?>

					<?php if ( isset( $objects_list['meta']['total_pages'] ) ) {
						theme_pagination( $objects_list['meta']['total_pages'] );
					} ?>
                </section>
            </div><!-- End Main Content -->
			<?php
			if ( '1' === $get_content_position ) {
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php the_content(); ?>
                        </article>
						<?php
					}
				}
			}
			?>
        </div> <!-- End span12 -->
    </div><!-- End  row -->
</div><!-- End content -->
<?php get_footer(); ?>