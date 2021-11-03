<?php
/**
 * Property Card for Grid Layout.
 *
 * @package    realhomes
 * @subpackage classic
 */

global $post;
?>
<article class="property-item clearfix">
    <figure>
        <a href="<?php echo esc_attr( get_home_url() . "/property/{$object['id']}" ) ?>">
			<?php
			if ( isset( $object['pictures'][0]['url'] ) ) {
				$image = $object['pictures'][0]['url']; ?>
                <img src="<?php echo esc_attr( $image ) ?>"><?php
			} else {
				inspiry_image_placeholder( 'property-thumb-image' );
			}
			?>
        </a>
		<?php if ( $object['exclusive'] != '' ) {
			?>
            <figcaption class="exclusive">Exclusive</figcaption><?php
		} ?>
    </figure>
    <h4><a href="<?php echo esc_attr( get_home_url() . "/property/{$object['id']}" ) ?>">
			<?php echo esc_html( ucfirst( $object['property_type'] ) . " in " . $object['address']['city'] . ", " . $object['address']['province'] ) ?></a></h4>
    <p><?php echo esc_html( substr( $object['descriptions']['english'], 0, 100 ) ) ?>
        <a class="more-details" href="<?php echo esc_attr( get_home_url() . "/property/{$object['id']}" ) ?>">
			<?php esc_html_e( 'More Details ', 'framework' ); ?>
            <i class="fas fa-caret-right"></i></a></p>
	<?php

	/*
	 * Property Price.
	 */
	if ( function_exists( 'ere_get_property_price' ) ) : ?>
        <span><?php echo esc_html( '€' . number_format( $object['price'], 0, ",", "," ) ) ?></span>
	<?php
	endif;

	inspiry_add_to_compare_button(); // Display add to compare button.
	?>
</article>