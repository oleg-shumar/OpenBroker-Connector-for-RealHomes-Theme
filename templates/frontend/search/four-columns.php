<section class="listing-layout property-grid property-grid-four-column">
    <div class="list-container inner-wrapper clearfix">
		<?php
		if ( isset( $objects_list['data'] ) && count( $objects_list['data'] ) > 0 ) :

			$counter = 1;
			foreach ( $objects_list['data'] as $object ) {
				// properties grid card.
				include( 'grid-card.php' );

				if ( $counter % 2 == 0 ) { ?>
                    <div class="clearfix rh-visible-xs"></div>
					<?php
				}

				if ( $counter % 3 == 0 ) { ?>
                    <div class="clearfix rh-visible-sm"></div>
					<?php
				}

				if ( $counter % 4 == 0 ) { ?>
                    <div class="clearfix rh-visible-md rh-visible-lg"></div>
					<?php
				}
				$counter ++;
			}

			wp_reset_postdata();
		else :
			?>
            <div class="alert-wrapper">
				<?php
				$inspiry_search_template_no_result_text = get_option( 'inspiry_search_template_no_result_text' );

				if ( ! empty( $inspiry_search_template_no_result_text ) ) {
					?>
                    <h4><?php echo inspiry_kses( $inspiry_search_template_no_result_text ); ?></h4>
					<?php
				} else {
					?>
                    <h4><?php esc_html_e( 'No Property Found!', 'framework' ); ?></h4>
					<?php
				}
				?>
            </div>
		<?php
		endif;
		?>
    </div>
</section>