<?php
/**
 * Properties for Homepage.
 *
 * @package    realhomes
 * @subpackage classic
 */

?>
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="main">
                <section id="home-properties-section" class="property-items <?php if ( 'true' == get_option( 'theme_ajax_pagination_home' ) ) {
					echo esc_html( 'ajax-pagination' );
				} ?>">
					<?php get_template_part( 'assets/classic/partials/home/sections/home-slogan' ); // Homepage Slogan?>
                    <div id="home-properties-section-wrapper">
                        <div id="home-properties-section-inner">
                            <div id="home-properties-wrapper">
                                <div id="home-properties" class="property-items-container clearfix">
									<?php
									/* Homepage Properties Loop */
									if ( isset( $objects_list['data'] ) && count( $objects_list['data'] ) > 0 ) :

										foreach ( $objects_list['data'] as $object ) {
											include 'property-card.php';
										}

									else:
										?>
                                        <div class="alert-wrapper">
                                            <h4><?php esc_html_e( 'No Properties Found!', 'framework' ) ?></h4>
                                        </div>
									<?php
									endif;
									?>
                                </div>
                                <!-- end of #home-properties -->
                            </div>
                            <!-- end of #home-properties-wrapper -->
                            <div class="svg-loader">
                                <img src="<?php echo esc_attr( INSPIRY_DIR_URI ); ?>/images/loading-bars.svg" width="32" height="32" alt="<?php esc_html_e( 'Loading...', 'framework' ); ?>">
                            </div>
							<?php
							if ( 'true' === get_option( 'theme_ajax_pagination_home' ) ) {
								theme_ajax_pagination( $objects_list['meta']['total_pages'] );
							} else {
								theme_pagination( $objects_list['meta']['total_pages'] );
							}
							?>
                        </div>
                        <!-- end of #home-properties-section-inner -->
                    </div>
                    <!-- end of #home-properties-section-wrapper -->
					<?php wp_reset_postdata(); ?>
                </section>
            </div>
            <!-- /.main -->
        </div>
        <!-- /.span12 -->
    </div>
    <!-- /.row -->
</div><!-- /.container -->