<?php
/**
 * Pro features section for individual banners
 * More concise layout with better organization
 */

$section_style = $banner_id === '' ? '' : 'display:none;';
$is_pro_enabled = get_option('pro_version_enabled');
?>

<div id="pro_section<?php echo $banner_id ?>" class="sb-settings-section pro simple-banner-settings-section" style="<?php echo $section_style ?>">
    <div class="sb-section-header">
        <h3>Banner #<?php echo $i ?> - Pro Features</h3>
        <?php if (!$is_pro_enabled): ?>
            <a class="button-primary" href="https://rpetersendev.gumroad.com/l/simple-banner" target="_blank">
                Purchase Pro License
            </a>
        <?php endif; ?>
    </div>
    
    <div class="sb-section-content">
        <!-- License Key Input -->
        <table class="form-table" style="<?php if (get_option('pro_version_enabled')) { echo 'display: none;'; } ?>">
            <tr>
                <th scope="row">
                    <label for="simple_banner_pro_license_key">License Key</label>
                </th>
                <td>
                    <input type="text" id="simple_banner_pro_license_key" 
                            name="simple_banner_pro_license_key" 
                            style="width: 400px; border: 2px solid #ffc107; border-radius: 5px;"
                            value="<?php echo esc_attr(get_option('simple_banner_pro_license_key')); ?>" />
                </td>
            </tr>
        </table>
        <hr  style="<?php if (get_option('pro_version_enabled')) { echo 'display: none;'; } ?>">

        <table class="form-table">
            <!-- Advanced Placement -->
            <tr>
                <th scope="row">
                    <label for="simple_banner_insert_inside_element<?php echo $banner_id ?>">Advanced Placement</label>
                    <div class="sb-field-description">Insert banner inside specific element (overrides basic placement)</div>
                </th>
                <td>
                    <?php if ($is_pro_enabled): ?>
                        <input type="text" id="simple_banner_insert_inside_element<?php echo $banner_id ?>" 
                               name="simple_banner_insert_inside_element<?php echo $banner_id ?>" 
                               placeholder="e.g. header, #main-navigation, .custom-class"
                               style="width: 400px;"
                               value="<?php echo esc_attr(get_option('simple_banner_insert_inside_element' . $banner_id)); ?>" />
                        <div class="sb-field-description">
                            Uses <code>document.querySelector()</code> - accepts CSS selectors
                        </div>
                    <?php else: ?>
                        <input type="text" style="width: 400px;" disabled placeholder="Pro feature - purchase license to enable" />
                    <?php endif; ?>
                </td>
            </tr>

            <!-- Date Controls -->
            <tr>
                <th scope="row">Date Controls</th>
                <td>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label for="simple_banner_start_after_date<?php echo $banner_id ?>">Start After Date</label>
                            <?php if ($is_pro_enabled): ?>
                                <input type="text" id="simple_banner_start_after_date<?php echo $banner_id ?>" 
                                       name="simple_banner_start_after_date<?php echo $banner_id ?>" 
                                       placeholder="e.g. <?php echo date("d M Y H:i:s T") ?>"
                                       style="width: 100%;"
                                       value="<?php echo esc_attr(get_option('simple_banner_start_after_date' . $banner_id)); ?>" />
                            <?php else: ?>
                                <input type="text" style="width: 100%;" disabled placeholder="Pro feature" />
                            <?php endif; ?>
                        </div>
                        
                        <div>
                            <label for="simple_banner_remove_after_date<?php echo $banner_id ?>">Remove After Date</label>
                            <?php if ($is_pro_enabled): ?>
                                <input type="text" id="simple_banner_remove_after_date<?php echo $banner_id ?>" 
                                       name="simple_banner_remove_after_date<?php echo $banner_id ?>" 
                                       placeholder="e.g. <?php echo date("d M Y H:i:s T") ?>"
                                       style="width: 100%;"
                                       value="<?php echo esc_attr(get_option('simple_banner_remove_after_date' . $banner_id)); ?>" />
                            <?php else: ?>
                                <input type="text" style="width: 100%;" disabled placeholder="Pro feature" />
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="sb-field-description">Use UTC time to avoid daylight savings issues</div>
                </td>
            </tr>

            <!-- Page Exclusions -->
            <tr>
                <th scope="row">Page Exclusions</th>
                <td>
                    <div style="margin-bottom: 15px;">
                        <label>
                            <?php if ($is_pro_enabled): ?>
                                <input type="checkbox" name="disabled_on_posts<?php echo $banner_id ?>" 
                                       <?php echo is_checked(get_option('disabled_on_posts' . $banner_id)); ?>>
                                Disable on all posts
                            <?php else: ?>
                                <input type="checkbox" disabled> Disable on all posts (Pro feature)
                            <?php endif; ?>
                        </label>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="simple_banner_disabled_page_paths<?php echo $banner_id ?>">Disable by Path</label>
                        <?php if ($is_pro_enabled): ?>
                            <input type="text" id="simple_banner_disabled_page_paths<?php echo $banner_id ?>" 
                                   name="simple_banner_disabled_page_paths<?php echo $banner_id ?>" 
                                   placeholder="e.g. /shop,/cart,/shop*,*shop*"
                                   style="width: 100%; margin-top: 5px;"
                                   value="<?php echo esc_attr(get_option('simple_banner_disabled_page_paths' . $banner_id)); ?>" />
                            <div class="sb-field-description">
                                Comma-separated paths. Use * for wildcards: <code>/shop*</code> (starts with), <code>*shop</code> (ends with), <code>*shop*</code> (contains)
                            </div>
                        <?php else: ?>
                            <input type="text" style="width: 100%; margin-top: 5px;" disabled placeholder="Pro feature" />
                        <?php endif; ?>
                    </div>
                    
                    <div>
                        <label>Disable on Specific Pages</label>
                        <div id="simple_banner_pro_disabled_pages<?php echo $banner_id ?>" style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; margin-top: 5px; background: #f9f9f9;">
                            <?php
                            $disabled = !$is_pro_enabled;
                            $disabled_pages_array = array_filter(explode(',', get_option('disabled_pages_array' . $banner_id)));
                            $frontpage_id = get_option('page_on_front') ?: 1;
                            
                            // Front page checkbox
                            $checked = (!$disabled && in_array($frontpage_id, $disabled_pages_array)) ? 'checked' : '';
                            echo '<label style="display: block; margin-bottom: 5px;">';
                            echo '<input type="checkbox" ' . ($disabled ? 'disabled ' : '') . $checked . ' value="' . $frontpage_id . '"> ';
                            echo '<strong>' . get_option('blogname') . '</strong> (Homepage)';
                            echo '</label>';

                            // Other pages
                            $pages = get_pages(array('exclude' => array($frontpage_id)));
                            foreach ($pages as $page) {
                                $checked = (!$disabled && in_array($page->ID, $disabled_pages_array)) ? 'checked' : '';
                                echo '<label style="display: block; margin-bottom: 5px;">';
                                echo '<input type="checkbox" ' . ($disabled ? 'disabled ' : '') . $checked . ' value="' . $page->ID . '"> ';
                                echo esc_html($page->post_title) . ' | <code>' . get_page_uri( $page->ID ) . '</code>';
                                echo '</label>';
                            }
                            ?>
                        </div>
                    </div>
                </td>
            </tr>

            <!-- Site-wide Custom Code -->
            <tr>
                <th scope="row">Site-wide Custom Code</th>
                <td>
                    <div style="margin-bottom: 20px;">
                        <label for="site_custom_css<?php echo $banner_id ?>">Website Custom CSS</label>
                        <?php if ($is_pro_enabled): ?>
                            <textarea id="site_custom_css<?php echo $banner_id ?>" 
                                      name="site_custom_css<?php echo $banner_id ?>" 
                                      class="sb-textarea-large code"><?php echo esc_textarea(get_option('site_custom_css' . $banner_id)); ?></textarea>
                            <label style="display: block; margin-top: 5px;">
                                <input type="checkbox" name="keep_site_custom_css<?php echo $banner_id ?>" 
                                       <?php echo is_checked(get_option('keep_site_custom_css' . $banner_id)); ?>>
                                Keep CSS when banner is hidden/disabled/closed
                            </label>
                        <?php else: ?>
                            <textarea class="sb-textarea-large" disabled placeholder="Pro feature - CSS applied to entire website"></textarea>
                        <?php endif; ?>
                    </div>
                    
                    <div>
                        <label for="site_custom_js<?php echo $banner_id ?>">Website Custom JavaScript</label>
                        <?php if ($is_pro_enabled): ?>
                            <textarea id="site_custom_js<?php echo $banner_id ?>" 
                                      name="site_custom_js<?php echo $banner_id ?>" 
                                      class="sb-textarea-large code"><?php echo esc_textarea(get_option('site_custom_js' . $banner_id)); ?></textarea>
                            <label style="display: block; margin-top: 5px;">
                                <input type="checkbox" name="keep_site_custom_js<?php echo $banner_id ?>" 
                                       <?php echo is_checked(get_option('keep_site_custom_js' . $banner_id)); ?>>
                                Keep JS when banner is hidden/disabled/closed
                            </label>
                        <?php else: ?>
                            <textarea class="sb-textarea-large" disabled placeholder="Pro feature - JavaScript applied to entire website"></textarea>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        </table>
        
        <?php if ($is_pro_enabled): ?>
            <input type="hidden" id="disabled_pages_array<?php echo $banner_id ?>" 
                   name="disabled_pages_array<?php echo $banner_id ?>" 
                   value="<?php echo esc_attr(get_option('disabled_pages_array' . $banner_id)); ?>" />
        <?php endif; ?>
    </div>
</div>