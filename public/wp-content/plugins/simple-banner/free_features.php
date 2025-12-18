<?php
/**
 * Free features section for individual banners
 * More concise and organized layout
 */

$section_style = $banner_id === '' ? '' : 'display:none;';
?>

<div id="free_section<?php echo $banner_id ?>" class="sb-settings-section simple-banner-settings-section" style="<?php echo $section_style ?>">
    <div class="sb-section-header">
        <h3>Banner #<?php echo $i ?> Settings</h3>
    </div>
    
    <div class="sb-section-content">
        <table class="form-table">
            <!-- Banner Text -->
            <tr>
                <th scope="row">
                    <label for="simple_banner_text<?php echo $banner_id ?>">Banner Text</label>
                    <div class="sb-field-description">Leave blank to hide banner</div>
                </th>
                <td>
                    <textarea id="simple_banner_text<?php echo $banner_id ?>" 
                              name="simple_banner_text<?php echo $banner_id ?>" 
                              class="sb-textarea-large large-text code"><?php echo esc_textarea(get_option('simple_banner_text' . $banner_id)); ?></textarea>
                </td>
            </tr>

            <!-- Visibility Controls -->
            <tr>
                <th scope="row">Banner Visibility</th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">Banner Visibility</legend>
                        <label>
                            <input type="radio" name="hide_simple_banner<?php echo $banner_id ?>" value="no" 
                                   <?php echo is_checked(get_option('hide_simple_banner' . $banner_id) === 'no'); ?>>
                            Show Banner
                        </label>
                        <label>
                            <input type="radio" name="hide_simple_banner<?php echo $banner_id ?>" value="yes" 
                                   <?php echo is_checked(get_option('hide_simple_banner' . $banner_id) === 'yes'); ?>>
                            Hide Banner
                        </label>
                    </fieldset>
                    <div class="sb-field-description">Hiding applies <code>display: none;</code> to the banner</div>
                </td>
            </tr>

            <!-- Colors -->
            <tr>
                <th scope="row">Colors</th>
                <td>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label>Background Color</label>
                            <div class="sb-color-input-group">
                                <input type="text" id="simple_banner_color<?php echo $banner_id ?>" 
                                       name="simple_banner_color<?php echo $banner_id ?>" 
                                       placeholder="e.g. #024985"
                                       value="<?php echo esc_attr(get_option('simple_banner_color' . $banner_id)); ?>" />
                                <input type="color" id="simple_banner_color_show<?php echo $banner_id ?>" 
                                       class="sb-color-picker"
                                       value="<?php echo get_option('simple_banner_color' . $banner_id) ?: '#024985'; ?>">
                            </div>
                        </div>
                        
                        <div>
                            <label>Text Color</label>
                            <div class="sb-color-input-group">
                                <input type="text" id="simple_banner_text_color<?php echo $banner_id ?>" 
                                       name="simple_banner_text_color<?php echo $banner_id ?>" 
                                       placeholder="e.g. #ffffff"
                                       value="<?php echo esc_attr(get_option('simple_banner_text_color' . $banner_id)); ?>" />
                                <input type="color" id="simple_banner_text_color_show<?php echo $banner_id ?>" 
                                       class="sb-color-picker"
                                       value="<?php echo get_option('simple_banner_text_color' . $banner_id) ?: '#ffffff'; ?>">
                            </div>
                        </div>
                        
                        <div>
                            <label>Link Color</label>
                            <div class="sb-color-input-group">
                                <input type="text" id="simple_banner_link_color<?php echo $banner_id ?>" 
                                       name="simple_banner_link_color<?php echo $banner_id ?>" 
                                       placeholder="e.g. #f16521"
                                       value="<?php echo esc_attr(get_option('simple_banner_link_color' . $banner_id)); ?>" />
                                <input type="color" id="simple_banner_link_color_show<?php echo $banner_id ?>" 
                                       class="sb-color-picker"
                                       value="<?php echo get_option('simple_banner_link_color' . $banner_id) ?: '#f16521'; ?>">
                            </div>
                        </div>
                        
                        <div>
                            <label>Close Button Color</label>
                            <div class="sb-color-input-group">
                                <input type="text" id="simple_banner_close_color<?php echo $banner_id ?>" 
                                       name="simple_banner_close_color<?php echo $banner_id ?>" 
                                       placeholder="e.g. black"
                                       value="<?php echo esc_attr(get_option('simple_banner_close_color' . $banner_id)); ?>" />
                                <input type="color" id="simple_banner_close_color_show<?php echo $banner_id ?>" 
                                       class="sb-color-picker"
                                       value="<?php echo get_option('simple_banner_close_color' . $banner_id) ?: '#000000'; ?>">
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            <!-- Layout & Positioning -->
            <tr>
                <th scope="row">Layout & Positioning</th>
                <td>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label for="simple_banner_font_size<?php echo $banner_id ?>">Font Size</label>
                            <input type="text" id="simple_banner_font_size<?php echo $banner_id ?>" 
                                   name="simple_banner_font_size<?php echo $banner_id ?>" 
                                   placeholder="e.g. 16px"
                                   value="<?php echo esc_attr(get_option('simple_banner_font_size' . $banner_id)); ?>" />
                        </div>
                        
                        <div>
                            <label for="simple_banner_z_index<?php echo $banner_id ?>">Z-Index</label>
                            <input type="number" id="simple_banner_z_index<?php echo $banner_id ?>" 
                                   name="simple_banner_z_index<?php echo $banner_id ?>" 
                                   placeholder="e.g. 99999"
                                   value="<?php echo esc_attr(get_option('simple_banner_z_index' . $banner_id)); ?>" />
                        </div>
                    </div>
                    
                    <div style="margin-top: 15px;">
                        <span>Position</span>
                        <fieldset style="margin-top: 5px;">
                            <?php
                            $positions = array(
                                'relative' => 'Relative (default)',
                                'static' => 'Static',
                                'absolute' => 'Absolute',
                                'fixed' => 'Fixed',
                                'sticky' => 'Sticky',
                                'footer' => 'Footer (fixed bottom)'
                            );
                            
                            foreach ($positions as $value => $label) {
                                $checked = get_option('simple_banner_position' . $banner_id) == $value ? 'checked' : '';
                                echo '<label>';
                                echo '<input type="radio" name="simple_banner_position' . $banner_id . '" value="' . $value . '" ' . $checked . '> ';
                                echo $label;
                                echo '</label>';
                            }
                            ?>
                        </fieldset>
                    </div>
                </td>
            </tr>

            <!-- Close Button -->
            <tr>
                <th scope="row">Close Button</th>
                <td>
                    <label>
                        <input type="checkbox" id="close_button_enabled<?php echo $banner_id ?>" 
                               name="close_button_enabled<?php echo $banner_id ?>" 
                               <?php echo is_checked(get_option('close_button_enabled' . $banner_id)); ?>>
                        Enable close button
                    </label>
                    <div class="sb-field-description">Uses strictly necessary cookies (GDPR compliant)</div>
                    
                    <div style="margin-top: 10px;">
                        <label for="close_button_expiration<?php echo $banner_id ?>">Expiration (days or date)</label>
                        <input type="text" id="close_button_expiration<?php echo $banner_id ?>" 
                               name="close_button_expiration<?php echo $banner_id ?>" 
                               placeholder="e.g. 14 or <?php echo date("d M Y H:i:s T") ?>"
                               style="width: 300px;"
                               value="<?php echo esc_attr(get_option('close_button_expiration' . $banner_id)); ?>" />
                        <div class="sb-field-description">Days (e.g. 14), fractions (e.g. 0.5), or exact date/time</div>
                    </div>
                </td>
            </tr>

            <!-- Placement -->
            <tr>
                <th scope="row">Placement</th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">Banner Placement</legend>
                        <label>
                            <input type="radio" name="simple_banner_prepend_element<?php echo $banner_id ?>" value="body" 
                                   <?php echo is_checked(get_option('simple_banner_prepend_element' . $banner_id) === 'body'); ?>>
                            Insert at top of <code>&lt;body&gt;</code>
                        </label>
                        <label>
                            <input type="radio" name="simple_banner_prepend_element<?php echo $banner_id ?>" value="header" 
                                   <?php echo is_checked(get_option('simple_banner_prepend_element' . $banner_id) === 'header'); ?>>
                            Insert at top of <code>&lt;header&gt;</code>
                        </label>
                    </fieldset>
                    
                    <?php if ($i === 1): ?>
                        <div style="margin-top: 15px;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div>
                                    <label for="header_margin">Header Top Margin</label>
                                    <input type="text" id="header_margin" name="header_margin" 
                                           placeholder="e.g. 40px"
                                           value="<?php echo esc_attr(get_option('header_margin')); ?>" />
                                    <div class="sb-field-description">Disabled if banner is hidden/closed</div>
                                </div>
                                
                                <div>
                                    <label for="header_padding">Header Top Padding</label>
                                    <input type="text" id="header_padding" name="header_padding" 
                                           placeholder="e.g. 40px"
                                           value="<?php echo esc_attr(get_option('header_padding')); ?>" />
                                    <div class="sb-field-description">Disabled if banner is hidden/closed</div>
                                </div>
                            </div>
                        </div>
                        
                        <?php if (function_exists('wp_body_open')): ?>
                            <div style="margin-top: 15px;">
                                <label>
                                    <input type="checkbox" id="wp_body_open_enabled" name="wp_body_open_enabled" <?php echo is_checked(get_option('wp_body_open_enabled')) ?> >
                                    Use wp_body_open hook
                                </label>
                                <div class="sb-field-description">Can eliminate Cumulative Layout Shift issues</div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="sb-field-description">Header margin/padding only available on Banner #1</div>
                    <?php endif; ?>
                </td>
            </tr>

            <!-- Custom CSS -->
            <tr>
                <th scope="row">
                    Custom CSS
                    <div class="sb-field-description">
                        <strong style="color: #d63384;">Warning:</strong> Bad CSS can break the banner
                    </div>
                </th>
                <td>
                    <div class="sb-css-grid">
                        <div class="sb-css-section">
                            <div class="sb-css-label">.simple-banner<?php echo $banner_id ?> {</div>
                            <textarea id="simple_banner_custom_css<?php echo $banner_id ?>" 
                                      name="simple_banner_custom_css<?php echo $banner_id ?>" 
                                      class="sb-css-textarea code"><?php echo esc_textarea(get_option('simple_banner_custom_css' . $banner_id)); ?></textarea>
                            <div>}</div>
                        </div>
                        
                        <div class="sb-css-section">
                            <div class="sb-css-label">.simple-banner-text<?php echo $banner_id ?> {</div>
                            <textarea id="simple_banner_text_custom_css<?php echo $banner_id ?>" 
                                      name="simple_banner_text_custom_css<?php echo $banner_id ?>" 
                                      class="sb-css-textarea code"><?php echo esc_textarea(get_option('simple_banner_text_custom_css' . $banner_id)); ?></textarea>
                            <div>}</div>
                        </div>
                        
                        <div class="sb-css-section">
                            <div class="sb-css-label">.simple-banner-button<?php echo $banner_id ?> {</div>
                            <textarea id="simple_banner_button_css<?php echo $banner_id ?>" 
                                      name="simple_banner_button_css<?php echo $banner_id ?>" 
                                      class="sb-css-textarea code"><?php echo esc_textarea(get_option('simple_banner_button_css' . $banner_id)); ?></textarea>
                            <div>}</div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 15px;">
                        <div class="sb-css-label">.simple-banner-scrolling<?php echo $banner_id ?> {</div>
                        <textarea id="simple_banner_scrolling_custom_css<?php echo $banner_id ?>" 
                                  name="simple_banner_scrolling_custom_css<?php echo $banner_id ?>" 
                                  class="sb-css-textarea code" 
                                  style="width: 100%;"><?php echo esc_textarea(get_option('simple_banner_scrolling_custom_css' . $banner_id)); ?></textarea>
                        <div>}</div>
                        <div class="sb-field-description">CSS applied when page is scrolled</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>