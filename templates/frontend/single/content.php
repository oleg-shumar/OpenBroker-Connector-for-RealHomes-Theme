<?php
/**
 * Single Property Contents
 *
 * @package    realhomes
 * @subpackage classic
 */

?>
<article class="property-item clearfix">
    <div class="outer-wrapper clearfix">
		<?php inspiry_property_qr_code(); ?>
        <div class="wrap clearfix">
			<?php
			$address_display = get_option( 'inspiry_display_property_address', 'true' );
			if ( 'true' === $address_display ) {
				?>
                <address class="title">
					<?php echo esc_html( $object['address']['address_name'] ) ?>
                </address>
				<?php
			}

			$status_terms = get_the_terms( get_the_ID(), 'property-status' );
			$type_terms   = get_the_terms( get_the_ID(), "property-type" );

			$property_price = null;
			if ( function_exists( 'ere_get_property_price' ) ) {
				$property_price = ere_get_property_price( get_the_ID(), true );
			}

			if ( ! empty( $status_terms ) || ! empty( $property_price ) || ( $type_terms ) ) {
				?>
                <h5 class="price">
					<?php
					if ( ! empty( $status_terms ) ) {
						$margin_left_none = '';
						if ( empty( $property_price ) && ! ( $type_terms ) ) {
							$margin_left_none = 'margin-right-0';
						}
						?>
                        <span class="status-label <?php echo esc_attr( $margin_left_none ); ?>">
				            <i class="tag-arrow"><?php inspiry_safe_include_svg( '/images/arrow.svg' ); ?></i>
						    <?php
						    /* Property Status. For example: For Sale, For Rent */
						    $status_count = 0;
						    foreach ( $status_terms as $term ) {
							    if ( $status_count > 0 ) {
								    echo esc_html( ', ' );
							    }
							    echo esc_html( $term->name );
							    $status_count ++;
						    } ?>
				        </span>
						<?php
					}

					if ( ! empty( $property_price ) || ( $type_terms ) ) {
						?>
                        <span class="price-and-type">
                            <i class="tag-arrow"><?php inspiry_safe_include_svg( '/images/arrow.svg' ); ?></i>
                            <?php echo esc_html( '€' . number_format( $object['price'], 0, ",", "," ) ) ?>
                        </span>
						<?php
					}
					?>
                </h5>
				<?php
			}
			?>
        </div>
    </div>
	<?php
	$prop_detail_login = inspiry_prop_detail_login();

	if ( 'yes' != $prop_detail_login || is_user_logged_in() ) {
		?>
        <div class="property-meta clearfix">
			<?php
			// Property meta.
			include( 'metas.php' );
			?>
        </div>
		<?php
	}
	?>
    <div class="content clearfix">
		<?php
		// Display the login form if login is required and user is not logged in
		if ( 'yes' == $prop_detail_login && ! is_user_logged_in() ) {
			?>
            <div class="login-register forms-simple rh_property_detail_login">
                <div class="row-fluid">
                    <div class="span6">
						<?php get_template_part( 'assets/classic/partials/page/forms/login-form' ); ?>
                    </div>
                    <div class="span6">
						<?php get_template_part( 'assets/classic/partials/page/forms/register-form' ); ?>
                    </div>
                </div>
            </div>
			<?php
		} else {
			// Contents from WordPress editor.
			echo esc_html( $object['descriptions']['english'] );

			// Property additional details from meta boxes.
			//include('additional-details.php');

			// Common note from theme options.
			get_template_part( 'assets/classic/partials/property/single/common-note' );
		}

		?>
    </div>
	<?php

	if ( 'yes' != $prop_detail_login || is_user_logged_in() ) {
		include( 'features.php' );
	}
	?>
</article>