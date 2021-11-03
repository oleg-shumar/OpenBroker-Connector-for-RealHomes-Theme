<div class="span4 ">
    <article <?php post_class( 'property-item clearfix' ); ?>>
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
        <h4><a href="<?php echo esc_attr( get_home_url() . "/property/{$object['id']}" ) ?>"><?php echo esc_html( ucfirst( $object['property_type'] ) . " in " . $object['address']['city'] . ", " . $object['address']['province'] ) ?></a></h4>
        <p class="brief"><?php echo esc_attr( substr( $object['descriptions']['english'], 0, 100 ) ) ?></p>
        <div class="detail">
            <h5 class="price">
				<?php echo esc_html( '€' . number_format( $object['price'], 0, ",", "," ) ) ?>
            </h5>
        </div>
    </article>
</div>