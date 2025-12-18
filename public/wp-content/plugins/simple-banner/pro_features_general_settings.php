<?php
/**
 * Pro general settings section
 * Settings that apply to all banners
 */

$is_pro_enabled = get_option('pro_version_enabled');
?>

<div class="sb-settings-section pro">
    <div class="sb-section-header">
        <h3>Pro Features - General Settings</h3>
        <?php if (!$is_pro_enabled): ?>
            <a class="button-primary" href="https://rpetersendev.gumroad.com/l/simple-banner" target="_blank">
                Purchase Pro License
            </a>
        <?php endif; ?>
    </div>
    
    <div class="sb-section-content">
        <table class="form-table">
            <!-- Permissions (Admin only) -->
            <?php if (in_array('administrator', (array) wp_get_current_user()->roles)): ?>
                <tr>
                    <th scope="row">
                        <label>User Permissions</label>
                        <div class="sb-field-description">Allow other user roles to edit Simple Banner (applies to all banners)</div>
                    </th>
                    <td>
                        <div id="simple_banner_pro_permissions">
                            <?php
                            $disabled = !$is_pro_enabled;
                            $permissions_array = get_option('permissions_array');
                            
                            foreach (get_editable_roles() as $role_name => $role_info) {
                                if ($role_name == 'administrator') continue;
                                
                                $checked = (!$disabled && in_array($role_name, explode(",", $permissions_array))) ? 'checked' : '';
                                echo '<label style="display: block; margin-bottom: 5px;">';
                                echo '<input type="checkbox" ' . ($disabled ? 'disabled ' : '') . $checked . ' value="' . $role_name . '"> ';
                                echo ucfirst($role_name);
                                echo '</label>';
                            }
                            ?>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>

            <!-- Debug Mode -->
            <tr>
                <th scope="row">
                    <label>Debug Mode</label>
                    <div class="sb-field-description">Log all variables in browser console (applies to all banners)</div>
                </th>
                <td>
                    <?php if ($is_pro_enabled): ?>
                        <label>
                            <input type="checkbox" name="simple_banner_debug_mode" 
                                   <?php echo is_checked(get_option('simple_banner_debug_mode')); ?>>
                            Enable debug mode
                        </label>
                    <?php else: ?>
                        <label>
                            <input type="checkbox" disabled> Enable debug mode (Pro feature)
                        </label>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        
        <!-- Hidden fields to preserve values -->
        <?php if ($is_pro_enabled): ?>
            <input type="hidden" id="permissions_array" name="permissions_array" 
                   value="<?php echo esc_attr(get_option('permissions_array')); ?>" />
        <?php endif; ?>
        
        <input type="hidden" id="pro_version_enabled" name="pro_version_enabled" 
               value="<?php echo esc_attr(get_option('pro_version_enabled')); ?>" />
        <input type="hidden" id="pro_version_activation_code" name="pro_version_activation_code" 
               value="<?php echo esc_attr(get_option('pro_version_activation_code')); ?>" />
    </div>
</div>