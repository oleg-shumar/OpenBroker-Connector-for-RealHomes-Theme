<?php
/**
 * Location Fields
 */

$location_select_count  = inspiry_get_locations_number(); // number of locations chosen from theme options
$location_select_names  = inspiry_get_location_select_names(); // Variable that contains location select boxes names
$location_select_titles = inspiry_get_location_titles(); // Default location select boxes titles
$location_placeholder   = inspiry_location_placeholder(); // Placeholder text for the location fields
$select_class           = 'inspiry_select_picker_trigger'; // Default class for the location dropdown fields
$is_location_ajax       = get_option( 'inspiry_ajax_location_field', 'no' ); // Option to check if location field Ajax is enabled
$multiselect_locations  = get_option( 'inspiry_search_form_multiselect_locations', 'yes' );
$parent_class = '';
if ( 'yes' === $is_location_ajax ) {
	$parent_class = ' inspiry_ajax_location_wrapper ';
	$select_class = ' inspiry_ajax_location_field inspiry_select_picker_trigger';
}

// Generate required location select boxes
for ( $i = 0; $i < $location_select_count; $i ++ ) {
	?>
    <div class="<?php echo esc_attr( $parent_class ) ?>  option-bar rh_classic_location_field rh-search-field small rh_classic_search__select rh_location_prop_search_<?php echo esc_attr( $i ) ?>" data-get-location-placeholder="<?php echo esc_attr( $location_placeholder[ $i ] ); ?>">
        <label for="<?php echo esc_attr( $location_select_names[ $i ] ); ?>">
			<?php echo esc_html( $location_select_titles[ $i ] ); ?>
        </label>
        <span class="selectwrap" id="find-city">
                        <?php
                        if ( 'yes' === $is_location_ajax ) {
	                        ?>
                            <span class="rh-location-ajax-loader"><?php inspiry_safe_include_svg( '/images/loader.svg' ); ?></span>
                        <?php } ?>
            <select id="<?php echo esc_attr( $location_select_names[ $i ] ); ?>"
                    class="inspiry_multi_select_picker_location <?php echo esc_attr( $select_class ); ?> show-tick"
                    data-none-selected-text="<?php esc_attr_e('Any','framework')?>"
                    data-none-results-text="<?php esc_attr_e('No results matched','framework') ?>{0}"
                    data-live-search="true"

                    <?php
	            if ( 'yes' == $multiselect_locations && $location_select_count <= 1 ) {
		            ?>
                    name="location"
                    data-max-options="1"
                    multiple="multiple"
                    title="<?php
		            $loc_placeholder = get_option( 'inspiry_location_placeholder_1' );
		            if ( ! empty( $loc_placeholder ) ) {
			            echo esc_attr( $loc_placeholder );
		            } else {
			            esc_attr_e( 'All Locations', 'framework' );
		            } ?>"

                    data-count-selected-text="{0} <?php
		            $loc_counter_placeholder = get_option( 'inspiry_location_count_placeholder_1' );
		            if ( ! empty( $loc_counter_placeholder ) ) {
			            echo esc_attr( $loc_counter_placeholder );
		            } else {
			            esc_attr_e( ' Locations Selected ', 'framework' );
		            }
		            ?>"

		            <?php
	            } elseif ( 'no' == $multiselect_locations && 'yes' === $is_location_ajax ) {
		            ?>
                    name="location"
                    data-max-options="1"
                    multiple="multiple"
                    title="<?php
		            $loc_placeholder = get_option( 'inspiry_location_placeholder_1' );
		            if ( ! empty( $loc_placeholder ) ) {
			            echo esc_attr( $loc_placeholder );
		            } else {
			            esc_attr_e( 'All Locations', 'framework' );
		            } ?>"
		            <?php
	            } else {
		            ?>
                    name="<?php echo esc_attr( $location_select_names[ $i ] ); ?>"

		            <?php
	            }
	            ?>
            >
	            <option value="93" <?php if(isset($_GET['location']) && $_GET['location'] == "93") {echo esc_attr( 'selected' );} ?>>Benahavis</option>
                <option value="32" <?php if(isset($_GET['location']) && $_GET['location'] == "32") {echo esc_attr( 'selected' );} ?>>Estepona</option>
                <option value="58" <?php if(isset($_GET['location']) && $_GET['location'] == "58") {echo esc_attr( 'selected' );} ?>>Cancelada, Estepona</option>
                <option value="79" <?php if(isset($_GET['location']) && $_GET['location'] == "79") {echo esc_attr( 'selected' );} ?>>Costalita, Estepona</option>
                <option value="160" <?php if(isset($_GET['location']) && $_GET['location'] == "160") {echo esc_attr( 'selected' );} ?>>The Golden Mile, Estepona</option>
                <option value="134" <?php if(isset($_GET['location']) && $_GET['location'] == "134") {echo esc_attr( 'selected' );} ?>>La Quinta</option>
                <option value="15" <?php if(isset($_GET['location']) && $_GET['location'] == "15") {echo esc_attr( 'selected' );} ?>>Marbella</option>
                <option value="48" <?php if(isset($_GET['location']) && $_GET['location'] == "48") {echo esc_attr( 'selected' );} ?>>Cabopino, Marbella</option>
                <option value="78" <?php if(isset($_GET['location']) && $_GET['location'] == "78") {echo esc_attr( 'selected' );} ?>>El Rosario, Marbella</option>
                <option value="645" <?php if(isset($_GET['location']) && $_GET['location'] == "645") {echo esc_attr( 'selected' );} ?>>Elviria, Marbella</option>
                <option value="160" <?php if(isset($_GET['location']) && $_GET['location'] == "160") {echo esc_attr( 'selected' );} ?>>Golden Mile, Marbella</option>
                <option value="115" <?php if(isset($_GET['location']) && $_GET['location'] == "115") {echo esc_attr( 'selected' );} ?>>Istan, Marbella</option>
                <option value="134" <?php if(isset($_GET['location']) && $_GET['location'] == "134") {echo esc_attr( 'selected' );} ?>>La Quinta, Marbella</option>
                <option value="802" <?php if(isset($_GET['location']) && $_GET['location'] == "802") {echo esc_attr( 'selected' );} ?>>Nagüeles, Marbella</option>
                <option value="16" <?php if(isset($_GET['location']) && $_GET['location'] == "16") {echo esc_attr( 'selected' );} ?>>Nueva Andalucia, Marbella</option>
                <option value="1038" <?php if(isset($_GET['location']) && $_GET['location'] == "1038") {echo esc_attr( 'selected' );} ?>>San Pedro de Alcántara, Marbella</option>
                <option value="162" <?php if(isset($_GET['location']) && $_GET['location'] == "162") {echo esc_attr( 'selected' );} ?>>New Golden Mile</option>
            </select>
        </span>
    </div>
	<?php
}

// important action hook - related JS works based on it
//do_action( 'after_location_fields' );