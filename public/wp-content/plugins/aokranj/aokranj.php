<?php
/**
 * Plugin Name: AO Kranj
 *
 * Description: AO Kranj Wordpress plugin.
 * Version: 1.1
 * Author: Bojan Hribernik
 * Author URI: http://climbuddy.com/
 * @package aokranj
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * AO Kranj wordpress plugin metadata
 */
define('AOKRANJ_PLUGIN_VERSION', '1.1.20220316');
define('AOKRANJ_PLUGIN_URL', WP_PLUGIN_URL.'/aokranj');
define('AOKRANJ_PLUGIN_DIR', WP_PLUGIN_DIR.'/aokranj');

/**
 * Load (optional) configuration file
 */
if (file_exists(__DIR__.'/config.php')) require_once __DIR__.'/config.php';

/**
 * Fix up missing configuration bits with the defaults
 */
if (!defined('AOKRANJ_PLUGIN_DEBUG')) define('AOKRANJ_PLUGIN_DEBUG', false);
if (!defined('AOKRANJ_TABLE_VZPONI')) define('AOKRANJ_TABLE_VZPONI', 'ao_vzponi');

/**
 * Global plugin instance
 */
$GLOBALS['AOKranj'] = new AOKranj();

/**
 * AOKranj
 *
 * @package aokranj
 * @link http://aokranj.com/
 * @author Bojan Hribernik <bojan.hribernik@gmail.com>
 */
class AOKranj
{
    const ID = 'aokranj';
    const NAME = 'AO Kranj';
    const VERSION = '1.1';

    const USER_STATUS_NORMAL  = 0;
    const USER_STATUS_WAITING = 2;

    public function __construct() {
        add_shortcode('iframe', array(&$this, 'iframe_shortcode' ));
        remove_shortcode('gallery', 'gallery_shortcode');
        add_shortcode('gallery', array(&$this, 'gallery_shortcode'));

        if (is_admin()) {
            require_once AOKRANJ_PLUGIN_DIR . '/admin.php';
            $admin = new AOKranj_Admin();
        } else {
            add_action('wp_enqueue_scripts', array(&$this, 'wp_enqueue_scripts'));
        }

        add_filter('wp_get_attachment_image_attributes', array(&$this, 'post_thumbnail_title_filter'));
        add_filter('wp_get_attachment_link', array(&$this, 'attachment_link_filter'), 10, 4);
    }

    public function attachment_link_filter( $content, $post_id, $size, $permalink ) {
        // Only do this if we're getting the file URL
        if (! $permalink) {
            // This returns an array of (url, width, height)
            $image = wp_get_attachment_image_src( $post_id, 'large' );
            $new_content = preg_replace('/href=\'(.*?)\'/', 'href=\'' . $image[0] . '\'', $content );
            return $new_content;
        } else {
            return $content;
        }
    }

    public function post_thumbnail_title_filter( $attr ) {
        if (!empty($attr['alt'])) {
            $attr['title'] = $attr['alt'];
        }
    	return $attr;
    }

    public function wp_enqueue_scripts() {
        if (AOKRANJ_PLUGIN_DEBUG === true) {
            wp_enqueue_script('livereload', 'http://localhost:35729/livereload.js?snipver=1', null, false, true);
        }

        wp_enqueue_style('colorbox', AOKRANJ_PLUGIN_URL . '/js/colorbox/colorbox.css', array(), AOKRANJ_PLUGIN_VERSION );
        wp_enqueue_script('colorbox', AOKRANJ_PLUGIN_URL . '/js/colorbox/jquery.colorbox-min.js', array('jquery'), AOKRANJ_PLUGIN_VERSION  );

        //wp_enqueue_script('masonry', AOKRANJ_PLUGIN_URL . '/js/masonry.min.js', array('jquery'), AOKRANJ_PLUGIN_VERSION  );

        wp_enqueue_style('aokranj-plugin', AOKRANJ_PLUGIN_URL . '/css/aokranj.css', array(), AOKRANJ_PLUGIN_VERSION  );
        wp_enqueue_script('aokranj-plugin', AOKRANJ_PLUGIN_URL . '/js/aokranj.js', array('jquery'), AOKRANJ_PLUGIN_VERSION  );
    }

    // shortcodes

    /*
    public function gallery_shortcode($attrs) {
        $attrs['link'] = 'file';
        $attrs['size'] = 'medium';
        return gallery_shortcode($attrs);
    }
    */

    public function gallery_shortcode( $attr ) {
    	$post = get_post();

    	static $instance = 0;
    	$instance++;

    	if ( ! empty( $attr['ids'] ) ) {
    		// 'ids' is explicitly ordered, unless you specify otherwise.
    		if ( empty( $attr['orderby'] ) ) {
    			$attr['orderby'] = 'post__in';
    		}
    		$attr['include'] = $attr['ids'];
    	}

    	/**
    	 * Filter the default gallery shortcode output.
    	 *
    	 * If the filtered output isn't empty, it will be used instead of generating
    	 * the default gallery template.
    	 *
    	 * @since 2.5.0
    	 * @since 4.2.0 The `$instance` parameter was added.
    	 *
    	 * @see gallery_shortcode()
    	 *
    	 * @param string $output   The gallery output. Default empty.
    	 * @param array  $attr     Attributes of the gallery shortcode.
    	 * @param int    $instance Unique numeric ID of this gallery shortcode instance.
    	 */
    	$output = apply_filters( 'post_gallery', '', $attr, $instance );
    	if ( $output != '' ) {
    		return $output;
    	}

    	$html5 = current_theme_supports( 'html5', 'gallery' );
    	$atts = shortcode_atts( array(
            'limit'      => false,
    		'order'      => 'ASC',
    		'orderby'    => 'menu_order ID',
    		'id'         => $post ? $post->ID : 0,
    		'itemtag'    => $html5 ? 'figure'     : 'dl',
    		'icontag'    => $html5 ? 'div'        : 'dt',
    		'captiontag' => $html5 ? 'figcaption' : 'dd',
    		'columns'    => 5,
    		'size'       => 'thumbnail',
    		'include'    => '',
    		'exclude'    => '',
    		'link'       => 'file'
    	), $attr, 'gallery' );

    	$id = intval( $atts['id'] );

    	if ( ! empty( $atts['include'] ) ) {
    		$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

    		$attachments = array();
    		foreach ( $_attachments as $key => $val ) {
    			$attachments[$val->ID] = $_attachments[$key];
    		}
    	} elseif ( ! empty( $atts['exclude'] ) ) {
    		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    	} else {
    		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    	}

    	if ( empty( $attachments ) ) {
    		return '';
    	}

    	if ( is_feed() ) {
    		$output = "\n";
    		foreach ( $attachments as $att_id => $attachment ) {
    			$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
    		}
    		return $output;
    	}

    	$itemtag = tag_escape( $atts['itemtag'] );
    	$captiontag = tag_escape( $atts['captiontag'] );
    	$icontag = tag_escape( $atts['icontag'] );
    	$valid_tags = wp_kses_allowed_html( 'post' );
    	if ( ! isset( $valid_tags[ $itemtag ] ) ) {
    		$itemtag = 'dl';
    	}
    	if ( ! isset( $valid_tags[ $captiontag ] ) ) {
    		$captiontag = 'dd';
    	}
    	if ( ! isset( $valid_tags[ $icontag ] ) ) {
    		$icontag = 'dt';
    	}

    	$columns = intval( $atts['columns'] );
    	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    	$float = is_rtl() ? 'right' : 'left';

    	$selector = "gallery-{$instance}";

    	$gallery_style = '';

    	/**
    	 * Filter whether to print default gallery styles.
    	 *
    	 * @since 3.1.0
    	 *
    	 * @param bool $print Whether to print default gallery styles.
    	 *                    Defaults to false if the theme supports HTML5 galleries.
    	 *                    Otherwise, defaults to true.
    	 */
    	if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
    		$gallery_style = "
    		<style type='text/css'>
    			#{$selector} {
    				margin: auto;
    			}
    			#{$selector} .gallery-item {
    				float: {$float};
    				margin-top: 10px;
    				text-align: center;
    				width: {$itemwidth}%;
    			}
    			#{$selector} img {
    				border: 2px solid #cfcfcf;
    			}
    			#{$selector} .gallery-caption {
    				margin-left: 0;
    			}
    			/* see gallery_shortcode() in wp-includes/media.php */
    		</style>\n\t\t";
    	}

    	$size_class = sanitize_html_class( $atts['size'] );
    	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

    	/**
    	 * Filter the default gallery shortcode CSS styles.
    	 *
    	 * @since 2.5.0
    	 *
    	 * @param string $gallery_style Default CSS styles and opening HTML div container
    	 *                              for the gallery shortcode output.
    	 */
    	$output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

        $num = 0;
    	$i = 0;
    	foreach ( $attachments as $id => $attachment ) {

            // limit
            if ($atts['limit'] && $num >= (int)$atts['limit']) {
                continue;
            }
            $num++;

    		$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
    		if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
    			$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
    		} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
    			$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
    		} else {
    			$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
    		}
    		$image_meta  = wp_get_attachment_metadata( $id );

    		$orientation = '';
    		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
    			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
    		}
    		$output .= "<{$itemtag} class='gallery-item'>";
    		$output .= "
    			<{$icontag} class='gallery-icon {$orientation}'>
    				$image_output
    			</{$icontag}>";
    		if ( $captiontag && trim($attachment->post_excerpt) ) {
    			$output .= "
    				<{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
    				" . wptexturize($attachment->post_excerpt) . "
    				</{$captiontag}>";
    		}
    		$output .= "</{$itemtag}>";
    		if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
    			$output .= '<br style="clear: both" />';
    		}
    	}

    	if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
    		$output .= "
    			<br style='clear: both' />";
    	}

    	$output .= "
    		</div>\n";

    	return $output;
    }

    public function iframe_shortcode($atts) {
        $a = shortcode_atts( array(
            'id' => ''
            ,'width' => ''
            ,'height' => ''
            ,'allowfullscreen' => 'true'
            ,'frameborder' => '0'
            ,'scrolling' => 'no'
            ,'marginheight' => '0'
            ,'marginwidth' => '0'
            ,'src' => ''
            ,'name'=>''
        ), $atts );

        if( empty($a['src']) )
            return "";

        $str = '<div class="responsive-iframe">';
        $str .= '<iframe';
        if( !empty($a['id']) )
            $str .= ' id="'.htmlspecialchars($a['id'],ENT_QUOTES,'',false).'"';
        if( !empty($a['name']) )
            $str .= ' name="'.htmlspecialchars($a['name'],ENT_QUOTES,'',false).'"';
        if( !empty($a['width']) )
            $str .= ' width="'.htmlspecialchars($a['width'],ENT_QUOTES,'',false).'"';
        if( !empty($a['height']) )
            $str .= ' height="'.htmlspecialchars($a['height'],ENT_QUOTES,'',false).'"';
        $str .= ' allowfullscreen="'.htmlspecialchars($a['allowfullscreen'],ENT_QUOTES,'',false).'"';
        $str .= ' frameborder="'.htmlspecialchars($a['frameborder'],ENT_QUOTES,'',false).'"';
        $str .= ' scrolling="'.htmlspecialchars($a['scrolling'],ENT_QUOTES,'',false).'"';
        $str .= ' marginheight="'.htmlspecialchars($a['marginheight'],ENT_QUOTES,'',false).'"';
        $str .= ' marginwidth="'.htmlspecialchars($a['marginwidth'],ENT_QUOTES,'',false).'"';
        if( !empty($a['src']) )
            $str .= ' src="'.htmlspecialchars ($a['src'],ENT_QUOTES,'',false).'"';

        $str .= ' ></iframe>';
        $str .= '</div>';

        return $str;
    }

}
