<?php
/* Property Features */

$security = array_keys( array_filter( $object['security'] ) );
$setting  = array_keys( array_filter( $object['setting'] ) );
$feature  = array_keys( array_filter( $object['feature'] ) );
$view     = array_keys( array_filter( $object['view'] ) );

if ( ! empty( $security ) || ! empty( $setting ) || ! empty( $feature ) || ! empty( $view ) ) {
	?>
    <div class="features">
		<?php
		$property_features_title = get_option( 'theme_property_features_title' );
		if ( ! empty( $property_features_title ) ) {
			?><h4 class="title"><?php echo esc_html( $property_features_title ); ?></h4><?php
		}
		$property_features_display = get_option( 'inspiry_property_features_display', 'link' );
		?>
        <ul class="arrow-bullet-list clearfix">
			<?php
			$already_added = [];

			// Security Features
			foreach ( $security as $value ) {
				$already_added[] = $value;
				?>
                <li id="rh_property__feature_' .$value. '"><span><?php echo esc_html( ucfirst( str_replace( '_', ' ', $value ) ) ?></span></li><?php
			}

			// Settings Features
			foreach ( $setting as $value ) {
				if ( ! in_array( $value, $already_added ) ) {
					$already_added[] = $value;
					?>
                    <li id="rh_property__feature_' .$value. '"><span><?php echo esc_html( ucfirst( str_replace( '_', ' ', $value ) ) ?></span></li><?php
				}
			}

			// Other Features
			foreach ( $feature as $value ) {
				if ( ! in_array( $value, $already_added ) ) {
					$already_added[] = $value;
					?>
                    <li id="rh_property__feature_' .$value. '"><span><?php echo esc_html( ucfirst( str_replace( '_', ' ', $value ) ) ?></span></li><?php
				}
			}

			// View Features
			foreach ( $feature as $value ) {
				if ( ! in_array( $value, $already_added ) ) {
					$already_added[] = $value;
					?>
                    <li id="rh_property__feature_' .$value. '"><span><?php echo esc_html( ucfirst( str_replace( '_', ' ', $value ) ) ?></span></li><?php
				}
			}
			?>
        </ul>
    </div>
	<?php
}

if ( inspiry_is_rvr_enabled() ) {
	// RVR - outdoor features
	get_template_part( 'assets/classic/partials/property/single/rvr/outdoor-features' );

	// RVR - optional services
	get_template_part( 'assets/classic/partials/property/single/rvr/optional-services' );

	// RVR - property policies
	get_template_part( 'assets/classic/partials/property/single/rvr/property-policies' );

	// RVR - location surroundings
	get_template_part( 'assets/classic/partials/property/single/rvr/location-surroundings' );
}