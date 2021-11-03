<div id="settings-panel">
    <div class="section-company">
        <div class="left-side">
            <ul>
                <li><a class="change-table active" data-table="general-settings-table"><i class="fas fa-tools"></i> <?php echo esc_html__( 'General Setting', 'wpm-core' ) ?></a></li>
                <li><a class="change-table" data-table="collections-table"><i class="fas fa-sitemap"></i> <?php echo esc_html__( 'Collections', 'wpm-core' ) ?></a></li>
                <li><a class="change-table" data-table="shortcodes-table"><i class="fas fa-code"></i> <?php echo esc_html__( 'Shortcodes', 'wpm-core' ) ?></a></li>
                <li><a class="change-table" data-table="instructions-table"><i class="fas fa-question-circle"></i> <?php echo esc_html__( 'Instructions', 'wpm-core' ) ?></a></li>
                <li><a class="change-table" data-table="system-info-table"><i class="fas fa-shield-alt"></i> <?php echo esc_html__( 'System Info', 'wpm-core' ) ?></a></li>
                <li><a class="support-item" href="https://wp-masters.com" target="_blank"><i class="fas fa-life-ring"></i> <?php echo esc_html__( 'Plugin Support', 'wpm-core' ) ?></a></li>
            </ul>
        </div>
        <div class="right-side">
            <a href="https://wp-masters.com" target="_blank"><img src="<?php echo esc_attr( OPENBROKER_RH_PLUGIN_PATH . '/templates/assets/img/logo.png' ) ?>" alt=""></a>
        </div>
    </div>
    <div class="select-table" id="general-settings-table">
        <form action="" method="post">
            <div class="section_data">
                <div class="title"><?php echo esc_html__( 'API Authorization', 'wpm-core' ) ?></div>
                <div class="head_items">
                    <div class="item-table"><?php echo esc_html__( 'API URL:', 'wpm-core' ) ?> <a href="#" data-tooltip="<?php echo esc_attr__( 'API URL on the OpenBroker', 'wpm-core' ) ?>" class="help-icon clicktips"><i class="fas fa-question-circle"></i></a></div>
                    <div class="item-table"><?php echo esc_html__( 'App ID:', 'wpm-core' ) ?> <a href="#" data-tooltip="<?php echo esc_attr__( 'App ID on the OpenBroker', 'wpm-core' ) ?>" class="help-icon clicktips"><i class="fas fa-question-circle"></i></a></div>
                    <div class="item-table"><?php echo esc_html__( 'API Key:', 'wpm-core' ) ?> <a href="#" data-tooltip="<?php echo esc_attr__( 'API Key on the OpenBroker', 'wpm-core' ) ?>" class="help-icon clicktips"><i class="fas fa-question-circle"></i></a></div>
                </div>
                <div class="items-list">
                    <div class="item-content">
                        <div class="item-table"><input type="text" name="wpm_core[api_url]" value="<?php if ( isset( $settings['api_url'] ) ) {
								echo esc_attr( $settings['api_url'] );
							} ?>"></div>
                        <div class="item-table"><input type="text" name="wpm_core[app_id]" value="<?php if ( isset( $settings['app_id'] ) ) {
								echo esc_attr( $settings['app_id'] );
							} ?>"></div>
                        <div class="item-table"><input type="text" name="wpm_core[api_key]" value="<?php if ( isset( $settings['api_key'] ) ) {
								echo esc_attr( $settings['api_key'] );
							} ?>"></div>
                    </div>
                </div>
            </div>
            <div class="section_data">
                <div class="title"><?php echo esc_html__( 'Transaction Types', 'wpm-core' ) ?> <a href="#" data-tooltip="<?php echo esc_attr__( 'Which Type of Objects will be Shown by Default', 'wpm-core' ) ?>" class="help-icon clicktips"><i class="fas fa-question-circle"></i></a></div>
                <div class="items-list">
                    <div class="radio-group">
                        <input type="radio" name="wpm_core[transaction_type]" id="transaction_type_1" value="all" checked> <label for="transaction_type_1"><?php echo esc_attr__( 'All', 'wpm-core' ) ?></label> <input type="radio" name="wpm_core[transaction_type]" id="transaction_type_2" value="rent"> <label for="transaction_type_2"><?php echo esc_html__( 'Rent', 'wpm-core' ) ?></label> <input type="radio" name="wpm_core[transaction_type]" id="transaction_type_3" value="sale"> <label for="transaction_type_3"><?php echo esc_html__( 'Sale', 'wpm-core' ) ?></label>
                    </div>
                </div>
            </div>
            <div class="section_data">
                <div class="title"><?php echo esc_html__( 'Colors and Fonts', 'wpm-core' ) ?> <a href="#" data-tooltip="<?php echo esc_attr__( 'Which Type of Objects will be Shown by Default', 'wpm-core' ) ?>" class="help-icon clicktips"><i class="fas fa-question-circle"></i></a></div>
                <div class="items-list">
                    <div class="color-item">
                        <input type="color" id="head" name="head" value="#e66465"> <label for="head">Head</label>
                    </div>
                    <div class="color-item">
                        <input type="color" id="head" name="head" value="#e66465"> <label for="head">Head</label>
                    </div>
                </div>
            </div>
            <button class="button button-primary button-large" id="save-settings" type="submit"><?php echo esc_html__( 'Save settings', 'wpm-core' ) ?></button>
        </form>
    </div>
    <div class="select-table" id="collections-table" style="display: none">
        <div class="section_data">
            <div class="alert-help">
                <i class="fas fa-question-circle"></i> <?php echo esc_html__( 'On this page you can see a list of objects divided into categories by type, see their number, and also make a preview.', 'wpm-core' ) ?>
            </div>
            <div class="collections-table">
                <div class="collections-filters">
                    <div class="collections-features-select">Properties Filter</div>
                    <div class="collections-options">
                        <div class="col-option">
                            <label for="transaction_type">Sale/Rent</label> <select name="transaction_type" id="transaction_type">
                                <option value="for_rent">For Rent</option>
                                <option selected="selected" value="for_sale">For Sale</option>
                            </select>
                        </div>
                        <div class="col-option">
                            <label for="property_type">Property Type</label> <select name="property_type" id="property_type">
                                <option selected="selected" value="all">All</option>
                                <option value="house">House</option>
                                <option value="apartment">Apartment</option>
                                <option value="plot">Plot</option>
                                <option value="commercial">Commercial</option>
                            </select>
                        </div>
                        <div class="col-option">
                            <label for="beds">Bedrooms</label> <select name="beds" id="beds">
                                <option selected="selected" value="any">Any</option>
                                <option value="1">1+</option>
                                <option value="2">2+</option>
                                <option value="3">3+</option>
                                <option value="4">4+</option>
                                <option value="5">5+</option>
                                <option value="6">6+</option>
                                <option value="7">7+</option>
                                <option value="8">8+</option>
                                <option value="9">9+</option>
                                <option value="10">10+</option>
                            </select>
                        </div>
                        <div class="col-option">
                            <label for="baths">Bathrooms</label> <select name="baths" id="baths">
                                <option selected="selected" value="any">Any</option>
                                <option value="1">1+</option>
                                <option value="2">2+</option>
                                <option value="3">3+</option>
                                <option value="4">4+</option>
                                <option value="5">5+</option>
                                <option value="6">6+</option>
                                <option value="7">7+</option>
                                <option value="8">8+</option>
                                <option value="9">9+</option>
                                <option value="10">10+</option>
                            </select>
                        </div>
                        <div class="col-option">
                            <label for="min_price">Price Min</label> <input placeholder="Min" type="text" name="min_price" id="min_price">
                        </div>
                        <div class="col-option">
                            <label for="max_price">Price Max</label> <input placeholder="Max" type="text" name="max_price" id="max_price">
                        </div>
                        <div class="col-option">
                            <label for="min_built_area">Built Area</label> <input placeholder="Min (m2)" type="text" name="min_built_area" id="min_built_area">
                        </div>
                        <div class="col-option">
                            <label for="min_plot_size">Plot Size</label> <input placeholder="Min (m2)" type="text" name="min_plot_size" id="min_plot_size">
                        </div>
                    </div>
                    <div class="collections-features-tabs">
                        <div class="collections-features-title">Additional Features:</div>
                        <div class="collection-tab-content">
                            <ul class="ks-cboxtags">
                                <li><input type="checkbox" id="feature-exclusive" value="exclusive"><label for="feature-exclusive">Exclusive</label></li>
                                <li><input type="checkbox" id="feature-has_parking" value="has_parking"><label for="feature-has_parking">Parking</label></li>
                                <li><input type="checkbox" id="feature-has_ac" value="has_ac"><label for="feature-has_ac">A/C & Heating</label></li>
                                <li><input type="checkbox" id="feature-has_pool" value="has_pool"><label for="feature-has_pool">Pool</label></li>
                                <li><input type="checkbox" id="feature-has_balcony" value="has_balcony"><label for="feature-has_balcony">Balcony</label></li>
                                <li><input type="checkbox" id="feature-is_furnished" value="is_furnished"><label for="feature-is_furnished">Furnished</label></li>
                                <li><input type="checkbox" id="feature-has_elevator" value="has_elevator"><label for="feature-has_elevator">Elevator</label></li>
                                <li><input type="checkbox" id="feature-has_garden" value="has_garden"><label for="feature-has_garden">Garden</label></li>
                                <li><input type="checkbox" id="feature-has_fireplace" value="has_fireplace"><label for="feature-has_fireplace">Fireplace</label></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="button button-primary button-large button-submiter" type="button"><i class="fas fa-search"></i> Search Properties</button>
    </div>
    <div class="select-table" id="shortcodes-table" style="display: none">
        <div class="section_data">
            <div class="alert-help">
                <i class="fas fa-question-circle"></i> <?php echo esc_html__( 'On this page, you can copy the shortcode that will display objects inside the post anywhere in the middle of the page text (POST), or in any required place in the template (PHP).', 'wpm-core' ) ?>
            </div>
            <div class="title"><?php echo esc_html__( 'Available Shortcodes', 'wpm-core' ) ?></div>
            <div class="shortcodes-row">
                <div class="shortcode-item">
                    <div class="short-image"><a href="<?php echo esc_attr( OPENBROKER_RH_PLUGIN_PATH . '/templates/assets/img/shortcodes/shortcode-images.jpg' ) ?>" class="lightzoom"> <img src="<?php echo esc_attr( OPENBROKER_RH_PLUGIN_PATH . '/templates/assets/img/shortcodes/shortcode-images.jpg' ) ?>" alt=""></a></div>
                    <div class="short-details">
                        <div class="short-title">Properties without pagination</div>
                        <div class="short-description">Show Properties with selected options without pagination and filters. Best for Main page or include as Post Text</div>
                        <div class="short-code-title">Shortcodes:</div>
                        <div class="short-code">In POST: <code>[openbroker template='only_properties']</code></div>
                        <div class="short-code">In PHP: <code>echo do_shortcode("[openbroker template='only_properties']");</code></div>
                    </div>
                </div>
                <div class="shortcode-item">
                    <div class="short-image"><a href="<?php echo esc_attr( OPENBROKER_RH_PLUGIN_PATH . '/templates/assets/img/shortcodes/shortcode-images.jpg' ) ?>" class="lightzoom"> <img src="<?php echo esc_attr( OPENBROKER_RH_PLUGIN_PATH . '/templates/assets/img/shortcodes/shortcode-images.jpg' ) ?>" alt=""></a></div>
                    <div class="short-details">
                        <div class="short-title">Properties without pagination</div>
                        <div class="short-description">Show Properties with selected options without pagination and filters. Best for Main page or include as Post Text</div>
                        <div class="short-code-title">Shortcodes:</div>
                        <div class="short-code">In POST: <code>[openbroker template='only_properties']</code></div>
                        <div class="short-code">In PHP: <code>echo do_shortcode("[openbroker template='only_properties']");</code></div>
                    </div>
                </div>
                <div class="shortcode-item">
                    <div class="short-image"><a href="<?php echo esc_attr( OPENBROKER_RH_PLUGIN_PATH . '/templates/assets/img/shortcodes/shortcode-images.jpg' ) ?>" class="lightzoom"> <img src="<?php echo esc_attr( OPENBROKER_RH_PLUGIN_PATH . '/templates/assets/img/shortcodes/shortcode-images.jpg' ) ?>" alt=""></a></div>
                    <div class="short-details">
                        <div class="short-title">Properties without pagination</div>
                        <div class="short-description">Show Properties with selected options without pagination and filters. Best for Main page or include as Post Text</div>
                        <div class="short-code-title">Shortcodes:</div>
                        <div class="short-code">In POST: <code>[openbroker template='only_properties']</code></div>
                        <div class="short-code">In PHP: <code>ec ho do_shortcode("[openbroker template='only_properties']");</code></div>
                    </div>
                </div>
                <div class="shortcode-item">
                    <div class="short-image"><a href="<?php echo esc_attr(OPENBROKER_RH_PLUGIN_PATH . '/templates/assets/img/shortcodes/shortcode-images.jpg') ?>" class="lightzoom">
                            <img src="<?php echo esc_attr(OPENBROKER_RH_PLUGIN_PATH . '/templates/assets/img/shortcodes/shortcode-images.jpg') ?>" alt=""></a></div>
                    <div class="short-details">
                        <div class="short-title">Properties without pagination</div>
                        <div class="short-description">Show Properties with selected options without pagination and filters. Best for Main page or include as Post Text</div>
                        <div class="short-code-title">Shortcodes:</div>
                        <div class="short-code">In POST: <code>[openbroker template='only_properties']</code></div>
                        <div class="short-code">In PHP: <code>echo do_shortcode("[openbroker template='only_properties']");</code></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="gen-shortcode" class="modal">
            <div class="modal-title"><?php echo esc_html__( 'Create your Shortcode', 'wpm-core' ) ?></div>
            <div class="modal-content">
                <div id="gen-short">
                    <div class="gen-item">
                        <label for="template">Shortcode Template</label> <select name="template" id="template">
                            <option value="only_properties">Only Properties</option>
                            <option value="full_catalog">Properties with Pagination and Search</option>
                            <option value="single_property">Single Property</option>
                        </select>
                    </div>
                    <div class="gen-item">
                        <label for="property_type">Properties Type</label> <select name="type" id="property_type">
                            <option value="">All</option>
                            <option value="house">House</option>
                            <option value="apartment">Apartment</option>
                            <option value="plot">Plot</option>
                            <option value="commercial">Commercial</option>
                        </select>
                    </div>
                    <div class="gen-item">
                        <label for="sort_by">Sort By</label> <select name="sort-properties" id="sort_by">
                            <option value="">Default</option>
                            <option value="created_at_desc">Newest First</option>
                            <option value="created_at_asc">Oldest First</option>
                            <option value="price_asc">Price (Low - High)</option>
                            <option value="price_desc">Price (High - Low)</option>
                            <option value="selling_commission_price_desc">Commission Sell (Hi-Lo)</option>
                            <option value="selling_commission_price_asc">Commission Sell (Lo-Hi)</option>
                            <option value="buying_commission_price_asc">Commission Buy (Lo-Hi)</option>
                            <option value="buying_commission_price_desc">Commission Buy (Hi-Lo)</option>
                            <option value="price_square_asc">Price per m2 (Low - High)</option>
                            <option value="price_square_desc">Price per m2 (High - Low)</option>
                        </select>
                    </div>
                    <div class="gen-item">
                        <label for="per_page">Count Properties</label> <input type="number" id="per_page" placeholder="Default">
                    </div>
                    <div class="gen-item">
                        <label for="beds">Beds Count</label> <input type="number" id="beds" placeholder="All">
                    </div>
                    <div class="gen-item">
                        <label for="baths">Baths Count</label> <input type="number" id="baths" placeholder="All">
                    </div>
                    <div class="gen-item">
                        <label for="min_price">Min Price</label> <input type="number" id="min_price" placeholder="All">
                    </div>
                    <div class="gen-item">
                        <label for="max_price">Max Price</label> <input type="number" id="max_price" placeholder="All">
                    </div>
                    <div class="gen-item">
                        <label for="min_built_area">Min Area (Sq Ft)</label> <input type="number" id="min_built_area" placeholder="All">
                    </div>
                    <div class="gen-item">
                        <label for="max_built_area">Max Area (Sq Ft)</label> <input type="number" id="max_built_area" placeholder="All">
                    </div>
                </div>
                <div class="gen-item">
                    <label for="search_city">Location City/State (ID)</label> <input type="text" id="search_city" placeholder="All">
                    <div id="auto-city"></div>
                </div>
                <div class="gen-item" style="display: none;">
                    <input type="hidden" id="search_area_id">
                </div>
                <div class="modal-short-title">Features</div>
                <ul class="ks-cboxtags">
                    <li><input type="checkbox" id="feature-has_parking" value="has_parking"><label for="feature-has_parking">Parking</label></li>
                    <li><input type="checkbox" id="feature-has_ac" value="has_ac"><label for="feature-has_ac">A/C & Heating</label></li>
                    <li><input type="checkbox" id="feature-has_pool" value="has_pool"><label for="feature-has_pool">Pool</label></li>
                    <li><input type="checkbox" id="feature-has_balcony" value="has_balcony"><label for="feature-has_balcony">Balcony</label></li>
                    <li><input type="checkbox" id="feature-is_furnished" value="is_furnished"><label for="feature-is_furnished">Furnished</label></li>
                    <li><input type="checkbox" id="feature-has_elevator" value="has_elevator"><label for="feature-has_elevator">Elevator</label></li>
                    <li><input type="checkbox" id="feature-has_garden" value="has_garden"><label for="feature-has_garden">Garden</label></li>
                    <li><input type="checkbox" id="feature-has_fireplace" value="has_fireplace"><label for="feature-has_fireplace">Fireplace</label></li>
                    <li><input type="checkbox" id="feature-exclusive" value="exclusive"><label for="feature-exclusive">Exclusive</label></li>
                </ul>
                <div class="modal-short-title">Result Shortcodes</div>
                <div class="shortcode-results">
                    <div class="short-res">POST: <code id="post-result">[openbroker template='only_properties']</code></div>
                    <div class="short-res">PHP: <code id="post-result">echo do_shortcode("<span id="for-php-code">[openbroker template='only_properties']</span>");</code></div>
                </div>
            </div>
        </div>
        <a class="button button-primary button-large" href="#gen-shortcode" rel="modal:open" id="generate-shortcode" type="button"><i class="fas fa-sliders-h"></i> Generate Custom Shortcode</a>
    </div>
    <div class="select-table" id="instructions-table" style="display: none">
        <div class="section_data">
            <div class="title">How Use Shortcodes</div>
            <p>If you select the display mode only after the add to cart button, you should take into account that the shortcodes added to the pages earlier will also work. If you enable the "Only shortcode" mode, then the script will not be displayed under the "Add to cart" button, but only in places where the shortcode is added.</p>
            <p>There are 2 methods for calling the shortcode. The first is for insertion in the description of the product text, and the second is anywhere in the product page template.</p>
            <p><b>Using shortcode in description:</b></p>
            <p><code>[seedtrace]</code> or <code>[seedtrace product-id="test"]</code></p>
            <p><b>Using shortcode in theme template (PHP):</b></p>
            <p><code>do_shortcode("[seedtrace]")</code> or <code>do_shortcode('[seedtrace product-id="test"]')</code></p>
            <p><b>product-id</b> - is ID from API Product which will be shown</p>
        </div>
    </div>
    <div class="select-table" id="system-info-table" style="display: none">
        <div class="section_data">
            <div class="alert-help">
                <i class="fas fa-question-circle"></i> <?php echo esc_html__( 'The following is a system report containing useful technical information for troubleshooting issues. If you need further help after viewing the report, do the screenshots of this page and send it to our Support.', 'wpm-core' ) ?>
            </div>
            <table class="status-table" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th colspan="2"><?php echo esc_html__( 'WordPress', 'wpm-core' ) ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo esc_html__( 'Home URL', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( get_home_url() ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Site URL', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( get_site_url() ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'REST API Base URL', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( rest_url() ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'WordPress Version', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( $wp_version ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'WordPress Memory Limit', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( WP_MEMORY_LIMIT ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'WordPress Debug Mode', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( WP_DEBUG ? 'Yes' : 'No' ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'WordPress Debug Log', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( WP_DEBUG_LOG ? __( 'Yes', 'wpm-core' ) : __( 'No', 'wpm-core' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'WordPress Script Debug Mode', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( SCRIPT_DEBUG ? __( 'Yes', 'wpm-core' ) : __( 'No', 'wpm-core' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'WordPress Cron', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ? __( 'Yes', 'wpm-core' ) : __( 'No', 'wpm-core' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'WordPress Alternate Cron', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( defined( 'ALTERNATE_WP_CRON' ) && ALTERNATE_WP_CRON ? __( 'Yes', 'wpm-core' ) : __( 'No', 'wpm-core' ) ) ?></td>
                </tr>
                </tbody>
            </table>
            <table class="status-table" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th colspan="2"><?php echo esc_html__( 'Web Server', 'wpm-core' ) ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo esc_html__( 'Software', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Port', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( $_SERVER['SERVER_PORT'] ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Document Root', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( $_SERVER['DOCUMENT_ROOT'] ) ?></td>
                </tr>
                </tbody>
            </table>
            <table class="status-table" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th colspan="2"><?php echo esc_html__( 'PHP', 'wpm-core' ) ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo esc_html__( 'Version', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( phpversion() ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Memory Limit (memory_limit)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( ini_get( 'memory_limit' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Maximum Execution Time (max_execution_time)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( ini_get( 'max_execution_time' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Maximum File Upload Size (upload_max_filesize)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( ini_get( 'upload_max_filesize' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Maximum File Uploads (max_file_uploads)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( ini_get( 'max_file_uploads' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Maximum Post Size (post_max_size)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( ini_get( 'post_max_size' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Maximum Input Variables (max_input_vars)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( ini_get( 'max_input_vars' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'cURL Enabled', 'wpm-core' ) ?></td>
                    <td><?php $curl = curl_version();
						if ( isset( $curl['version'] ) ) {
							echo esc_html( "Yes (version $curl[version])" );
						} else {
							echo esc_html( "No" );
						} ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Mcrypt Enabled', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( function_exists( 'mcrypt_encrypt' ) ? 'Yes' : 'No' ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Mbstring Enabled', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( function_exists( 'mb_strlen' ) ? 'Yes' : 'No' ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Loaded Extensions', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( implode( ', ', get_loaded_extensions() ) ) ?></td>
                </tr>
                </tbody>
            </table>
            <table class="status-table" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th colspan="2"><?php echo esc_html__( 'Database Server', 'wpm-core' ) ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo esc_html__( 'Database Character Set', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( $wpdb->get_var( 'SELECT @@character_set_database' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Database Collation', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( $wpdb->get_var( 'SELECT @@collation_database' ) ) ?></td>
                </tr>
                </tbody>
            </table>
            <table class="status-table" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th colspan="2"><?php echo esc_html__( 'Date and Time', 'wpm-core' ) ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo esc_html__( 'WordPress (Local) Timezone', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( get_option( 'timezone_string' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'MySQL (UTC)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( $wpdb->get_var( 'SELECT utc_timestamp()' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'MySQL (Local)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( date( "F j, Y, g:i a", strtotime( $wpdb->get_var( 'SELECT utc_timestamp()' ) ) ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'PHP (UTC)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( date( 'Y-m-d H:i:s' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'PHP (Local)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( date( "F j, Y, g:i a" ) ) ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>