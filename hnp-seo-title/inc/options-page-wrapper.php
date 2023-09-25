<div class="hnp_seo_title_wrap">
<style>#wpfooter {display: none !important;}</style>
	<div class="hnp_flex_container">
	   <div class="hnp_seo_title_icon">
		  <img src="<?php echo plugins_url('/img/hnp-logo.png', dirname(__FILE__)); ?>" alt="Plugin Icon">
	   </div>
	   <div class="hnp_flex_content">
		  <h2 class="hnp_seo_title_backend-heading"><?php echo esc_html__('HNP SEO Title for URLs Plugin', 'hnp-seo-title-textdomain'); ?></h2>
		  <?php echo hnp_seo_title_check_licence_key_status(); ?>
	   </div>
	</div>
   <?php settings_errors(); ?>
   <?php
   $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'plugin';
   ?>
   <div class="hnp_seo_title_nav-tab-wrapper">
		<div class="hnp-tab">
		   <h2><a href="?page=hnp_seo_title_options&tab=plugin" class="hnp-nav-tab <?php echo isset($active_tab) && $active_tab == 'plugin' ? 'hnp-nav-tab-active' : ''; ?>"><?php echo esc_html__('Plugin', 'hnp-seo-title-textdomain'); ?></a></h2>
		</div>
		<div class="hnp-tab">
		   <h2>
			  <a href="?page=hnp_seo_title_options&tab=other" class="hnp-nav-tab <?php echo isset($active_tab) && $active_tab == 'other' ? 'hnp-nav-tab-active' : ''; ?>"><?php echo esc_html__('Other', 'hnp-seo-title-textdomain'); ?></a>
		   </h2>
		</div>
   </div>
   <form id="featured_upload" method="post" action="">
      <?php
      if ($active_tab == 'plugin') {
         $options = get_option('hnp-seo-title-plugin-options-main');
         if (!is_array($options)) {
            $options = array();
         }
         if (!array_key_exists('hnp_seo_title_data_checked', $options)) {
            $options['hnp_seo_title_data_checked'] = '';
         }		 
		 if (!array_key_exists('hnp_seo_title_data_comp_nonce_checkbox', $options)) {
            $options['hnp_seo_title_data_comp_nonce_checkbox'] = '';
         }	
		 if (!array_key_exists('hnp_seo_title_data_defer_checkbox', $options)) {
            $options['hnp_seo_title_data_defer_checkbox'] = '';
         }	
		 
      ?>
		<input type="hidden" name="hnp_form_submitted_1" value="hnp_1">
		<?php echo hnp_seo_title_check_status_main(); ?>

		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="activate">
			<strong><?php echo esc_html__('Enable the Function?', 'hnp-seo-title-textdomain'); ?></strong><?php echo hnp_seo_title_generate_hover_box(esc_html__('Enable the functionality of the Plugin.', 'hnp-seo-title-textdomain')); ?></label>
			<input name="hnp_seo_title_data_checked" type="checkbox" id="hnp_seo_title_data_checked" value="1" <?php checked($options['hnp_seo_title_data_checked'], 1); ?> onchange="toggleSecondCheckbox(this);" />
		</div>
			  
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_seo_title_data_comp_nonce_checkbox"><?php echo esc_html__('Activate compatibility mode?', 'hnp-seo-title-textdomain'); ?><?php echo hnp_seo_title_generate_hover_box(esc_html__('If this function is enabled, an attempt will be made to prevent caching, minification, and concatenation of the frontend script. If you encounter error messages or if a function is not working as expected, try using this mode.', 'hnp-seo-title-textdomain')); ?></label>
			<input name="hnp_seo_title_data_comp_nonce_checkbox" type="checkbox" id="hnp_seo_title_data_comp_nonce_checkbox" value="1" <?php checked($options['hnp_seo_title_data_comp_nonce_checkbox'], 1); ?> />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_seo_title_data_defer_checkbox"><?php echo esc_html__('Use Defer mode?', 'hnp-seo-title-textdomain'); ?><?php echo hnp_seo_title_generate_hover_box(esc_html__('When this function is enabled, the "defer" tag will be added to the frontend script, which prevents the script from blocking rendering. This function should be tested after activation.', 'hnp-seo-title-textdomain')); ?></label>
			<input name="hnp_seo_title_data_defer_checkbox" type="checkbox" id="hnp_seo_title_data_defer_checkbox" value="1" <?php checked($options['hnp_seo_title_data_defer_checkbox'], 1); ?> />
		</div>
		
		<div class="hnp-option-desc hnp-option-spacing">
			<h3><?php echo esc_html__('Options:', 'hnp-seo-title-textdomain'); ?></h3>
		</div>
				
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_seo_title_data_text"><?php echo esc_html__('Prefix:', 'hnp-seo-title-textdomain'); ?><?php echo hnp_seo_title_generate_hover_box(esc_html__('Add Words on the Start of the Tag', 'hnp-seo-title-textdomain')); ?></label>
			<input type="text" name="hnp_seo_title_data_text" id="hnp_seo_title_data_text" value="<?php echo isset($options['hnp_seo_title_data_text']) ? esc_attr(sanitize_text_field($options['hnp_seo_title_data_text'])) : ''; ?>" placeholder="<?php echo esc_attr__('Text', 'hnp-seo-title-textdomain'); ?>" />
		</div>
		
		<div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_seo_title_data_text_2"><?php echo esc_html__('Suffix:', 'hnp-seo-title-textdomain'); ?><?php echo hnp_seo_title_generate_hover_box(esc_html__('Add Words on the End of the Tag', 'hnp-seo-title-textdomain')); ?></label>
			<input type="text" name="hnp_seo_title_data_text_2" id="hnp_seo_title_data_text_2" value="<?php echo isset($options['hnp_seo_title_data_text_2']) ? esc_attr(sanitize_text_field($options['hnp_seo_title_data_text_2'])) : ''; ?>" placeholder="<?php echo esc_attr__('Text', 'hnp-seo-title-textdomain'); ?>" />
		</div>
		
		
		<div class="hnp-option-container hnp-option-spacing-2 hnp_30_pro">
			<input class="hnp-button-primary" type="submit" name="hnp_form_submit_1" value="<?php echo esc_html__('Update/Save', 'hnp-seo-title-textdomain'); ?>" />
		</div>
	 							
       <?php } elseif ($active_tab == 'other') {
		$options = get_option('hnp-seo-title-plugin-options-other');?>
		
	    <input type="hidden" name="hnp_form_submitted_9" value="hnp_9">
		<p>
			<strong><?php echo esc_html__('Do you have any questions? Do you need a custom plugin or custom function for WordPress / WooCommerce? Send us an email:', 'hnp-seo-title-textdomain'); ?> <a href="mailto:info@Homepage-nach-Preis.de">info@Homepage-nach-Preis.de</a></strong>
		</p>
	  
		 <div class="info-container">
		 <div class="hnp-option-container hnp-option-spacing hnp_30_pro">
			<label for="hnp_seo_title_plugin_data_licence"><strong><?php echo esc_html__('Licence Key:', 'hnp-seo-title-textdomain'); ?></strong><?php echo hnp_seo_title_generate_hover_box(esc_html__('Your Licence Key.', 'hnp-seo-title-textdomain')); ?></label>
			<input type="text" name="hnp_seo_title_data_licence" id="hnp_seo_title_data_licence" value="<?php echo isset($options['hnp_seo_title_data_licence']) ? esc_attr(sanitize_text_field($options['hnp_seo_title_data_licence'])) : ''; ?>" placeholder="<?php echo esc_attr__('Licence Code', 'hnp-seo-title-textdomain'); ?>" />
		</div>
		
		<div class="hnp-option-desc hnp-option-spacing"><h3><?php echo esc_html__('Custom Style:', 'hnp-seo-title-textdomain'); ?></h3></div>
		<div class="hnp-option-container hnp_30_pro">
		   <label for="hnp_seo_title_plugin_data_custom_css"><strong><?php echo esc_html__('Custom Style CSS:', 'hnp-seo-title-textdomain'); ?></strong><?php echo hnp_seo_title_generate_hover_box(esc_html__('Enter your custom CSS code here.', 'hnp-seo-title-textdomain')); ?></label>
		   <textarea name="hnp_seo_title_data_custom_css" rows="8" id="hnp_seo_title_data_custom_css" placeholder="<?php echo esc_attr__('.example-class{color: #000;}', 'hnp-seo-title-textdomain'); ?>"><?php echo isset($options['hnp_seo_title_data_custom_css']) ? esc_textarea($options['hnp_seo_title_data_custom_css']) : ''; ?></textarea>
		</div>
		
		<div class="hnp-option-container hnp-option-spacing-2 hnp_30_pro">
			<input class="hnp-button-primary" type="submit" name="hnp_form_submit_9" value="<?php echo esc_html__('Update/Save', 'hnp-seo-title-textdomain'); ?>" />
		</div>
		</div>
		   </br></br><p style="text-align: right;"><?php echo esc_html__('HNP - Programming made with love in Germany.', 'hnp-seo-title-textdomain'); ?>
		   </p>
		</div>

      <?php } ?>
   </form>
</div>