<?php
/**
 * Property detail slider two.
 *
 * @package    realhomes
 * @subpackage classic
 */

$size              = 'property-detail-slider-image-two';
$properties_images = rwmb_meta( 'REAL_HOMES_property_images', 'type=plupload_image&size=' . $size, get_the_ID() );
$prop_detail_login = inspiry_prop_detail_login();

if ( ! empty( $properties_images ) && ( 1 <= count( $properties_images ) ) && ( 'yes' != $prop_detail_login || is_user_logged_in() ) ) {
	?>
    <div id="property-slider-two-wrapper" class="inspiry_classic_portrait_common inspiry_classic_portrait_fit_slider_2 clearfix">
        <div id="property-slider-two" class="flexslider loading">
            <ul class="slides">
				<?php
				$title_in_lightbox = get_option( 'inspiry_display_title_in_lightbox' );
				foreach ( $properties_images as $prop_image_id => $prop_image_meta ) {
					?>
                    <li><?php
				if ( 'true' == $title_in_lightbox ) {
					?><a href="<?php echo esc_attr( $prop_image_meta['full_url'] ) ?>" data-fancybox="gallery-images" class="" title="<?php echo esc_attr( $prop_image_meta['title'] ) ?>"><?php
					} else {
					?><a href="<?php echo esc_attr( $prop_image_meta['full_url'] ) ?>" data-fancybox="gallery-images" class=""><?php
				}
					?><img src="<?php echo esc_attr( $prop_image_meta['url'] ) ?>" alt="<?php echo esc_attr( $prop_image_meta['title'] ) ?>" /><?php
					?></a><?php
					?></li><?php
				}
				?>
            </ul>
        </div>
        <div id="property-carousel-two" class="flexslider">
            <ul class="slides">
				<?php
				foreach ( $properties_images as $prop_image_id => $prop_image_meta ) {
					$slider_thumb = wp_get_attachment_image_src( $prop_image_id, 'property-thumb-image' );
					?>
                    <li>
                    <img src="<?php echo esc_attr( $slider_thumb[0] ) ?>"/>
                    </li><?php
				}
				?>
            </ul>
        </div>
    </div>
	<?php
	if ( has_post_thumbnail() ) {
		?>
        < id="property-featured-image" class="clearfix only-for-print">
		<?php
		$image_id  = get_post_thumbnail_id();
		$image_url = wp_get_attachment_url( $image_id );
		?><a href="<?php echo esc_attr( $image_url ) ?>" data-fancybox="gallery-images" class="">            <img src="<?php echo esc_attr( $image_url ) ?>"/>
        </a></div>
		<?php
	}
} elseif ( has_post_thumbnail() ) {
	?>
    <div id="property-featured-image" class="clearfix">
		<?php
		$image_id  = get_post_thumbnail_id();
		$image_url = wp_get_attachment_url( $image_id );
		?><a href="' . $image_url . '" data-fancybox="gallery-images" class=""> <img src="<?php echo esc_attr( $image_url ) ?>"/> </a><?php
		?>
    </div>
	<?php
}