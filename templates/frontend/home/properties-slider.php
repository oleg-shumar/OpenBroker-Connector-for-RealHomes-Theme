<?php
/**
 * Properties Slider
 *
 * @package    realhomes
 * @subpackage classic
 */

$number_of_slides = intval( get_post_meta( get_the_ID(), 'theme_number_of_slides', true ) );
if ( ! $number_of_slides ) {
	$number_of_slides = - 1;
}

if ( isset( $objects_list['data'] ) && count( $objects_list['data'] ) > 0 ) { ?>
    <!-- Slider -->
    <div id="home-flexslider" class="clearfix">
        <div class="flexslider loading">
            <ul class="slides">
				<?php
				foreach ( $objects_list['data'] as $object ) {
					if ( isset( $object['pictures'][0]['url'] ) ) {
						?>
                        <li>
                            <div class="desc-wrap">
                                <div class="slide-description">
                                    <h3><a href="<?php echo esc_attr( get_home_url() . "/property/{$object['id']}" ) ?>">
											<?php echo esc_html( ucfirst( $object['property_type'] ) . " in " . $object['address']['city'] . ", " . $object['address']['province'] ) ?></a></h3>
                                    <p><?php echo esc_html( substr( $object['descriptions']['english'], 0, 100 ) ) ?></p>
									<?php
									if ( $object['price'] ) {
										?><span><?php echo esc_html( '<span>' . '€' . number_format( $object['price'], 0, ",", "," ) ); ?></span><?php
									}

									$button_label = get_option( 'inspiry_string_know_more', esc_html__( 'Know More', 'framework' ) );
									?>
                                    <a href="<?php echo esc_attr( get_home_url() . "/property/{$object['id']}" ) ?>" class="know-more"><?php echo esc_html( $button_label ) ?></a>
                                </div>
                            </div>
                            <a href="<?php echo esc_attr( get_home_url() . "/property/{$object['id']}" ) ?>"> <img src="<?php echo esc_attr( $object['pictures'][0]['url'] ); ?>" alt="<?php echo esc_attr( ucfirst( $object['property_type'] ) . " in " . $object['address']['province'] . ", " . $object['address']['city'] ) ?>"></a>
                        </li>
						<?php
					}
				}

				?>
            </ul>
        </div>
    </div><!-- End Slider -->
	<?php
} else {
	get_template_part( 'assets/classic/partials/banners/default' );
}