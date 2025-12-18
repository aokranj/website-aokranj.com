<?php
/**
 * Banner preview component
 * Simplified and cleaner preview
 */

$section_style = $banner_id === '' ? '' : 'display:none;';
?>

<div id="preview_banner_outer_container<?php echo $banner_id ?>" 
     class="sb-preview-container simple-banner-settings-section" 
     style="<?php echo $section_style ?>">
    
    <div class="sb-preview-header">
        <h4>Banner #<?php echo $i ?> Preview</h4>
    </div>
    
    <div id="preview_banner_inner_container<?php echo $banner_id ?>" class="sb-preview-wrapper">
        <div id="preview_banner<?php echo $banner_id ?>" class="simple-banner<?php echo $banner_id ?> sb-preview-banner">
            <div id="preview_banner_text<?php echo $banner_id ?>" class="simple-banner-text<?php echo $banner_id ?> sb-preview-text">
                <span>This is what your banner will look like with a <a href="/">link</a>.</span>
            </div>
        </div>
    </div>
</div>