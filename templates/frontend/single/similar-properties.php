<?php
/**
 * Similar Properties
 *
 * @package    realhomes
 * @subpackage classic
 */
if ( 'true' === get_option( 'theme_display_similar_properties', 'true' ) ) {
	if ( isset( $objects_similar['data'] ) && count( $objects_similar['data'] ) > 0 ) :
		?>
        <section class="listing-layout property-grid">
            <div class="list-container clearfix">
				<?php
				$similar_properties_title = get_option( 'theme_similar_properties_title' );
				if ( ! empty( $similar_properties_title ) ) :
					?><h3><?php echo esc_html( $similar_properties_title ); ?></h3><?php
				endif;

				// Similar properties filters markup.
				realhomes_similar_properties_filters( 'classic' );
				?>
                <div id="similar-properties">
					<?php
					$exlude_id = $object['id'];
					$added     = 0;
					foreach ( $objects_similar['data'] as $object ) {
						if ( $object['id'] != $exlude_id ) {
							include( 'similar-property-card.php' );

							$added ++;
							if ( $added == 3 ) {
								break;
							}
						}
					}
					wp_reset_postdata();
					?>
                </div>
            </div>
        </section>
	<?php
	endif;
}