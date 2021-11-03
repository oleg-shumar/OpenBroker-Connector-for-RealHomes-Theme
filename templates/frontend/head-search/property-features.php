<?php
/**
 * Property Features Checkboxes
 */

/* all property features terms */
//$all_features = get_terms(array( 'taxonomy' => 'property-feature' ));

$all_features   = [];
$all_features[] = [ 'slug' => 'has_parking', 'name' => 'Parking' ];
$all_features[] = [ 'slug' => 'has_ac', 'name' => 'A/C & Heating' ];
$all_features[] = [ 'slug' => 'has_pool', 'name' => 'Pool' ];
$all_features[] = [ 'slug' => 'has_security', 'name' => 'Security' ];
$all_features[] = [ 'slug' => 'has_balcony', 'name' => 'Balcony' ];
$all_features[] = [ 'slug' => 'is_furnished', 'name' => 'Furnished' ];
$all_features[] = [ 'slug' => 'has_elevator', 'name' => 'Elevator' ];
$all_features[] = [ 'slug' => 'has_garden', 'name' => 'Garden' ];
$all_features[] = [ 'slug' => 'has_fireplace', 'name' => 'Fireplace' ];
$all_features[] = [ 'slug' => 'exclusive', 'name' => 'Exclusive' ];

if ( ! empty( $all_features ) && ! is_wp_error( $all_features ) ) {
	/* features in search query */
	$required_features_slugs = array();
	if ( isset( $_GET['features'] ) ) {
		$required_features_slugs = (array) $_GET['features'];
	}

	$features_count = count( $all_features );
	if ( $features_count > 0 ) {
		?>
        <div class="clearfix"></div>
        <div class="more-option-trigger">
            <a href="#"> <i class="far <?php echo esc_attr( ( count( $required_features_slugs ) > 0 ) ? 'fa-minus-square' : 'fa-plus-square' ); ?>"></i>
				<?php
				$inspiry_search_features_title = get_option( 'inspiry_search_features_title' );
				if ( $inspiry_search_features_title ) {
					echo esc_html( $inspiry_search_features_title );
				} else {
					esc_html_e( 'Looking for certain features', 'framework' );
				}
				?>
            </a>
        </div>
        <div class="more-options-wrapper clearfix" style="display: none">
			<?php

			foreach ( $all_features as $feature ) {
				?>
                <div class="option-bar">
                    <input type="checkbox" id="feature-<?php echo esc_attr( rawurldecode( $feature['slug'] ) ); ?>" name="features[]" value="<?php echo esc_attr( rawurldecode( $feature['slug'] ) ); ?>"
						<?php if ( in_array( rawurldecode( $feature['slug'] ), $required_features_slugs ) ) {
							echo esc_attr( 'checked' );
						} ?> /> <label for="feature-<?php echo esc_attr( rawurldecode( $feature['slug'] ) ); ?>"><?php echo esc_html( ucwords( $feature['name'] ) ); ?></label>
                </div>
				<?php
			} ?>
        </div>
		<?php
	}
}