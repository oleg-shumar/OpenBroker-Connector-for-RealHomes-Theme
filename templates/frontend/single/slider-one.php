<?php
/**
 * Slider for Property Detail Page.
 *
 * @package realhomes
 * @subpackage classic
 */

$size              = 'property-detail-slider-image-two';
$prop_detail_login = inspiry_prop_detail_login();

if ( isset( $object['pictures'] ) && count( $object['pictures'] ) > 0 && 'yes' != $prop_detail_login || is_user_logged_in() ) {
	?>
    <div id="property-detail-flexslider" class="inspiry_classic_portrait_common inspiry_classic_portrait_fit_slider clearfix">
        <div class="flexslider">
            <ul class="slides">
				<?php
				foreach ( $object['pictures'] as $image ) { ?>
                <li data-thumb="<?php echo esc_attr( $image['url'] ) ?>">
                    <a href="<?php echo esc_attr( $image['url'] ) ?>" data-fancybox="gallery-images" class=""> <img src="<?php echo esc_attr( $image['url'] ) ?>" alt=""/> </a>
                    </li><?php
				}
				?>
            </ul>
        </div>
    </div>
    <div id="property-featured-image" class="clearfix only-for-print">
        <img src="<?php echo esc_attr( $object['pictures'][0]['url'] ) ?>" alt=""/>
    </div>
	<?php
}