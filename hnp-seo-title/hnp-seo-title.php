<?php

/*
  Plugin Name: HNP - Url SEO Title
  Description: Automatically generates title tags for URLs without existing tags.
  Author: Christopher Rohde
  Version: 1.1
  Author URI: https://homepage-nach-preis.de/
  License: GPLv3
  Text Domain: hnp-seo-title-textdomain
  Domain Path: /languages
 */

defined('ABSPATH') or die('Huh, are you trying to cheat?');
$plugin_url = plugin_dir_url(__FILE__);
$options = array();

function hnp_seo_title_load_textdomain() {
   $domain = 'hnp-seo-title-textdomain';
   $locale = apply_filters('plugin_locale', get_locale(), $domain);
   $mofile = WP_PLUGIN_DIR . '/hnp-seo-title-plugin/languages/' . $domain . '-' . $locale . '.mo';

   if (file_exists($mofile)) {
      load_textdomain($domain, $mofile);
   } else {
      load_plugin_textdomain($domain, false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
   }
}
add_action('plugins_loaded', 'hnp_seo_title_load_textdomain');

function hnp_seo_title_menu() {
   add_menu_page(
      esc_html__('HNP - Url Seo Title', 'hnp-seo-title-textdomain'),
      esc_html__('HNP - Url Seo Title', 'hnp-seo-title-textdomain'),
      'manage_options',
      'hnp_seo_title_options',
      'hnp_seo_title_display',
      plugin_dir_url(__FILE__) . 'img/hnp-favi.png'
   );
}
add_action('admin_menu', 'hnp_seo_title_menu');

function hnp_seo_title_plugin_settings_link($links) {
   $settings_link = '<a href="admin.php?page=hnp_seo_title_options">' . esc_html__('Settings', 'hnp-seo-title-textdomain') . '</a>';
   array_push($links, $settings_link);
   return $links;
}
$plugin_file = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin_file", 'hnp_seo_title_plugin_settings_link');

function hnp_seo_title_display() {
   if (!current_user_can('manage_options')) {
      wp_die(esc_html__('You do not have enough permission to view this page', 'hnp-seo-title-textdomain'));
   }

   global $plugin_url;
   global $options;
   
	// Main OPTIONS 	
   if (isset($_POST['hnp_form_submit_1'])) {
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      require_once(ABSPATH . 'wp-admin/includes/file.php');
      require_once(ABSPATH . 'wp-admin/includes/media.php');

      echo '<h2 style="color:green">' . esc_html__('Saved', 'hnp-seo-title-textdomain') . '</h2>';
      echo '<script src="' . plugin_dir_url(__FILE__) . 'js/hnp-seo-title-admin-save.js"></script>';
	  	  
      $options['hnp_seo_title_data_checked'] = isset($_POST['hnp_seo_title_data_checked']) ? esc_html($_POST['hnp_seo_title_data_checked']) : '';
	  $options['hnp_seo_title_data_defer_checkbox'] = isset($_POST['hnp_seo_title_data_defer_checkbox']) ? esc_html($_POST['hnp_seo_title_data_defer_checkbox']) : '';
	  $options['hnp_seo_title_data_comp_nonce_checkbox'] = isset($_POST['hnp_seo_title_data_comp_nonce_checkbox']) ? esc_html($_POST['hnp_seo_title_data_comp_nonce_checkbox']) : '';
	  $options['hnp_seo_title_data_text'] = isset($_POST['hnp_seo_title_data_text']) ? esc_html($_POST['hnp_seo_title_data_text']) : '';	
	  $options['hnp_seo_title_data_text_2'] = isset($_POST['hnp_seo_title_data_text_2']) ? esc_html($_POST['hnp_seo_title_data_text_2']) : '';	  
	  	  
      update_option('hnp-seo-title-plugin-options-main', $options);
   }
	
	// Other OPTIONS   
	if (isset($_POST['hnp_form_submit_9'])) {
	  require_once(ABSPATH . 'wp-admin/includes/image.php');
      require_once(ABSPATH . 'wp-admin/includes/file.php');
      require_once(ABSPATH . 'wp-admin/includes/media.php');

      echo '<h2 style="color:green">' . esc_html__('Saved', 'hnp-seo-title-textdomain') . '</h2>';
      echo '<script src="' . plugin_dir_url(__FILE__) . 'js/hnp-seo-title-admin-save.js"></script>';
	  
	  $options['hnp_seo_title_data_licence'] = isset($_POST['hnp_seo_title_data_licence']) ? esc_html($_POST['hnp_seo_title_data_licence']) : '';
	  $options['hnp_seo_title_data_custom_css'] = isset($_POST['hnp_seo_title_data_custom_css']) ? esc_html($_POST['hnp_seo_title_data_custom_css']) : '';
	
	  update_option('hnp-seo-title-plugin-options-other', $options);
	}

   $options = get_option('hnp-seo-title-plugin-options-main');
   $options = get_option('hnp-seo-title-plugin-options-other');
   require('inc/options-page-wrapper.php');
}


// ******* CHECK THE FUNCTION ******

// Check the Licence
// Its just a test, Main-Function comes later
function hnp_seo_title_check_licence_key_status() {
    $options = get_option('hnp-seo-title-plugin-options-other');

    $hnp_licence_key = 'Free Version';
    $color = '';

    if (isset($options['hnp_seo_title_data_licence'])) {
        $licence_key = $options['hnp_seo_title_data_licence'];

        if (substr($licence_key, 0, 4) === 'hnp-' || substr($licence_key, 0, 4) === 'HNP-') {
            $hnp_licence_key = esc_html__('Licence Activated', 'hnp-seo-title-textdomain');
            $color = 'green';
        } elseif (strlen($licence_key) === 9 && substr($licence_key, -1) === '-') {
            $hnp_licence_key = esc_html__('Licence Activated', 'hnp-seo-title-textdomain');
            $color = 'green';
        }
    }

    if ($hnp_licence_key === '') {
        $hnp_licence_key = esc_html__('Licence Not activated', 'hnp-seo-title-textdomain');
        $color = 'red';
    }

    return '<div class="hnp_plugin_data_active" style="color: ' . $color . '; font-weight: bold;">' . esc_html($hnp_licence_key) . '</div>';
}

// **** Radio Design LATER 
function hnp_seo_title_radio_design() {
    $options = get_option('hnp-seo-title-plugin-options-main');
    $radio_design = isset($options['hnp_seo_title_data_radio_design']) ? $options['hnp_seo_title_data_radio_design'] : '';

    if ($radio_design === 'seo_title_design_1' || empty($radio_design)) {
        echo 'Design 1';
    } else if ($radio_design === 'seo_title_design_2') {
        echo 'Design 2';
    }
}


// Check Status of Function
function hnp_seo_title_check_status_main() {
    $options = get_option('hnp-seo-title-plugin-options-main');

    $hnp_function_status = '';
    $function_color = '';

    if (isset($options['hnp_seo_title_data_checked'])) {
        $function_activate = $options['hnp_seo_title_data_checked'];

        if ($function_activate === '1') {
            $hnp_function_status = esc_html__('Activated', 'hnp-seo-title-textdomain');
            $function_color = 'green';
        } else {
            $hnp_function_status = esc_html__('Not Activated', 'hnp-seo-title-textdomain');
            $function_color = 'red';
        }
    } else {
        $hnp_function_status = esc_html__('Not Activated', 'hnp-seo-title-textdomain');
        $function_color = 'red';
    }

    $hnp_comp_mode_status = '';
    $comp_mode_color = '';

    if (isset($options['hnp_seo_title_data_comp_nonce_checkbox'])) {
        $comp_mode_activate = $options['hnp_seo_title_data_comp_nonce_checkbox'];

        if ($comp_mode_activate === '1') {
            $hnp_comp_mode_status = esc_html__('Activated', 'hnp-seo-title-textdomain');
            $comp_mode_color = 'green';
        } else {
            $hnp_comp_mode_status = esc_html__('Not Activated', 'hnp-seo-title-textdomain');
            $comp_mode_color = 'red';
        }
    } else {
        $hnp_comp_mode_status = esc_html__('Not Activated', 'hnp-seo-title-textdomain');
        $comp_mode_color = 'red';
    }


		$output = '<div class="hnp_seo_title_data_active" style="font-weight: bold;">';
		$output .= sprintf(
		   __('Function: <span style="color: %s;">%s</span> | ', 'hnp-seo-title-textdomain'),
		   $function_color,
		   esc_html($hnp_function_status)
		);
		$output .= sprintf(
		   __('Compatibility Mode: <span style="color: %s;">%s</span>', 'hnp-seo-title-textdomain'),
		   $comp_mode_color,
		   esc_html($hnp_comp_mode_status)
		);
		$output .= '</div>';


    return $output;
}


//**** END CHECK FUNCTION

//Frontend-Inline CSS
function hnp_seo_title_output_custom_css() {
   $options = get_option('hnp-seo-title-plugin-options-other');
   $custom_css = !empty($options['hnp_seo_title_data_custom_css']) ? $options['hnp_seo_title_data_custom_css'] : '';

   if (!empty($custom_css)) {
      echo '<style>' . esc_html($custom_css) . '</style>';
   }
}
add_action('wp_head', 'hnp_seo_title_output_custom_css');


//Hover Box
function hnp_seo_title_generate_hover_box($text) {
    $html = '<div class="hover-box">';
    $html .= '<span class="hover-text">' . esc_html($text) . '</span>';
    $html .= '</div>';
    
    return $html;
}


// Enqueue Scripts
function hnp_seo_title_plugin_admin_styles() {
   wp_enqueue_style('hnp_seo_title_unique-admin-styles', plugin_dir_url(__FILE__) . 'css/hnp_seo_title_backend.css', array(), '1.0');
   wp_enqueue_script('hnp_seo_title_custom-admin-script', plugin_dir_url(__FILE__) . 'js/hnp_seo_title_custom-admin-script.js', array('jquery'), '1.0', true);
   wp_enqueue_media();
   wp_enqueue_style( 'wp-color-picker' ); // Style for the color picker box
   wp_enqueue_script( 'wp-color-picker' ); // Script for the color picker box
}

add_action('admin_enqueue_scripts', 'hnp_seo_title_plugin_admin_styles', 999);


// *** Frontend Script ***
function hnp_seo_title_custom_scripts() {
	
	$options = get_option('hnp-seo-title-plugin-options-main');
	$prefix = isset($options['hnp_seo_title_data_text']) ? $options['hnp_seo_title_data_text'] : '';
	$suffix = isset($options['hnp_seo_title_data_text_2']) ? $options['hnp_seo_title_data_text_2'] : '';
	
    if (isset($options['hnp_seo_title_data_checked']) && $options['hnp_seo_title_data_checked'] != '') {
        // Use defer Checkbox
        $use_defer = isset($options['hnp_seo_title_data_defer_checkbox']) && $options['hnp_seo_title_data_defer_checkbox'] == 1;

        // Nonce Modus Checkbox
        $use_nonce = isset($options['hnp_seo_title_data_comp_nonce_checkbox']) && $options['hnp_seo_title_data_comp_nonce_checkbox'] == 1;

        // Create the Nonce
        $nonce = $use_nonce ? wp_create_nonce('hnp_seo_title_nonce_custom_scripts') : '';
        ?>
        <script id="hnp_seo_title_data_protection" type="text/javascript"<?php if ($use_nonce) { echo ' nonce="' . $nonce . '"'; } ?> <?php if ($use_defer) { echo 'defer'; } ?>>
           jQuery(function($) {
              // Check the nonce before executing the script, if enabled
              <?php if ($use_nonce) { ?>
              var hnp_seo_title_nonce = '<?php echo $nonce; ?>';
              $.ajaxSetup({
                 beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', hnp_seo_title_nonce);
                 }
              });
              <?php } ?>              
			     
				jQuery(function($) {
					// Use all <a>
					$('a').each(function() {
						// Check for premade Tags
						if (!$(this).attr('title')) {
							var linkText = $(this).text();
							var cleanedText = ('<?php echo sanitize_title($prefix); ?>').trim() + ' ' + linkText.trim() + ' ' + ('<?php echo sanitize_title($suffix); ?>').trim();
							$(this).attr('title', cleanedText);
						}
					});
				});
    

           });		   
        </script>
        <?php
    }
}

$options = get_option('hnp-seo-title-plugin-options-main');
if (isset($options['hnp_seo_title_data_checked']) && $options['hnp_seo_title_data_checked'] != '') {
    add_action('wp_footer', 'hnp_seo_title_custom_scripts');
}