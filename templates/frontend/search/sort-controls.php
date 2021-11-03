<?php
/**
 * Sort Controls
 *
 * Properties sort controls.
 *
 * @package    realhomes
 * @subpackage classic
 */
?>
<div class="sort-controls">
    <strong><?php esc_html_e( 'Sort By', 'framework' ); ?>:</strong> &nbsp;
	<?php $sort_by = inspiry_get_properties_sort_by_value(); ?>
    <select name="sort-properties" id="sort-properties" class="inspiry_select_picker_trigger">
        <option value="created_at_desc" <?php echo esc_attr( ( 'created_at_desc' == $sort_by ) ? 'selected' : '' ); ?>>Newest First</option>
        <option value="created_at_asc" <?php echo esc_attr( ( 'created_at_asc' == $sort_by ) ? 'selected' : '' ); ?>>Oldest First</option>
        <option value="price_asc" <?php echo esc_attr( ( 'price_asc' == $sort_by ) ? 'selected' : '' ); ?>>Price (Low - High)</option>
        <option value="price_desc" <?php echo esc_attr( ( 'price_desc' == $sort_by ) ? 'selected' : '' ); ?>>Price (High - Low)</option>
        <option value="price_square_asc" <?php echo esc_attr( ( 'price_square_asc' == $sort_by ) ? 'selected' : '' ); ?>>Price per m2 (Low - High)</option>
        <option value="price_square_desc" <?php echo esc_attr( ( 'price_square_desc' == $sort_by ) ? 'selected' : '' ); ?>>Price per m2 (High - Low)</option>
    </select>
</div>